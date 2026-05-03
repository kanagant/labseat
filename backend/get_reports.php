<?php
/**
 * READ endpoint — return seat/study-space reports as JSON for the Live Study Map.
 *
 * TEAMMATE OWNERSHIP — Person 3: backend/db.php and backend/get_reports.php
 * Replace the placeholder query with your real Phase 03 SELECT once tables exist.
 */

declare(strict_types=1);

require __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

try {
    // TODO (Person 3): SELECT from your Phase 03 / Phase 2 schema (e.g. reports or seats table).
    $stmt = $pdo->query(
        'SELECT 1 AS id, \'Example row — replace this query\' AS message, NOW() AS loaded_at LIMIT 1'
    );
    $rows = $stmt->fetchAll();
    echo json_encode(['ok' => true, 'reports' => $rows]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Query failed.', 'reports' => []]);
}
