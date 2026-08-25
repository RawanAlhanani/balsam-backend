<?php
// One-time permissions setup script. Runs specific migrations and seeds permissions.
// Deletes itself automatically after completion.

$TOKEN = 'f741451db39c8b98ddeb935f4cc17bcba8cb4d44047f36ed';

if (!isset($_GET['token']) || !hash_equals($TOKEN, $_GET['token'])) {
    http_response_code(403);
    echo 'forbidden';
    exit;
}

header('Content-Type: text/plain; charset=utf-8');

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Running Permissions Setup ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n\n";

$migrations = [
    '2026_08_22_090000_create_permissions_table',
    '2026_08_22_090001_create_role_permissions_table',
    '2026_08_22_090002_create_user_permissions_table',
    '2026_08_24_080040_create_revoked_permissions_table',
];

try {
    echo "Step 1: Running specific migrations...\n";
    echo str_repeat('-', 50) . "\n";
    
    foreach ($migrations as $migration) {
        echo "Running migration: $migration\n";
        $exitCode = \Illuminate\Support\Facades\Artisan::call('migrate', [
            '--path' => 'database/migrations/' . $migration . '.php',
            '--force' => true,
        ]);
        
        echo \Illuminate\Support\Facades\Artisan::output();
        
        if ($exitCode === 0) {
            echo "✓ Migration completed successfully\n\n";
        } else {
            echo "✗ Migration failed with exit code: $exitCode\n\n";
        }
    }
    
    echo str_repeat('-', 50) . "\n";
    echo "Step 2: Running PermissionsSeeder...\n";
    echo str_repeat('-', 50) . "\n";
    
    $exitCode = \Illuminate\Support\Facades\Artisan::call('db:seed', [
        '--class' => 'PermissionsSeeder',
        '--force' => true,
    ]);
    
    echo \Illuminate\Support\Facades\Artisan::output();
    
    if ($exitCode === 0) {
        echo "\n✓ PermissionsSeeder completed successfully\n";
    } else {
        echo "\n✗ PermissionsSeeder failed with exit code: $exitCode\n";
    }
    
    echo str_repeat('-', 50) . "\n";
    echo "\n=== Setup completed ===\n";
    echo "IMPORTANT: The PermissionsSeeder is REQUIRED because:\n";
    echo "- Migrations only create empty tables\n";
    echo "- Seeder populates permissions table with all permission names\n";
    echo "- Seeder sets up default role-permission mappings\n";
    
} catch (Exception $e) {
    echo "\nERROR: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

// Delete itself
@unlink(__FILE__);
echo "\n=== This script deleted itself. ===\n";
