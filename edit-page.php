<?php 
    require_once('database.php');

    $id = $_GET["id"];

    $query = "SELECT * FROM coins_table WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_assoc();

    $name = $row["name"];

    $queryLogs = "SELECT * FROM logs WHERE name = '$name' ORDER BY id DESC";
    $resultLogs = mysqli_query($conn, $queryLogs);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link rel="icon" type="image/x-icon" href="images/title-logo.png">
    <link rel="stylesheet" href="styles/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="navbar">
        <div class="navbar-logos">
            <img class="hamburger-button" src="images/hamburger_button.png">
            <a href="index.php"><img class="site-logo" src="images/title-logo.png"></a>
            <a href="index.php"><h2>Crypto Asset Manager</h2></a>
        </div>
        
        <div class="navbar-menus">
            <a>Log In</a>
            <button>Sign Up</button>
        </div>
    </div>
    
    <main>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <img src="images/search-icon.png">
        </div>

        <div class='selected-coin'>
            <div>
                <img src="images/test-coin-icon.png">
                <h3><?php echo $row["name"] ?></h3>
            </div>
            
            <h2>₱<?php echo $row["number"]*$row["price"]?></h2>
            <br>
            <br>
            <p>Amount: <?php echo $row["number"] ?></p>
            <p>Price: ₱<?php echo $row["price"] ?></p>
        </div>
        
        <div class="edit-buttons">
            <button class="add-button">Add</button>
            <button class="deduct-button">Deduct</button>
            <button class="update-price-button">Update Price</button>
            <button class="new-base-button">New Base</button>
        </div>

        <div class="logs-table">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Main Investment</th>
                        <th>Deducted</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Total Value</th>
                    </tr>
                </thead>
            <?php 
                foreach($resultLogs as $row) {
                    $timestampString = $row["timestamp"];
                    $timestamp = strtotime($timestampString);
                    $monthName = date("F", $timestamp);
                    $dayOfMonth = date("d", $timestamp);
                    $year = date("Y", $timestamp);
                    echo "<tbody>
                    <tr>
                        <td>". $monthName. " " . $dayOfMonth . ", " . $year ."</td>
                        <td>₱".$row["main_investment"]."</td>
                        <td>₱".$row["deducted_value"]."</td>
                        <td>".$row["number"]."</td>
                        <td>₱".$row["price"]."</td>
                        <td>₱".round($row["number"]*$row["price"], 2)."</td>
                    </tr>
                </tbody>";
                }
            ?>
                
            </table>
        </div>

        <hr>

        <div class="options">
            <button class="delete-button">Delete</button>
        </div>

        <div class="delete-popup">
            <p>Are you sure you want to Delete?</p>
            <div>
                <a href="delete.php?id=<?php echo $id; ?>"><button>Yes</button></a>
                <button class="no">No</button>
                <img class="x-button" src="images/x-button.png">
            </div>
        </div>

        
        <div class="add-popup">
            <div>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="add_amount">Add Amount Value:</label>
                    <input type="text" name="add_amount" id="add_amount">
                    <input type="submit" value="Add">
                </form>
                <img class="x-button" src="images/x-button.png">
            </div>
        </div>

        <div class="deduct-popup">
            <div>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="deduct_amount">Deduct Amount Value:</label>
                    <input type="text" name="deduct_amount" id="deduct_amount">
                    <input type="submit" value="Deduct">
                </form>
                <img class="x-button" src="images/x-button.png">
            </div>
        </div>

        <div class="update-price-popup">
            <div>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="update_price">Update Price Value:</label>
                    <input type="text" name="update_price" id="update_price">
                    <input type="submit" value="Update">
                </form>
                <img class="x-button" src="images/x-button.png">
            </div>
        </div>

        <div class="new-base-popup">
            <div>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="">Set New Base:</label>
                    <input type="text" name="new_main_investment" id="new_main_investment">
                    <input type="submit" value="Set">
                </form>
                <img class="x-button" src="images/x-button.png">
            </div>
        </div>

        <div class="overlay2"></div>

    </main>

    <div class="menu-bar">
        <div class="site-name">
            <img class="x-button" src="images/x-button.png">
            <a href="index.php"><img class="site-logo" src="images/title-logo.png"></a>
            <a href="index.php"><h2>Crypto Asset Manager</h2></a>
        </div>
        
            <div class="sidebar-path">
                <a href="index.php">
                    <div class="home-page-div">
                        <p class="home-page">Home</p>
                        <hr>
                    </div>
                </a>

                <a href="edit-page.php?id=<?php echo $row["id"]; ?>">
                    <div class="edit-page-div">
                        <p class="edit-page">Edit Page</p>
                        <hr>
                    </div>
                </a>
            </div>
        
        <div class="menu-bar-buttons">
            <button>Sign Up</button>
            <button>Log In</button>
        </div>
    </div>

    <div class="overlay"></div>
    
    <script src="scripts/script.js"></script>
</body>
</html>