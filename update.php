<?php
    require_once("database.php");

    $id = $_POST["id"];

    $query = "SELECT * FROM coins_table WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_assoc();

    $name = $row["name"];
    $number = $row["number"];
    $price = $row["price"];
    $deducted_value = $row["deducted_value"];
    $main_investment = $row["main_investment"];

    $add_amount = isset($_POST['add_amount']) ? $_POST['add_amount'] : '';

    if ($add_amount) {

        $newValue = ($add_amount/$price) + $number;

        if ($deducted_value < 0) {
            $deducted_value = 0;
        }

        $updateSql = "UPDATE coins_table SET number = $newValue, price = $price, deducted_value = $deducted_value WHERE id = $id";

        mysqli_query($conn, $updateSql);

        $sqlLogs = "INSERT INTO logs (name, number, price, deducted_value, main_investment) VALUES ('$name', $newValue, $price, $deducted_value, $main_investment)";

        mysqli_query($conn, $sqlLogs);

        $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
        mysqli_query($conn, $resetQuery);
    
        $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
        mysqli_multi_query($conn, $updateQuery);
    }

    $deduct_amount = isset($_POST['deduct_amount']) ? $_POST['deduct_amount'] : '';

    if ($deduct_amount) {

        $newValue = $number - ($deduct_amount/$price);
        $totalDeductedValue =  $deducted_value + $deduct_amount;

        $updateSql = "UPDATE coins_table SET number = $newValue, price = $price, deducted_Value = $totalDeductedValue WHERE id = $id";

        mysqli_query($conn, $updateSql);

        $sqlLogs = "INSERT INTO logs (name, number, price, deducted_value, main_investment) VALUES ('$name', $newValue, $price, $totalDeductedValue, $main_investment)";
        
        mysqli_query($conn, $sqlLogs);

        $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
        mysqli_query($conn, $resetQuery);

        $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
        mysqli_multi_query($conn, $updateQuery);
    }

    $update_price = isset($_POST['update_price']) ? $_POST['update_price'] : '';

    if ($update_price) {
        
        $updateSql = "UPDATE coins_table SET price = $update_price WHERE id = $id";
        mysqli_query($conn, $updateSql);

        $sqlLogs = "INSERT INTO logs (name, number, price, deducted_value, main_investment) VALUES ('$name', $number, $update_price, $deducted_value, $main_investment)";
        mysqli_query($conn, $sqlLogs);

        $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
        mysqli_query($conn, $resetQuery);
    
        $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
        mysqli_multi_query($conn, $updateQuery);
    }

    $new_main_investment = isset($_POST['new_main_investment']) ? $_POST['new_main_investment'] : '';

    if ($new_main_investment) {
        
        $updateSql = "UPDATE coins_table SET main_investment = $new_main_investment WHERE id = $id";
        mysqli_query($conn, $updateSql);

        $sqlLogs = "INSERT INTO logs (name, number, price, deducted_value, main_investment)VALUES ('$name', $number, $price, $deducted_value, $new_main_investment)";
        mysqli_query($conn, $sqlLogs);

        $resetQuery = "ALTER TABLE logs AUTO_INCREMENT = 1";
        mysqli_query($conn, $resetQuery);
    
        $updateQuery = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
        mysqli_multi_query($conn, $updateQuery);
    }

    header("Location: edit-page.php?id=$id");
    exit;
?>