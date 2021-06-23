<?php
function input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
}

function write($content) {
  $fileName = "data.txt";
  $resource = fopen($fileName, "a");
  $fw = fwrite($resource, $content);
  fclose($resource);
  return $fw;
}
function read() {
  $fileName = "convertion_data.txt";
  $fileSize = filesize($fileName);
  $fr = "";
  if($fileSize > 0) {
    $resource = fopen($fileName, "r");
    $fr = fread($resource, $fileSize);
    fclose($resource);
    return $fr;
  }
}
?>