<?php

    require_once('database.php');

    $fileName = $_POST["fileName"];
    $filePath = $_POST["filePath"];

    $imageId = 1;

    $sql = "UPDATE coins_table SET file_name = '$fileName', file_path = '$filePath' WHERE id = $imageId";
    mysqli_query($conn, $sql);

    if ($conn->query($sql) === TRUE) {

        $sql = "SELECT file_name, file_path FROM coins_table WHERE id = $imageId";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();

        $imagePath = $row["file_name"] . $row["file_path"];

        echo '<img src="'.$imagePath.'"';
    } else {
        echo "Error updating image information: " . $conn->error;
    }
?>