class dbQuery {

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
}