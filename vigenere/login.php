<?php
include 'vigenere.php'; // Replace with the actual name of your PHP file containing the functions

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = strtoupper($_POST["password"]);
}

$key = "mantap";
$encryptedPassword = encipher($password, $key, true);


$servername = "localhost";
$db_username = "root"; // Change this to your database username
$db_password = ""; // Change this to your database password
$db_name = "pw"; // Change this to your database name

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cari pengguna di database
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $encryptedPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Jika data cocok, set sesi sebagai login
    $_SESSION["login"] = true;

    // Redirect ke halaman selamat datang
    header("Location: selamat_datang.html");
    exit();
} else {
    // Jika data tidak cocok, kembali ke formulir login dengan pesan error
    header("Location: login_form.html?error=1");
    exit();
}

?>
