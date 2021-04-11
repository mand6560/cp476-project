<!DOCTYPE html>
<html>
    <head>
        <title>Checkout - StudentSaver</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
            header( "refresh:5;url=index.php" );
        ?>
        <div class="header" onclick="window.location.href = './index.php';">
            <h1>StudentSaver</h1>
            <hr />
        </div>
        <?php
            include_once 'dbQuery.php';
            $result = $_POST["success"];

            if(!isset($_COOKIE["customer_id"])) {
                return;
            } else {
                $customer_id = intval($_COOKIE["customer_id"]);
            }

            if ($result = "true") {
                // Update stock levels
                (New DbQuery())->updateStock($customer_id);
                // Clear out the customer's cart
                (New DbQuery())->clearCart($customer_id);

                echo nl2br('<p>Your order was successfuly placed!</p>');
                echo nl2br('<p>You will now be taken back to the home page...</p>');
            }
        ?>
    </body>
</html>