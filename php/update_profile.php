<?php
require_once __DIR__ . '/../vendor/autoload.php';

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$response = array();

$sessionId = $_POST['sessionId'] ?? null;

if ($sessionId) {
    $id = $redis->get($sessionId);
    if ($id) {
        $first_name = $_POST['first-name'] ?? '';
        $last_name = $_POST['last-name'] ?? '';
        $dob = $_POST['dob'] ?? '';
        $age = $_POST['age'] ?? '';
        $personal_email = $_POST['personal-email'] ?? '';

        $profileKey = "user:$id:profile";
        $profileData = json_decode($redis->get($profileKey), true);
        $profileData['first_name'] = $first_name;
        $profileData['last_name'] = $last_name;
        $profileData['dob'] = $dob;
        $profileData['age'] = $age;
        $profileData['personal_email'] = $personal_email;
        $redis->set($profileKey, json_encode($profileData));

        $client = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $client->guvi->profile;

        $profileDataMongo = $collection->findOne(['user_id' => $id]);
        if ($profileDataMongo) {
            $collection->updateOne(
                ['user_id' => $id],
                ['$set' => [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'dob' => $dob,
                    'age' => $age,
                    'personal_email' => $personal_email
                ]]
            );
        } else {
            $collection->insertOne([
                'user_id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'dob' => $dob,
                'age' => $age,
                'personal_email' => $personal_email
            ]);
        }

        $response['success'] = true;
        $response['message'] = "Profile updated successfully.";
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
