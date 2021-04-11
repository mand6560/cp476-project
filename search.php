<!DOCTYPE html>
<html>

<head>
    <title>Search Results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="style.css">
    <style>
        table,
        th,
        td {
            border: 1px solid white;
        }
    </style>
    
    <script type="text/javascript">

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }

            return "";
        }       
        
        async function checkCookie() {
            if (getCookie("customer_id") == "") {
                await alert('You are not signed in! Redirecting back to the home page.');
                window.location.href = './index.php';
            }
        }

        function sendinfo(book_id, customer_id){
        //    let book = document.getElementById('book').value;
           
           let xhttp = new XMLHttpRequest();

           xhttp.open("POST", "addcart.php", true);
           
           xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           xhttp.send(`book_id=${book_id}&customer_id=${customer_id}`);

           xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4) {
                    if (xhttp.status == 200) {
                        if (xhttp.responseText == 'added to cart') {
                            alert('Added to cart');
                        } else {
                            alert(xhttp.responseText);
                        }
                    } else {
                        alert('An error occured'); 
                    }
                }
            };

        }
    </script>

</head>

<body onload="checkCookie()">
    <div class="header" onclick="window.location.href = './index.php';">
            <h1>StudentSaver</h1>
            <hr />
        </div>
    <h1>Search Results</h1>
    <form action="search.php" method="post">
        <div class="search">
            <input type = "Text" placeholder = "Search for textbooks" value = "" name="search_box"/>
            <input class="button buttonSearch" type="submit" value="Search"/>
        </div>
    </form>
    <form action="checkout.php" method="post">
        <div class="checkout">
        <input class="button" type="submit" name="checkout_box" value="Checkout"/>
        </div>
    </form>
    <table style="width: 100%">
        <tr style="font-weight:bold">
            <td style="text-align:center;">title</td>
            <td style="text-align:center;">author</td>
            <td style="text-align:center;">isbn</td>
            <td style="text-align:center;">price</td>
            <td style="text-align:center;">stock</td>
            <td style="text-align:center;">subject</td>
            <td style="text-align:center;">description</td>
            <td style="text-align:center;">cart</td>
        </tr>

        <?php
        include_once 'dbQuery.php';        

        $resultsFound = FALSE;

        if(!isset($_COOKIE["customer_id"])) {
            return;
        } else {
            $customer_id = intval($_COOKIE["customer_id"]);
        }

        $name = $_POST['search_box'];

        //if search bar is not empty
        if (!empty($name)) {
            //take text from search bar and query
            

            $textbooks = (New DbQuery())->getResults($name);
            //display matching textbooks
            foreach ($textbooks as $textbook) {
                //<form method="post">
                echo nl2br('<tr style="text-align:center;"><td name="book">' .  $textbook->title . '</td><td>' . $textbook->author . '</td><td>' . $textbook->isbn . '</td><td>' . "$" . $textbook->price . '</td><td>' . $textbook->stock.'</td><td>' . $textbook->subject.'</td><td style="text-align:left;">' . $textbook->description."</td>");
                $resultsFound = TRUE;
                //check if textbook is in stock and display button or sold out 
                if($textbook->stock > 0){
                    //onclick="addToCart($customer_id, $textbook->book_id)
                    
                    echo '<td><input type="submit" value="Add to cart" onclick="sendinfo(' . $textbook->book_id .', ' . $customer_id . ');" class="button" name="cart"/></td></tr>';
                    
                } else {
                    echo '<td>Sold out!</td></tr>';
                }
            }
            
        }
        //printing if results are found or not 
        if ($resultsFound) {
            print("Results found for '$name':");
        } else {
            print("No results found for '$name':");
        }
        ?>

    </table>
    <hr />
    <footer>
        <p>COPYRIGHT &#169; 2021 StudentSaver</p>
        <p>All rights reserved.</p>
    </footer>
</body>

</html>