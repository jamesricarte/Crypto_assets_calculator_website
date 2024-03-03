<?php 
    require_once('database.php');

    $name = $_POST["name"];
    $number = filter_input(INPUT_POST, "number", FILTER_VALIDATE_FLOAT);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);

    $main_investment = $number*$price;

    if(trim($name) !== "" && $price !== "") {
        try {
            $sql = "INSERT INTO coins_table (name, number, price, main_investment)
                    VALUES('$name','$number','$price', '$main_investment')";

           mysqli_query($conn, $sql);

           $sql2 = "INSERT INTO logs (name, number, price, main_investment)
           VALUES('$name','$number','$price', '$main_investment')";

            mysqli_query($conn, $sql2);

            $resetQuery = "ALTER TABLE coins_table AUTO_INCREMENT = 1";
            $conn->query($resetQuery);

            $updateQuery = "SET @new_id = 0; UPDATE coins_table SET id = @new_id:=@new_id+1";
            $conn->multi_query($updateQuery);

        } catch(Exception $e) {
            echo "error connecting database";
        }
    }

    mysqli_close($conn);
    
    require('database.php');

    $resetQuerylogs = "ALTER TABLE logs AUTO_INCREMENT = 1";
    $conn->query($resetQuerylogs);

    $updateQuerylogs = "SET @new_id = 0; UPDATE logs SET id = @new_id:=@new_id+1";
    $conn->multi_query($updateQuerylogs);

    mysqli_close($conn);

    header("Location: index.php");
    exit;
?>