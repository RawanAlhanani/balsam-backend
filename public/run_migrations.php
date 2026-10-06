<?php
// One-time migration runner script. Runs pending Laravel migrations
// and deletes itself automatically after completion.

$TOKEN = 'ffde0273ea2e661edb8e59d217c7d0afc7150f18f58f2bf4';

if (!isset($_GET['token']) || !hash_equals($TOKEN, (string) $_GET['token'])) {
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

$exitCode = 1;

try {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('migrate', [
        '--force' => true,
    ]);

    echo \Illuminate\Support\Facades\Artisan::output();

    echo "\n=== Migration completed with exit code: $exitCode ===\n";

    if ($exitCode === 0) {
        echo "SUCCESS: All pending migrations ran successfully.\n";
    } else {
        echo "WARNING: Migrations completed with errors. Check the output above.\n";
    }
} catch (\Throwable $e) {
    echo "\nERROR: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

// Delete itself only after a clean run, so a failed attempt can be retried
// (and the file is never left on the server after success).
if ($exitCode === 0) {
    @unlink(__FILE__);
    echo "\n=== This script deleted itself. ===\n";
} else {
    echo "\n=== Script NOT deleted (migration failed). Fix the error, retry, or delete it manually. ===\n";
}
