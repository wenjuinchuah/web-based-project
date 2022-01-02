<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="src/style.css">
        <link rel="icon" href="src/icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            main {
                background: linear-gradient( to top , rgb(241, 241, 241)90%, rgb(196, 196, 196));
            }

            .product-div {
                background-color: gray; 
                width: 70%; 
                position: relative; 
                left: 50%; 
                transform: translateX(-50%);
                border-radius: 12px;
            }

            .product-div button{
                margin-top: 5px;
                padding: 3px;
            }

            main div {
                display: inline-block;
                padding: 20px 5%;
                width: 30%;
                text-align: center;
                background-color: white;
                margin: 10px;
                border-radius: 5px;
            }

            /* AddtoCart View */
            #addtoCart, #successView {
                background-color: #d3d3d3a0;
                margin: 0;
                padding: 0;
                position: fixed;
                top: 0;
                width: 100%;
                height: 100%;
                align-content: center;
                justify-items: center;
                display: none;
            }

            .addtoCart-container {
                background-color: rgb(168, 168, 168);
                margin: 150px auto;
                padding: 10px 20px;
                height: auto;
                max-width: 400px;
                min-width: 400px;
                border-radius: 10px;
            }

            .addtoCart-container h2 {
                padding: 10px 0;
                text-align: center;
                font-weight: bold;
            }

            .addtoCart-container input {
                border: none;
                border-radius: 5px;
                font-weight: bold;
                font-size: medium;
                margin: 5px auto;
                padding-left: 5px;
                width: 100%;
                height: 30px;
            }

            .addtoCart-container input::placeholder {
                color: darkgray;
                font-weight: normal;
            }

            .addtoCart-container label {
                font-weight: bold;
            }

            button {
                cursor: pointer;
            }
        </style>

    </head>

    <?php include 'header.php'; ?>

    <body>
        <main>
            <h2 style="text-align: center; padding-top: 10px">Product List</h2>
            <div class="product-div" id="product">
                <?php
                    include 'validation/connectSQL.php';

                    $sql = "SELECT * FROM products";
                    $result = mysqli_query($conn, $sql);
                    $i = 0;

                    while ($row = mysqli_fetch_row($result)) {
                        $ID[$i] = $row[0];
                        $_SESSION['productID'.strval($i)] = $ID[$i];
                        $stock[$i] = $row[3];
                        $price = number_format($row[2], 2, '.', '');
                        $path = 'productPic/'.$row[4];

                        echo "<div>";
                        echo "<img src='$path' width='200px' height='150px'/>";
                        echo "<p>ID: $row[0]</p>";
                        echo "<p>Name: $row[1]</p>";
                        echo "<p>Price: RM $price</p>";
                        echo "<p>Stock: $row[3]</p>";

                        if ($row[3] == 0) {
                            echo "<button type='button' class='button' id='button$i' disable)'>Out of Stock</button>";
                        } else {
                            echo "<button type='button' class='button' id='button$i' onclick='addCartView($ID[$i], $stock[$i])'>Add to Cart</button>";
                        }

                        echo "</div>";
                        $i++;
                    }
                ?>
            </div>
        </main>

        <footer>
            <div class="footer-container">
                <div class="icon" id="contactus">
                    <h3 class="pacifico_normal">Contact Us</h3>
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p>Lot 3, Jalan Pelabur 23/1, 40300 Shah Alam, Selangor Darul Ehsan Malaysia</p>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p>customer_service@gardenia.com.my</p>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <p>03-55423228</p>
                    </div>
                </div>
                <div class="subscribe">
                    <h3 class="pacifico_normal">Subscribe</h3>
                    <form>
                        <input type="email" id="email" name="email" placeholder="Enter your Email ">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="bottom">
                <div class="social-media">
                    <div class="social-media-container">
                        <a href="https://www.facebook.com/GardeniaKL" title="Facebook" target=_blank><img src="src/fb.png" alt="Facebook"></a>
                        <a href="https://www.instagram.com/gardenia_kl/" title="Instagram" target=_blank><img src="src/ig.png" alt="Instagram"></a>
                        <a href="https://twitter.com/gardenia_kl" title="Twitter" target=_blank><img src="src/tw.png" alt="Twitter"></a>
                        <a href="https://www.youtube.com/user/GardeniaKL" title="Youtube" target=_blank><img src="src/yt.png" alt="Youtube"></a>
                    </div>
                </div>
                <p>Copyright &copy (2004-2018) Gardenia Bakeries (KL) Sdn. Bhd (139386X) All Rights Reserved. | <a href="#">PRIVACY</a></p>
            </div>
        </footer>

        <!--Add to Cart View-->
        <div id="addtoCart">
            <div class="addtoCart-container">
                <i class="fa fa-times" onclick="turnOff()"></i>
                <form action="user/addCart.php" method="POST">
                    <h2>Add to Cart</h2>
                    <div>
                        <label>Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="1"/>
                        <?php if (isset($productNameError)) {?>
                            <small id="productNameError"><?php echo $productNameError ?></small>
                        <?php } ?>
                    </div>
                    <div class="button">
                        <input type="submit" id="submit" name="submit" value="Add Product"></input>
                    </div>
                </form>
            </div>
        </div>


        <script>
            function turnOff() {
                document.getElementById("addtoCart").style.display = "none";
            }

            function addCartView(ID, i) {
                document.getElementById("addtoCart").style.display = "block";
                document.getElementById("quantity").max = i;

                createCookie("productID", ID, "0.1");
            }

            // Function to create the cookie
            function createCookie(name, value, days) {
                var expires;
                
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                }
                else {
                    expires = "";
                }
                
                document.cookie = escape(name) + "=" + 
                    escape(value) + expires + "; path=/";
            }
        </script>
    </body>
</html>