<?php
/**
 * Extract the full export tar to 'export' directory.
 */


$export_dir = dir('export');


// Copy the required files from the export directory to the install directory.
$configs = scandir('config/install');
$export_dir = dir('export');
while (false !== ($entry = $export_dir->read())) {
  $path_parts = pathinfo($entry);
  if ($path_parts['extension'] == 'yml' && in_array($entry, $configs)) {
    copy($export_dir->path . '/' . $entry, 'config/install/' . $entry);
  }
}
$export_dir->close();

// Strip UUIDs
$d = dir('config/install');
echo "Updating yml files in: " . $d->path . "\n";
while (false !== ($entry = $d->read())) {
  $path_parts = pathinfo($entry);
  if ($path_parts['extension'] == 'yml') {
    $file = file($d->path . '/' . $entry);
    if (strpos($file[0], 'uuid:') !== FALSE) {
      array_shift($file);
      $content = implode($file);
      file_put_contents($d->path . '/' . $entry, $content);
      echo $entry."\n";
    }
  }

}
$d->close();
