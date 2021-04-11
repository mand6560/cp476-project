<!DOCTYPE html>
<html>
    <head>
        <title>StudentSaver</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" href="style.css">

        <script type="text/javascript">
            
            // Function from w3schools: https://www.w3schools.com/js/js_cookies.asp
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                    }
                }

                return "";
            }

            function checkCookie() {
                let signin = document.getElementById('signin');
                let signup = document.getElementById('signup');
                let signin_button = document.getElementById('signin-button');
                let signup_button = document.getElementById('signup-button');

                let signout_button = document.getElementById('signout-button');

                if (getCookie("customer_id") != "") {
                    signin.style.display = "none";
                    signup.style.display = "none";
                    signin_button.style.display = "none";
                    signup_button.style.display = "none";
                    
                    signout_button.style.display = "block";
                } else {
                    signin.style.display = "block";
                    signup.style.display = "block";
                    signin_button.style.display = "block";
                    signup_button.style.display = "block";
                    
                    signout_button.style.display = "none";
                }
            }

            function signin() {
                let email = document.getElementById('signin-email').value;
                let pass = document.getElementById('signin-pass').value;

                let xhttp = new XMLHttpRequest();

                xhttp.open("POST", "signIn.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(`email=${email}&pass=${pass}`);

                xhttp.onreadystatechange = function () {
                    if (xhttp.readyState == 4) {
                        if (xhttp.status == 200) {
                            if (xhttp.responseText == 'success') {
                                alert('Successfully signed in!');
                                checkCookie();
                            } else if (xhttp.responseText == 'unknown user') {
                                alert('Invalid email or password.');
                            } else {
                                // alert('An unknown error occurred. Please try again later.'); 
                                alert(xhttp.responseText);
                            }
                        } else {
                            alert("An error occurred: " + xhttp.statusText); 
                        }
                    }
                };

                
            }

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
                                checkCookie();
                            } else if (xhttp.responseText == 'fail') {
                                alert('An unknown error occurred. Please try again later.');
                            } else {
                                alert('An unknown error occurred.'); 
                            }
                        } else {
                            alert("An error occurred: " + xhttp.statusText); 
                        }
                    }
                };
            }

            function signout() {
                document.cookie = "customer_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                checkCookie();
            }
        </script>
    </head>

    <body onload="checkCookie()">
        <div class="header" onclick="window.location.href = './index.php';">
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

        <div class="signin" id="signin">
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

            <div class="signup" id="signup">
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

            <div class="signin" id="signin-button">
                <button class="button buttonCenter" type="button" onclick="signin();">Sign in</button>
            </div>
            
            <div class="signup" id="signup-button">
                <button class="button buttonCenter" type="button" onclick="signup();">Create Account</button>
            </div>

            <div class="signout" id="signout-button">
                <button class="button buttonCenter" type="button" onclick="signout();">Sign Out</button>
            </div>

            <div id="customerInfo"></div>
        <hr />
        <footer>
            <p>COPYRIGHT &#169; 2021 StudentSaver</p>
            <p>All rights reserved.</p>
        </footer>
    </body>
</html>