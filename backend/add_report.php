<?php
/**
 * CREATE endpoint — insert a new report row.
 *
 * TEAMMATE OWNERSHIP — Person 4:
 * backend/add_report.php, backend/update_report.php, backend/delete_report.php
 */

declare(strict_types=1);

require __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Use POST with JSON body.']);
    exit;
}

// TODO (Person 4): Parse JSON body, validate fields, INSERT into your reports table.

$payload = json_decode(file_get_contents('php://input') ?: '{}', true);
if (! is_array($payload)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid JSON.']);
    exit;
}

echo json_encode([
    'ok' => true,
    'message' => 'add_report placeholder — implement INSERT here.',
    'received_keys' => array_keys($payload),
]);
