<?php
/**
 * LabSeat — example configuration (safe to commit).
 *
 * TEAM: Copy this file to config.php on your machine and add your real password.
 *       config.php is listed in .gitignore and must never be committed.
 *
 * Person 3 (primary): maintains db.php and connection details with this pattern.
 */

return [
    'host' => 'localhost',
    'port' => '5432',
    'dbname' => 'labseat',
    'user' => 'your_postgres_username',
    // Leave empty here; set only in local config.php — do not hardcode passwords in tracked files.
    'password' => '',
];
