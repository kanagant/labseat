<?php
/**
 * DELETE endpoint — remove a report by id.
 *
 * TEAMMATE OWNERSHIP — Person 4:
 * backend/add_report.php, backend/update_report.php, backend/delete_report.php
 */

declare(strict_types=1);

require __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS, POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if (! in_array($_SERVER['REQUEST_METHOD'], ['DELETE', 'POST'], true)) {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Use DELETE (or POST) with JSON or query id.']);
    exit;
}

// TODO (Person 4): Read id from body or query string, DELETE from your reports table.

$payload = json_decode(file_get_contents('php://input') ?: '{}', true);
$id = isset($_GET['id']) ? (string) $_GET['id'] : null;

echo json_encode([
    'ok' => true,
    'message' => 'delete_report placeholder — implement DELETE here.',
    'id_from_query' => $id,
    'payload_keys' => is_array($payload) ? array_keys($payload) : [],
]);
