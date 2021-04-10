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
    private const DB_NAME = 'studentsaver';
    private const PRODUCTS_COLLECTION = 'Products';
    private const CUSTOMER_COLLECTION = 'Customer';

    private function makeConnection() {
        $dbm = new MDBManager();
        $conn = $dbm->getConnection();

        return $conn;
    }

    function getResults($search_query) {
        $conn = $this->makeConnection();
        $query = new MongoDB\Driver\Query([]);
        $all = $conn->executeQuery(self::DB_NAME . "." . self::PRODUCTS_COLLECTION, $query);

        $textbooks = [];
        
        if (!empty($search_query)) {
            foreach ($all as $textbook) {
                if(strpos(strtolower($textbook->book_id), strtolower($search_query)) !== False ||
                 strpos(strtolower($textbook->title), strtolower($search_query)) !== False ||
                 strpos(strtolower($textbook->author), strtolower($search_query)) !== False || 
                 strpos(strtolower($textbook->isbn), strtolower($search_query)) !== False || 
                 strpos(strtolower($textbook->price), strtolower($search_query)) !== False || 
                 strpos(strtolower($textbook->stock), strtolower($search_query)) !== False || 
                 strpos(strtolower($textbook->subject), strtolower($search_query)) !== False || 
                 strpos(strtolower($textbook->description), strtolower($search_query)) !== False) {
                    $textbooks[] = $textbook;
                } 
            }
        }

        return $textbooks;
    }

    function getBookByID($bookID) {
        $conn = $this->makeConnection();
        $filter = ['book_id' => $bookID];
        $query = new MongoDB\Driver\Query($filter);
        $result = $conn->executeQuery(self::DB_NAME . "." . self::PRODUCTS_COLLECTION, $query);

        return $result;
    }

    // Get the contents of the customer's cart
    function getCustomerCartItems($customer_id) {
        $conn = $this->makeConnection();
        $filter = ['customer_id' => $customer_id];
        $option = [];
        $query = new MongoDB\Driver\Query($filter, $option);
        $customer_info = $conn->executeQuery(self::DB_NAME . "." . self::CUSTOMER_COLLECTION, $query);

        $collection = 'Products';
        foreach ($customer_info as $customer) {
            $items = [];
            foreach ($customer->cart_contents as $book_id) {
                $filter = ['book_id' => $book_id];
                $option = [];
                $query = new MongoDB\Driver\Query($filter, $option);
                $book_info = $conn->executeQuery(self::DB_NAME . "." . self::PRODUCTS_COLLECTION, $query);

                foreach ($book_info as $book) {
                    //$item = [$book->title, $book->author, $book->price];
                    $item = ["title" => $book->title, "author" => $book->author, "price" => $book->price];
                    array_push($items, $item);
                }
            }
            return $items;
        }
    }
}

?>