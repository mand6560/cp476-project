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
            <td>title</td>
            <td>author</td>
            <td>isbn</td>
            <td>price</td>
            <td>stock</td>
            <td>subject</td>
            <td>description</td>
            <td>cart</td>
        </tr>

        <?php
        include_once 'dbQuery.php';        

        $resultsFound = FALSE;
        
        if (!empty($_POST['search_box'])) {
            $name = $_POST['search_box'];

            $textbooks = (New DbQuery())->getResults($name);
        
            foreach ($textbooks as $textbook) {
                echo nl2br('<tr><td>' .  $textbook->title . '</td><td>' . $textbook->author . '</td><td>' . $textbook->isbn . '</td><td>' . "$" . $textbook->price . '</td><td>' . $textbook->stock.'</td><td>' . $textbook->subject.'</td><td>' . $textbook->description."</td></tr>");
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