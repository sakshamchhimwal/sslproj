<?php
    session_start();
    $uData=$_SESSION['userData'];
    echo $uData['name'];
?>