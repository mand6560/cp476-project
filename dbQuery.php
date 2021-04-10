<?php
include_once 'MDBManager.php';

class DbQuery {
    private const DB_NAME = 'studentsaver';
    private const PRODUCTS_COLLECTION = 'Products';
    private const CUSTOMERS_COLLECTION = 'Customer';

    private function makeConnection() {
        $dbm = new MDBManager();
        $conn = $dbm->getConnection();

        return $conn;
    }

    function getResults($search_query) {
        $textbooks = [];
        
        if (!empty($search_query)) {
            $conn = $this->makeConnection();
            $query = new MongoDB\Driver\Query([]);
            $all = $conn->executeQuery(self::DB_NAME . "." . self::PRODUCTS_COLLECTION, $query);

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

    function getBookByID($book_id) {
        $conn = $this->makeConnection();
        $filter = ['book_id' => $book_id];
        $query = new MongoDB\Driver\Query($filter);
        $result = $conn->executeQuery(self::DB_NAME . "." . self::PRODUCTS_COLLECTION, $query);

        return $result;
    }

    function addToCart($customer_id, int $book_id) {
        $conn = $this->makeConnection();

        // load user cart array
        $filter = ['customer_id' => $customer_id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $conn->executeQuery(self::DB_NAME . "." . self::CUSTOMERS_COLLECTION, $query);
        $cursor->rewind();
        $cart_obj = $cursor->current();
        $cart_contents = $cart_obj->cart_contents;

        // append new book to user cart array
        array_push($cart_contents, $book_id);

        // replace user cart array with newly appended one
        $bulk = new MongoDB\Driver\BulkWrite();
        $bulk->update($filter, ['$set' => ['cart_contents' => $cart_contents]]);
        $result = $conn->executeBulkWrite(self::DB_NAME . "." . self::CUSTOMERS_COLLECTION, $bulk);
    }
}

?>