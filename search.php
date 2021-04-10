<html>

<head>
    <title>Search Results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="checkout.css">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
    
    <script>
        function search() {
            document.getElementById('search').value;
        }
        
    </script>

</head>

<body>
    <div class="header">
            <h1>StudentSaver</h1>
            <hr />
        </div>
    <h1>Search Results</h1>
    <form action="search.php" method="post">
        <div class="search">
            <input type = "Text" placeholder = "Search for textbooks" value = "" name="search_box"/>
            <input type="submit" value="Search"/>
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
        
        $name = $_POST['search_box'];
        if (!empty($name)) {
            $textbooks = (New DbQuery())->getResults($name);
        
            foreach ($textbooks as $textbook) {
                echo nl2br('<tr style="text-align:center;"><td>' .  $textbook->title . '</td><td>' . $textbook->author . '</td><td>' . $textbook->isbn . '</td><td>' . "$" . $textbook->price . '</td><td>' . $textbook->stock.'</td><td>' . $textbook->subject.'</td><td style="text-align:left;">' . $textbook->description."</td>");
                $resultsFound = TRUE;
                if($textbook->stock > 0){
                    echo '<td><input type="submit" value="Add to cart"/></td></tr>';
                } else {
                    echo '<td>Sold out!</td></tr>';
                }
            }
        }
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