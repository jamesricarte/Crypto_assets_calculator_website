<?php 
    require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Asset Manager</title>
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

        <div class="add-coin">
            <h4>Add Coin</h4>
            <form action="insert.php" method="post">
                <div>
                    <label for="coin">Coin</label>
                    <input type="text" id="coin" name="name">
                </div>
                <div>
                    <label for="amount">Amount</label>
                    <input type="text" id="amount" name="number">
                </div>
                <div>
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price">
                </div>
            </form>
        </div>

        <?php 
            $query = "SELECT * FROM coins_table";
            $result = mysqli_query($conn, $query);

            foreach ($result as $row) {
                echo "<a class='coins-table' href='edit-page.php?id=$row[id]'>
                        <div>
                            <div class='info name'>
                                <div>
                                    <img src='images/test-coin-icon.png'>
                                </div>

                                <div class='coin-info'>
                                    <p class='title'>Coin Name</p>
                                    <p>".$row["name"]."</p>
                                </div>
                            </div>

                            <div class='coin-info amount info'>
                                <p class='title'>Amount</p>
                                <p>".$row["number"]."</p>
                            </div>

                            <div class='coin-info price info'>
                                <p class='title'>Price</p>
                                <p>₱".$row["price"]."</p>
                            </div>

                            <div class='coin-info info'>
                                <p class='title'>Total Value</p>
                                <p>₱".round($row["number"]*$row["price"], 2)."</p>
                             </div>
                        </div>
                    </a>";
            }
        ?>
        
    </main>

    <div class="menu-bar">
        <div class="site-name">
            <img class="x-button" src="images/x-button.png">
            <a href="index.php"><img class="site-logo" src="images/title-logo.png"></a>
            <a href="index.php"><h2>Crypto Asset Manager</h2></a>
        </div>

        <div class="menu-bar-buttons">
            <button>Sign Up</button>
            <button>Log In</button>
        </div>
    </div>

    <div class="overlay"></div>
    
    <div class="icon-animation">
        <img class="click-icon" src="images/test-coin-icon.png">

        <div class="selectors">
            <img src="images/test-coin-icon.png" alt="Icon 1" onclick="selectIcon('test-coin-icon.png','images/')">
            <img class="icon-2" src="images/title-logo.png" alt="Icon 2" onclick="selectIcon('title-logo.png','images/')">
        </div>
    </div>
    

    <script>
        function selectIcon(fileName, filePath) {

            var xhr = new XMLHttpRequest();
            xhr.open ("POST", "update_icon.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

            xhr.send("fileName=" + fileName + "&filePath=" + filePath);
        }

        const clickIcon = document.querySelector('.click-icon');
        const selectors = document.querySelector('.selectors');

        function clickIconClicked() {
            selectors.classList.toggle('active');
        }

        clickIcon.addEventListener("click", clickIconClicked )
    </script>
    
    <script src="scripts/script.js"></script>
</body>
</html>