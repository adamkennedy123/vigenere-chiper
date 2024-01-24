<?php
include 'vigenere.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = strtoupper($_POST["password"]);
}

$key = "mantap";
$encryptedPassword = encipher($password, $key, true);

$servername = "localhost";
$db_username = "root"; // ganti username database
$db_password = ""; // ganti password database
$db_name = "pw"; // ganti nama database

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pengecekan apakah username sudah digunakan
$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jika username sudah ada, munculkan pesan error atau lakukan tindakan sesuai kebutuhan Anda
    header("Location: register_form.html?error=1");
    exit();
}

// Jika username belum digunakan, masukkan data ke dalam database
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $encryptedPassword);
$stmt->execute();

// Cek apakah pemasukan berhasil
if ($stmt->affected_rows == 1) {
    // Jika data cocok, set sesi sebagai login
    $_SESSION["login"] = true;

    // Redirect ke halaman selamat datang
    header("Location: berhasil.html");
    exit();
} else {
    // Jika data tidak cocok, kembali ke formulir login dengan pesan error
    header("Location: login_form.html?error=1");
    exit();
}

?>
