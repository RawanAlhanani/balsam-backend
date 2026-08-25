<?php
// One-time migration runner script. Runs pending Laravel migrations
// and deletes itself automatically after completion.

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

echo "=== Running Laravel Migrations ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n\n";

try {
    // Run migrations
    $exitCode = \Illuminate\Support\Facades\Artisan::call('migrate:force', [
        '--force' => true,
    ]);

    echo \Illuminate\Support\Facades\Artisan::output();
    
    echo "\n=== Migration completed with exit code: $exitCode ===\n";
    
    if ($exitCode === 0) {
        echo "SUCCESS: All migrations ran successfully.\n";
    } else {
        echo "WARNING: Migrations completed with errors. Check the output above.\n";
    }
    
} catch (Exception $e) {
    echo "\nERROR: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

// Delete itself
@unlink(__FILE__);
echo "\n=== This script deleted itself. ===\n";
