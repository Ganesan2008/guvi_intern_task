<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guvi";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();


$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        //  password
        if (password_verify($password, $user['password'])) {
            // Store session in Redis
            $sessionId = bin2hex(random_bytes(32));
            $redis->set($sessionId, json_encode($user), 3600); 

            $response['success'] = true;
            $response['sessionId'] = $sessionId;
            $response['user'] = array(
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            );
        } else {
            $response['success'] = false;
            $response['message'] = "Incorrect password.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Email not registered.";
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
