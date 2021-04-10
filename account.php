<?php
 
include_once('dbQuery.php');

$first_name = strtolower($_POST['first_name']);
$last_name = strtolower($_POST['last_name']);
$email = strtolower($_POST['email']);
$pass = sha1($_POST['pass']);

$name = "$first_name $last_name";

$dbQuery = New DbQuery();

$exists = $dbQuery->customerExists($email);

if ($exists) {
    echo 'exists';
} else {
    if ($dbQuery->createAccount($name, $email, $pass)) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

?>