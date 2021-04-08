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
        </script>
    </head>

    <body>
        <div class="header">
            <h1 style="text-align:center">StudentSaver</h1>
            <hr />
        </div>

        <div class="cart">
            <h2>Your Books:</h2>
            <p>Cart items will go here...</p>
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
                            <td>Phone Number (optional): </td>
                            <td><input size="30" id="ship-phone"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="billing">
                <h2 style="text-align:center">Billing Address:</h2>
                <input type="checkbox" id="billing-box", onclick='billingCheckboxClicked(this);'>
                <label for="billing-box">Same as shipping address</label>
                <table>
                    <tbody>
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
                            <td>Phone Number (optional): </td>
                            <td><input size="30" id="bill-phone"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>