<?php
/**
 * READ API — return availability reports as JSON for the Live Study Map.
 *
 * TEAMMATE OWNERSHIP — Person 3: backend/db.php and backend/get_reports.php
 *
 * Joins:
 *   AvailabilityReport → Zone → Floor → Building, and "User" (quoted table name).
 *
 * Response shape:
 *   { "success": true, "reports": [ ... ] }
 *   { "success": false, "message": "..." } on errors
 */

declare(strict_types=1);

require __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

/**
 * SQL we run: newest reports first (ORDER BY CreatedAt DESC).
 * We first try only “active” rows where ExpiresAt is still in the future.
 * If that returns zero rows, we run the same SELECT without the date filter
 * so you can still see sample / older data while developing.
 */
$sqlSelect = <<<'SQL'
SELECT
  ar."ReportID" AS "ReportID",
  b."BuildingName" AS "BuildingName",
  f."FloorNumber" AS "FloorNumber",
  z."ZoneName" AS "ZoneName",
  u."UserName" AS "UserName",
  ar."SeatAvailability" AS "SeatAvailability",
  ar."NoiseLevel" AS "NoiseLevel",
  ar."OutletAvailability" AS "OutletAvailability",
  ar."CreatedAt" AS "CreatedAt",
  ar."ExpiresAt" AS "ExpiresAt",
  ar."IsFlagged" AS "IsFlagged"
FROM "AvailabilityReport" ar
INNER JOIN "Zone" z ON ar."ZoneID" = z."ZoneID"
INNER JOIN "Floor" f ON z."FloorID" = f."FloorID"
INNER JOIN "Building" b ON f."BuildingID" = b."BuildingID"
INNER JOIN "User" u ON ar."UserID" = u."UserID"
SQL;

try {
    $sqlActive = $sqlSelect . "\nWHERE ar.\"ExpiresAt\" > NOW()\nORDER BY ar.\"CreatedAt\" DESC\n";
    $stmt = $pdo->query($sqlActive);
    $reports = $stmt->fetchAll();

    if (count($reports) === 0) {
        $sqlAll = $sqlSelect . "\nORDER BY ar.\"CreatedAt\" DESC\n";
        $stmt = $pdo->query($sqlAll);
        $reports = $stmt->fetchAll();
    }

    echo json_encode([
        'success' => true,
        'reports' => $reports,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Could not load reports. Check table and column names in get_reports.php match your database.',
    ]);
}
