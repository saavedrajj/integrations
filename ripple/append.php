<?php 
chmod("data.txt", 0777);

$file = fopen("data.txt", "a");

fwrite($file, "Añadimos línea 1" . PHP_EOL);

fwrite($file, "Añadimos línea 2" . PHP_EOL);

fclose($file);

?>