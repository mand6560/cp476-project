<!DOCTYPE html>
<html>
    <head>
        <title>StudentSaver</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" href="checkout.css">

        <script type="text/javascript">
        function signup() {
            let first_name = document.getElementById('signup-first').value;
            let last_name = document.getElementById('signup-last').value;
            let email = document.getElementById('signup-email').value;
            let pass = document.getElementById('signup-pass').value;

            let full_name = first_name.concat(' ', last_name);

            let xhttp = new XMLHttpRequest();

            xhttp.open("POST", "createAccount.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`first_name=${first_name}&last_name=${last_name}&email=${email}&pass=${pass}`);

            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4) {
                    if (xhttp.status == 200) {
                        if (xhttp.responseText == 'exists') {
                            alert('Cannot create a new account: Email already in use.');
                        } else if (xhttp.responseText == 'success') {
                            alert('Account successfully created!');
                        } else if (xhttp.responseText == 'fail') {
                            alert('An unknown error occurred. Please try again later.');
                        } else {
                            displayCustomerInfo(xhttp.responseText);
                        }
                    } else {
                        displayCustomerInfo("An error occurred: " + xhttp.statusText); 
                    }
                }
            };
        }

        function displayCustomerInfo(sText) {
            var divCustomerInfo = document.getElementById("customerInfo");
            divCustomerInfo.innerHTML = sText;
        }
    </script>
    </head>

    <body>
        <div class="header">
            <h1>StudentSaver</h1>
            <hr />
        </div>
        <div class="quick-search">
            <h3>Quick Search</h3>
            <form action="search.php" method="post">
                <div class="search">
                    <input class="button" type="submit" name="search_box" value="Math"/>
                    <input class="button" type="submit" name="search_box" value="Science"/>
                    <input class="button" type="submit" name="search_box" value="English"/>
                    <input class="button" type="submit" name="search_box" value="History"/>
                    <input class="button" type="submit" name="search_box" value="Geography"/>
                </div>
            </form>
        </div>
        <div class="custom-search">
            <h3>Custom Search</h3>
            <form action="search.php" method="post">
                <div class="search">
                    <input class="searchbar" type = "Text" placeholder = "Search for textbooks" value = "" name="search_box"/>
                    <input class="button buttonSearch" type="submit" value="Search"/>
                </div>
            </form>
        </div>

        <div class="signin">
            <h2 style="text-align:center">Sign in:</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>E-mail: </td>
                            <td><input size="30" id="signin-email"> </td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" size="30" id="signin-pass"> </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>

            <div class="signup">
            <h2 style="text-align:center">Create Account:</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>First Name: </td>
                            <td><input size="30" id="signup-first"> </td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input size="30" id="signup-last"> </td>
                        </tr>
                        <tr>
                            <td>E-mail: </td>
                            <td><input size="30" id="signup-email"> </td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" size="30" id="signup-pass"> </td>
                        </tr>
                    </tbody>
                    
                </table>
                
            </div>

            <div class="signin">
                <button class="button buttonCenter" type="button" onclick="alert('Sign in');">Sign in</button>
            </div>
            
            <div class="signup">
                <button class="button buttonCenter" type="button" onclick="signup();">Create Account</button>
            </div>

            <div id="customerInfo"></div>
        <hr />
        <footer>
            <p>COPYRIGHT &#169; 2021 StudentSaver</p>
            <p>All rights reserved.</p>
        </footer>
    </body>
</html>