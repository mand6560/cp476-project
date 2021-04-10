<!-- class dbQuery {

    private function makeConnection() {
        $dbname = 'cp476';
        $collection = 'users';

        $dbm = new MDBManager();
        $conn = $dbm->getConnection();

        return $conn
    }

    function getResults(params[title, author, isbn, ...]) {
        $conn = makeConnection();

        

        foreach field() {
            list <- mongo.find(field, "foobar")
        }

        return list
    }

    function getBook(bookID) {
        $conn = makeConnection();

        return book details
    }

    private function lookforthis(this) {
        return result
    }
} -->
<?php
include_once 'MDBManager.php';

class DbQuery {
    const DB_NAME = 'studentsaver';
    const PRODUCTS_COLLECTION = 'Products';

    private function makeConnection() {
        $dbm = new MDBManager();
        $conn = $dbm->getConnection();

        return $conn;
    }

    function getResults($search_query) {
        $conn = $this->makeConnection();

        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        $all = $conn->executeQuery(self::DB_NAME . "." . self::PRODUCTS_COLLECTION, $read);

        $textbooks = [];
        
        if (!empty($search_query)) {
            foreach ($all as $textbook) {
                if(strpos(strtolower($textbook->book_id), strtolower($search_query)) !== False || strpos(strtolower($textbook->title), strtolower($search_query)) !== False || strpos(strtolower($textbook->author), strtolower($search_query)) !== False || strpos(strtolower($textbook->isbn), strtolower($search_query)) !== False || strpos(strtolower($textbook->price), strtolower($search_query)) !== False || strpos(strtolower($textbook->stock), strtolower($search_query)) !== False || strpos(strtolower($textbook->subject), strtolower($search_query)) !== False || strpos(strtolower($textbook->description), strtolower($search_query)) !== False){
                    $textbooks[] = $textbook;
                } 
            }
        }

        return $textbooks;
    }
}

?>