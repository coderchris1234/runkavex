<?php
// Bare minimum test - no Laravel, no vendor
http_response_code(200);
header('Content-Type: text/plain');

echo "PHP is running!\n";
echo "PHP version: " . PHP_VERSION . "\n";
echo "PHP_VERSION_ID: " . PHP_VERSION_ID . "\n";
echo "__DIR__: " . __DIR__ . "\n";
echo "dirname(__DIR__): " . dirname(__DIR__) . "\n";

$root = dirname(__DIR__) . '/Runkavex';
echo "Expected Laravel root: $root\n";
echo "Root exists: " . (is_dir($root) ? 'YES' : 'NO') . "\n";
echo "vendor exists: " . (is_dir($root . '/vendor') ? 'YES' : 'NO') . "\n";
echo "bootstrap exists: " . (is_dir($root . '/bootstrap') ? 'YES' : 'NO') . "\n";

echo "\nDirectory listing of " . dirname(__DIR__) . ":\n";
foreach (scandir(dirname(__DIR__)) as $item) {
    echo "  $item\n";
}
