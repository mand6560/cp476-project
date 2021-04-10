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
        
        if (!empty($_POST['search_box'])) {
            $name = $_POST['search_box'];

            $textbooks = (New DbQuery())->getResults($name);
        
            foreach ($textbooks as $textbook) {
                echo nl2br('<tr style="text-align:center;"><td>' .  $textbook->title . '</td><td>' . $textbook->author . '</td><td>' . $textbook->isbn . '</td><td>' . "$" . $textbook->price . '</td><td>' . $textbook->stock.'</td><td>' . $textbook->subject.'</td><td style="text-align:left;">' . $textbook->description."</td></tr>");
                $resultsFound = TRUE;
            }
        }
        if ($resultsFound) {
            print("Results Found:");
        } else {
            print("No Results Found");
        }
        ?>

    </table>

</body>

</html>