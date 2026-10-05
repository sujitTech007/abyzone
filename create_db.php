<?php
// Simple script to create the database defined in .env
$envPath = __DIR__ . DIRECTORY_SEPARATOR . '.env';
if (!file_exists($envPath)) {
    echo "No .env file found\n";
    exit(1);
}

$contents = file_get_contents($envPath);
$lines = preg_split('/\r\n|\r|\n/', $contents);
$vars = [];
foreach ($lines as $line) {
    if (!str_contains($line, '=')) continue;
    [$k, $v] = explode('=', $line, 2);
    $vars[trim($k)] = trim($v);
}

$dbName = $vars['DB_DATABASE'] ?? null;
$dbHost = $vars['DB_HOST'] ?? '127.0.0.1';
$dbPort = $vars['DB_PORT'] ?? '3306';
$dbUser = $vars['DB_USERNAME'] ?? 'root';
$dbPass = $vars['DB_PASSWORD'] ?? '';

if (!$dbName) {
    echo "DB_DATABASE not found in .env\n";
    exit(1);
}

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort}";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database `{$dbName}` created or already exists.\n";
    exit(0);
} catch (Exception $e) {
    echo "Failed to create database: " . $e->getMessage() . "\n";
    exit(1);
}
