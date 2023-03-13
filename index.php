<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONT BUY COMPARE</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar__container">
            <a href="http://localhost/WBPBL/" id="navbar__logo">COMPARE.co</a>
            <div class="navbar_toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar__menu">
                <li class="navbar__item">
                    <a href="http://localhost/WBPBL/" class="navbar__links">HOME</a>
                </li>
                <li class="navbar__btn">
                    <a href="/" class="button">JOIN US</a>
                </li>
            </ul>
        </div>
    </nav>
    <section class="parallax">
        <img src="hill1.png" id="hill1">
        <img src="hill2.png" id="hill2">
        <img src="hill3.png" id="hill3">
        <img src="hill4.png" id="hill4">
        <img src="hill5.png" id="hill5">
        <img src="tree.png" id="tree">
        <h2 id="text">DONT JUST BUY</h2>
        <h2 id="text1">COMPARE</h2>
        <img src="leaf.png" id="leaf">
        <img src="plant.png" id="plant">
    </section>
    <script src="script.js"></script>
    
    <section class="main">
        <form class="w3-container w3-card-4" action="index.php" method="get">
            <div class="searchbox">
                <input type="text" placeholder="Product Name..." name="search_data">
                <ion-icon name="search-outline" id="icon1"></ion-icon>
            </div>
            <div class="submit">
                <input type="submit" class="sub" value="submit">
            </div>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        </form>
        <div class="php">
            <?php
                if(isset($_GET['search_data']) && $_GET['search_data']!=NULL)
                {
                    $searchitem=$_GET['search_data'];
                    $searchitem=strtolower($searchitem);
                    $searchitem=str_ireplace(" ","+",$searchitem);
                    $web_page_data = file_get_contents("http://www.pricetree.com/search.aspx?q=".$searchitem);
                    $item_list = explode('<div class="items-wrap">',$web_page_data);
                    for($i=1;$i<5;$i++)
                    {   
                        //echo $item_list[$i]."</br>";
                        $url_link1 = explode('href="',$item_list[$i]);
                        $url_link2 = explode('"',$url_link1[1]);
                        //echo $url_link2[0]."</br>";
                        $img_link1 = explode('data-original="',$item_list[$i]);
                        $img_link2 = explode('"',$img_link1[1]);
                        //title
                        $title_temp = explode('title="',$item_list[$i]);
                        $item_title = explode('"',$title_temp[1]);
                        //avaliability
                        $aval_temp = explode('avail-stores">',$item_list[$i]);
                        $aval = explode('</div>',$aval_temp[1]);
                        if(strcmp($aval[0],"Not available") == 0)
                        {
                            continue ;
                        }


                        $item_link = $url_link2[0];
                        $item_img_link = $img_link2[0];
                        $item_id_temp = explode("-",$item_link);
                        $item_id = end($item_id_temp);
                        //echo $item_title[0]."</br>";
                        //echo $item_link."</br>";
                        //echo $item_img_link."</br>";
                        //echo $item_id."</br>";

                        $request = "http://www.pricetree.com/dev/api.ashx?pricetreeId=$item_id&apikey=7770AD31-382F-4D32-8C36-3743C0271699";
                        $response = file_get_contents($request);
                        $results = json_decode($response, TRUE);
                        foreach($results['data'] as $itemdata ){
                            $seller = $itemdata['Seller_Name'];
                            $price = $itemdata['Best_Price'];
                            $link = $itemdata['Uri'];
                            //echo "SELLER NAME: ".$seller."</br>"."PRICE: ".$price."</br>"."PRODUCT LINK: ".$link."</br>";
                            echo '
                                    <table class="content-table">
                                        <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Seller Name</th>
                                                <th>Price</th>
                                                <th>BUY HERE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><img src="'.$item_img_link.'" alt=""></td>
                                                <td>'.$seller.'</td>
                                                <td>'.$price.'</td>
                                                <td><a href="'.$link.'">BUY</a></td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }
                    }

                }
                
                else
                {
                    echo '<script type="text/javascript">alert("Enter Valid input !!!")</script>';
                }
            ?>
        </div>
    </section>
    <footer>
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
        <ul class="social_icon">
            <li><a href="https://www.facebook.com"><ion-icon name="logo-facebook"></ion-icon></a></li>
            <li><a href="https://www.twitter.com"><ion-icon name="logo-twitter"></ion-icon></a></li>
            <li><a href="https://www.instagram.com"><ion-icon name="logo-instagram"></ion-icon></a></li>
            <li><a href="https://www.twitch.tv/suprakid69"><ion-icon name="logo-twitch"></ion-icon></a></li>
        </ul>
        <p>Copyright@1BY21CS127/1BY21CS132 | All Rights Reserved</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
</body>
</html>
