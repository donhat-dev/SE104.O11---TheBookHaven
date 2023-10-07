<?php

if (!empty($_GET['id'])) {

    //Create connection and select DB
    include 'config/connect.php';
    //Check connectio
    //Get image data from database
    $result = $conn->query("SELECT img_link FROM image WHERE id = {$_GET['id']}");

    if ($result->num_rows > 0) {
        $imgData = $result->fetch_assoc();

        //Render image
        header("Content-type: image/jpg");
        echo $imgData['img_link'];
    } else {
        //do nothing
    }
}
