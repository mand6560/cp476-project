<html>

<head>
    <title>Search Results</title>
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
    <table>
        <tr>
            <td>book_id</td>
            <td>title</td>
            <td>author</td>
            <td>isbn</td>
            <td>price</td>
            <td>stock</td>
            <td>subject</td>
            <td>description</td>
        </tr>

        <?php
        include_once 'MDBManager.php';
        
        $dbname = 'studentsaver';
        $collection = 'Products';

        $dbm = new MDBManager();
        $conn = $dbm->getConnection();

        
        //"title" => $name
        
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        $all = $conn->executeQuery("$dbname.$collection", $read);
        $foo = FALSE;
        
        if(!empty($_POST['search_box'])){
            $name = $_POST['search_box'];
        
            foreach ($all as $textbook) {
                
                if(strpos(strtolower($textbook->book_id), strtolower($name)) !== False || strpos(strtolower($textbook->title), strtolower($name)) !== False || strpos(strtolower($textbook->author), strtolower($name)) !== False || strpos(strtolower($textbook->isbn), strtolower($name)) !== False || strpos(strtolower($textbook->price), strtolower($name)) !== False || strpos(strtolower($textbook->stock), strtolower($name)) !== False || strpos(strtolower($textbook->subject), strtolower($name)) !== False || strpos(strtolower($textbook->description), strtolower($name)) !== False){
                    echo nl2br('<tr><td>' . $textbook->book_id . '</td><td>' . $textbook->title . '</td><td>' . $textbook->author . '</td><td>' . $textbook->isbn . '</td><td>' . $textbook->price . '</td><td>' . $textbook->stock.'</td><td>' . $textbook->subject.'</td><td>' . $textbook->description."</td></tr>");
                    $foo = TRUE;
                } 
            }
        }
        if($foo == TRUE){
            print("Results Found:");
        } else {
            print("No Results Found");
        }
        ?>

    </table>

</body>

</html>