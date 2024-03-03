<?php 
    require_once('database.php');

    $id = $_GET["id"];

    $query = "SELECT * FROM coins_table WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_assoc();

    $name = $row["name"];

    $deleteQuery = "DELETE FROM coins_table WHERE id=$id";
    mysqli_query($conn, $deleteQuery);

    $deleteQueryLogs = "DELETE FROM logs WHERE name='$name'";
    mysqli_query($conn, $deleteQueryLogs);

    header("Location: index.php");
    exit;

?>