<?php
echo exec('whoami');
$myfile = fopen("testfile.txt", "a") or die ("Error al crear");