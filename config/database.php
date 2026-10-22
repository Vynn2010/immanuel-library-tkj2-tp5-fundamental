<?php
$host = "localhost";
$dbname = "immanuel_library";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Memberi tahu info error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mengembalikan array associative
    PDO::ATTR_EMULATE_PREPARES => false // Mengatur siapa yang eksekusi prepare (false = sql, true = php)
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
    die("Koneksi ke database gagal: " . $error->getMessage());
}



?>