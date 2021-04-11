<?php

include_once('dbQuery.php');

$email = strtolower($_POST['email']);
$pass = sha1($_POST['pass']);

$dbQuery = New DbQuery();

$customer_id = $dbQuery->signIn($email, $pass);
if ($customer_id == -1) {
    echo 'unknown user';
} else {
    $cookie_name = "customer_id";
    $cookie_value = $customer_id;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    echo 'success';
}


?>