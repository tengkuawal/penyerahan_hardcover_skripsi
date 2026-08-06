<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `project_penyerahan_skripsi` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database project_penyerahan_skripsi berhasil dibuat di MySQL!\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
