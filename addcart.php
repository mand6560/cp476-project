<?php 

include_once('dbQuery.php');

$book_id = $_POST['book_id'];
$customer_id = $_POST['customer_id'];

$dbQuery = new DbQuery();

echo 'added to cart';
$dbQuery->addToCart((int)$customer_id, (int)$book_id);

?>