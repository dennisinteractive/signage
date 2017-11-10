<?php


$d = dir('config/install');

echo "Removing uuid from yml files in: " . $d->path . "\n";
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
