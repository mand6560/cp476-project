<html>

<head>
    <title>Hello world in PHP</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Search Results</h1>

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

        // get all
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        $all = $conn->executeQuery("$dbname.$collection", $read);

        foreach ($all as $textbook) {
            echo nl2br('<tr><td>' . var_dump($textbook->book_id) . '</td><td>' . $textbook->title . '</td><td>' . $textbook->author . '</td><td>' . $textbook->isbn . '</td><td>' . $textbook->price . '</td><td>' . $textbook->stock.'</td><td>' . $textbook->subject.'</td><td>' . $textbook->description."</td></tr>\n");
        }

        ?>

    </table>

</body>

</html>