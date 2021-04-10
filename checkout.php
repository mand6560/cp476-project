<!DOCTYPE html>
<html>
    <head>
        <title>Checkout - StudentSaver</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" href="checkout.css">
        <script>
            function billingCheckboxClicked(cb) {
                document.getElementById('bill-first').disabled = cb.checked;
                document.getElementById('bill-first').value = "";
                document.getElementById('bill-last').disabled = cb.checked;
                document.getElementById('bill-last').value = "";
                document.getElementById('bill-address').disabled = cb.checked;
                document.getElementById('bill-address').value = "";
                document.getElementById('bill-city').disabled = cb.checked;
                document.getElementById('bill-city').value = "";
                document.getElementById('bill-province').disabled = cb.checked;
                document.getElementById('bill-province').value = "";
                document.getElementById('bill-postal').disabled = cb.checked;
                document.getElementById('bill-postal').value = "";
                document.getElementById('bill-phone').disabled = cb.checked;
                document.getElementById('bill-phone').value = "";
            }

            function placeOrder(btn) {
                if (!document.getElementById('auth-box').checked) {
                    alert("You need to agree to the charges to be made to your card!");
                    return false;
                }
                
                if (validateInputs()) {
                    alert("Your order was successfully placed! Thank you for shopping with us :)");
                    console.log("The order was placed");

                    return true;
                } else {
                    return false;
                }
            }

            function validateInputs() {

                // Validate shipping info
                if (document.getElementById('ship-first').value == "") {
                    alert("Please enter your first name and try again.");
                    return false;
                }

                if (document.getElementById('ship-last').value == "") {
                    alert("Please enter your last name and try again.");
                    return false;
                }

                if (document.getElementById('ship-address').value == "") {
                    alert("Please enter your address and try again.");
                    return false;
                }

                if (document.getElementById('ship-city').value == "") {
                    alert("Please enter your city/town and try again.");
                    return false;
                }

                if (document.getElementById('ship-province').value == "") {
                    alert("Please enter your province/territory and try again.");
                    return false;
                }

                if (document.getElementById('ship-postal').value == "") {
                    alert("Please enter your postal code and try again.");
                    return false;
                }
                
                if (!document.getElementById('ship-postal').value.match(/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/)) {
                    alert("Your postal code is invalid. Please try again.");
                    return false;
                }

                if (document.getElementById('ship-phone').value == "") {
                    alert("Please enter your phone number and try again.");
                    return false;
                }
                
                if (!document.getElementById('ship-phone').value.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
                    alert("Your phone number is invalid. Please try again.");
                    return false;
                }

                // Validate payment details
                if (document.getElementById('credit-num').value == "") {
                    alert("Please enter your credit/debit card number.");
                    return false;
                }

                if (!document.getElementById('credit-num').value.match(/\b\d{4}[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}\b/)) {
                    alert("Your credit card number is invalid. Please try again.");
                    return false;
                }

                if (document.getElementById('expiry-date').value == "") {
                    alert("Please enter your credit/debit expiry date.");
                    return false;
                }

                if (!document.getElementById('expiry-date').value.match(/^(0[1-9]|1[0-2])\/\d{2}$/)) {
                    alert("Your credit card expiry date is invalid. Please try again.");
                    return false;
                }

                if (document.getElementById('cvv-num').value == "") {
                    alert("Please enter your credit/debit CVV number.");
                    return false;
                }

                if (!document.getElementById('cvv-num').value.match(/^\d{3}$/)) {
                    alert("Your credit card CVV number is invalid. Please try again.");
                    return false;
                }

                // Validate billing info
                if (document.getElementById('billing-box').checked) {
                    return true;
                }

                if (document.getElementById('bill-first').value == "") {
                    alert("Please enter your first name and try again.");
                    return false;
                }

                if (document.getElementById('bill-last').value == "") {
                    alert("Please enter your last name and try again.");
                    return false;
                }

                if (document.getElementById('bill-address').value == "") {
                    alert("Please enter your address and try again.");
                    return false;
                }

                if (document.getElementById('bill-city').value == "") {
                    alert("Please enter your city/town and try again.");
                    return false;
                }

                if (document.getElementById('bill-province').value == "") {
                    alert("Please enter your province/territory and try again.");
                    return false;
                }

                if (document.getElementById('bill-postal').value == "") {
                    alert("Please enter your postal code and try again.");
                    return false;
                }
                
                if (!document.getElementById('bill-postal').value.match(/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/)) {
                    alert("Your postal code is invalid. Please try again.");
                    return false;
                }

                if (document.getElementById('bill-phone').value == "") {
                    alert("Please enter your phone number and try again.");
                    return false;
                }
                
                if (!document.getElementById('bill-phone').value.match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
                    alert("Your phone number is invalid. Please try again.");
                    return false;
                }
                
                return true;
            }
        </script>

    </head>

    <body>
        <div class="header">
            <h1>StudentSaver</h1>
            <hr />
        </div>

        <div class="cart">
            <h2>Your Books:</h2>
            <table style="width: 100%">
                <tr style="font-weight:bold">
                    <td>Title</td>
                    <td>Author</td>
                    <td>Price</td>
                </tr>

                <?php
                include_once 'dbQuery.php';

                $cookie_name = "customer_id";

                if(!isset($_COOKIE[$cookie_name])) {
                    return;
                } else {
                    $customer_id = intval($_COOKIE[$cookie_name]);
                }

                // Checkout values
                $subtotal = 0;
                $tax_amount = 0;
                $TAX_RATE = 0.13;
                $total = 0;

                $cart_contents = (New DbQuery())->getCustomerCartItems($customer_id);

                foreach ($cart_contents as $book) {
                    echo nl2br('<tr><td>' . $book["title"] . '</td><td>' . $book["author"] . '</td><td>' . '$' . $book["price"] . '</td></tr>');
                    $subtotal += $book["price"];
                }

                $tax_amount = round($subtotal * $TAX_RATE, 2);
                $total = round($subtotal + $tax_amount, 2);

                echo nl2br('<tr></tr><tr></tr>');
                echo nl2br('<tr><td></td><td style="font-weight:bold">' . 'Subtotal' . '</td><td>' . '$' . $subtotal . '</td></tr>');
                echo nl2br('<tr><td></td><td style="font-weight:bold">' . 'Tax (13%)' . '</td><td>' . '$' . $tax_amount . '</td></tr>');
                echo nl2br('<tr><td></td><td style="font-weight:bold">' . 'Total' . '</td><td>' . '$' . $total . '</td></tr>');
                ?>

            </table>
        </div>

        <div class="body-container">
            <div class="shipping">
                <h2 style="text-align:center">Shipping Address:</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>First Name: </td>
                            <td><input size="30" id="ship-first"> </td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input size="30" id="ship-last"> </td>
                        </tr>
                        <tr>
                            <td>Street Address: </td>
                            <td><input size="30" id="ship-address"> </td>
                        </tr>
                        <tr>
                            <td>City/Town: </td>
                            <td><input size="30" id="ship-city"> </td>
                        </tr>
                        <tr>
                            <td>Province/Territory: </td>
                            <td><input size="30" id="ship-province"> </td>
                        </tr>
                        <tr>
                            <td>Postal Code: </td>
                            <td><input size="30" id="ship-postal"> </td>
                        </tr>
                        <tr>
                            <td>Phone Number (555-555-5555): </td>
                            <td><input size="30" id="ship-phone"> </td>
                        </tr>
                    </tbody>
                </table>

                <h2 style="text-align:center">Payment Details:</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>Credit/Debit Card Number: </td>
                            <td><input size="30" id="credit-num"> </td>
                        </tr>
                        <tr>
                            <td>Expiry Date (MM/YY): </td>
                            <td><input size="30" id="expiry-date"> </td>
                        </tr>
                        <tr>
                            <td>CVV (eg. 555): </td>
                            <td><input size="30" id="cvv-num"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="billing">
                <h2 style="text-align:center">Billing Address:</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" id="billing-box", onclick='billingCheckboxClicked(this);'>
                                <label for="billing-box">Same as shipping address</label>
                            </td>
                        </tr>
                        <tr>
                            <td>First Name: </td>
                            <td><input size="30" id="bill-first"> </td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input size="30" id="bill-last"> </td>
                        </tr>
                        <tr>
                            <td>Street Address: </td>
                            <td><input size="30" id="bill-address"> </td>
                        </tr>
                        <tr>
                            <td>City/Town: </td>
                            <td><input size="30" id="bill-city"> </td>
                        </tr>
                        <tr>
                            <td>Province/Territory: </td>
                            <td><input size="30" id="bill-province"> </td>
                        </tr>
                        <tr>
                            <td>Postal Code: </td>
                            <td><input size="30" id="bill-postal"> </td>
                        </tr>
                        <tr>
                            <td>Phone Number (555-555-5555): </td>
                            <td><input size="30" id="bill-phone"> </td>
                        </tr>
                    </tbody>
                </table>

                <table>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" id="auth-box">
                                <label for="auth-box">I authorize StudentSaver&#8482; to charge my card to the total amount above</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <form action="success.php" method="post" onSubmit="javascript:return placeOrder(this);">
                                    <input class="button" type="submit" name="submit" value="Place Order">
                                    <input hidden name="success" type="text" id="success" value="true">
                                </form>
                            </td>
                        </tr>
                        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr />
        <footer>
            <p>COPYRIGHT &#169; 2021 StudentSaver</p>
            <p>All rights reserved.</p>
        </footer>
    </body>
</html>