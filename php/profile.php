<?php
require_once __DIR__ . '/../vendor/autoload.php';

$response = array();
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$sessionId = $_GET['sessionId'] ?? null;

if ($sessionId) {
    $id = $redis->get($sessionId);
    if ($id) {
        $profileKey = "user:$id:profile";
        $profileData = json_decode($redis->get($profileKey), true);

        if ($profileData) {
            $response['success'] = true;
            $response['profile'] = $profileData;
        } else {
            $client = new MongoDB\Client("mongodb://localhost:27017");
            $collection = $client->guvi->profile;
            $profileDataMongo = $collection->findOne(['user_id' => $id]);

            if ($profileDataMongo) {
                $profileData = [
                    'first_name' => $profileDataMongo['first_name'],
                    'last_name' => $profileDataMongo['last_name'],
                    'dob' => $profileDataMongo['dob'],
                    'age' => $profileDataMongo['age'],
                    'personal_email' => $profileDataMongo['personal_email']
                ];

                $redis->set($profileKey, json_encode($profileData));
                $response['success'] = true;
                $response['profile'] = $profileData;
            } else {
                $response['success'] = false;
                $response['message'] = "Profile not found.";
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Invalid session ID.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Session ID not provided.";
}

echo json_encode($response);
?>
