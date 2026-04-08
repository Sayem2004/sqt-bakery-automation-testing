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

    $name     = trim($_POST['name']);
    $phone    = trim($_POST['phone']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role     = trim($_POST['role']);

    if (empty($name) || empty($phone) || empty($email) || empty($password) || empty($role)) {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            exit();
        } else {
            header("Location: ../view/register.php?error=All fields are required");
            exit();
        }
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            exit();
        } else {
            header("Location: ../view/register.php?error=Invalid email format");
            exit();
        }
    }

    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => 'Invalid phone number']);
            exit();
        } else {
            header("Location: ../view/register.php?error=Invalid phone number");
            exit();
        }
    }

    if (strlen($password) < 5) {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => 'Password must be at least 5 characters']);
            exit();
        } else {
            header("Location: ../view/register.php?error=Password must be at least 5 characters");
            exit();
        }
    }

    $result = $db->registerUser($conn, "users", $name, $phone, $email, $password, $role);

    if ($result === true) {
        if ($isAjax) {
            echo json_encode(['success' => true, 'message' => 'Registration successful! Redirecting to login...']);
            exit();
        } else {
            header("Location: ../view/login.php?success=Registration successful! Please Login.");
            exit();
        }
    } 
    elseif ($result === "EmailExists") {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => 'Email already exists!']);
            exit();
        } else {
            header("Location: ../view/register.php?error=Email already exists!");
            exit();
        }
    } 
    else {
        if ($isAjax) {
            echo json_encode(['success' => false, 'message' => $result]);
            exit();
        } else {
            header("Location: ../view/register.php?error=" . urlencode($result));
            exit();
        }
    }

} else {
    header("Location: ../view/register.php");
    exit();
}
?>