<!DOCTYPE html>
<html>
    <head>
        <title>StudentSaver</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" href="checkout.css">
    </head>

    <body>
        <div class="header">
            <h1>StudentSaver</h1>
            <hr />
        </div>

        <h3>Quick Search</h3>
        <form action="search.php" method="post">
            <div class="search">
                <input class="button" type="submit" name="search_box" value="Math"/>
                <input class="button" type="submit" name="search_box" value="Science"/>
                <input class="button" type="submit" name="search_box" value="English"/>
                <input class="button" type="submit" name="search_box" value="History"/>
            </div>
        </form>
        
        <h3>Custom Search</h3>
        <form action="search.php" method="post">
            <div class="search">
                <input type = "Text" placeholder = "Search for textbooks" value = "" name="search_box"/>
                <input class="button buttonSearch" type="submit" value="Search"/>
            </div>
        </form>

        <hr />
        <footer>
            <p>COPYRIGHT &#169; 2021 StudentSaver</p>
            <p>All rights reserved.</p>
        </footer>
    </body>
</html>