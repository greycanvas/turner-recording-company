<?php

$sketchsongTitle = "";
if (isset($_POST["sketchsongTitle"])) {
    $sketchsongTitle = $_POST["sketchsongTitle"];
}
echo $sketchsongTitle;

?>