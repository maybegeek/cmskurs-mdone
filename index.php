<?php
include('assets/parsedown/Parsedown.php');

$Parsedown = new Parsedown();
echo $Parsedown->text('# Dinge und Sachen');
?>
