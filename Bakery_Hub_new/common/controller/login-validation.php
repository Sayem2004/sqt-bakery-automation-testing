<?php

session_start();

$path = __DIR__."/../model/db_connect.php";
if(!file_exists($path)){
    die("Database File not found");
}
require_once $path;

$db = new DatabaseConnection();
$conn = $db->openConnection();

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            exit();
        } else {
            header("Location: ../view/login.php?error=All fields are required");
            exit();
        }
    }

    $user = $db->loginUser($conn, "users", $email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_email'] = $user['email'];

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'role' => $user['role'],
            'email' => $user['email']
        ];

        switch ($user['role']) {
            case 'customer':
                $redirect = '../../Customer/view/customer_dashboard.php';
                break;
            case 'staff':
                $redirect = '../../Staff/view/staff_dashboard.php';
                break;
            case 'delivery':
                $redirect = '../../Delivery/view/delivery_dashboard.php';
                break;
            default:
                $redirect = '../view/dashboard.php';
                break;
        }
        
        if ($isAjax) {
            echo json_encode(['success' => true, 'message' => 'Login successful', 'redirect' => $redirect]);
            exit();
        } else {
            header("Location: " . $redirect);
            exit();
        }

    } else {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => 'Incorrect email or password']);
            exit();
        } else {
            header("Location: ../view/login.php?error=Incorrect email or password");
            exit();
        }
    }

} else {
    header("Location: ../view/login.php");
    exit();
}
?>