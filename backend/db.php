<?php
/**
 * PostgreSQL database connection helper.
 *
 * TEAMMATE OWNERSHIP — Person 3: backend/db.php and backend/get_reports.php
 * Person 3: Implement PDO connection, error handling, and reuse across scripts.
 */

declare(strict_types=1);

$configPath = __DIR__ . '/config.php';
if (! is_readable($configPath)) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'ok' => false,
        'error' => 'Missing config.php — copy backend/config.example.php to backend/config.php and fill in credentials.',
    ]);
    exit;
}

/** @var array<string, string|int> $cfg */
$cfg = require $configPath;

$dsn = sprintf(
    'pgsql:host=%s;port=%s;dbname=%s',
    $cfg['host'],
    $cfg['port'],
    $cfg['dbname']
);

try {
    $pdo = new PDO($dsn, (string) $cfg['user'], (string) $cfg['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'ok' => false,
        'error' => 'Database connection failed. Check config.php and that PostgreSQL is running.',
    ]);
    exit;
}
