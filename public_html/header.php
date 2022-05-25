<!DOCTYPE html>
<html>
<head>
    <title>Turner Recording Company</title>
<?php
    include("common.php");
?>
</head>
<body>
<header>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php if(PRODUCTION){ ?><li><a href="dynamic-map.php">Song Structure / Dynamic Map</a></li> <?php } ?>
    </ul>
</header>
