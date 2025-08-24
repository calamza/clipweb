<?php
// Minimal version exposure for IngestaCMS
$version = '1.0.2';
if (file_exists(__DIR__ . '/config.php')) {
  // Optionally parse a VERSION file or env in the future
}
header('Content-Type: application/javascript; charset=UTF-8');
echo 'window.__APP_VERSION__ = ' . json_encode($version) . ';';
