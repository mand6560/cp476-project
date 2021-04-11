# cp476-project setup

## Database setup

1. create a new MongoDB database called studentsaver
2. create a new collection in the db called Customer
3. create a new collection in the db called Products
4. Import the intitial customer data with: mongoimport --db studentsaver --collection Customer --file Customer.json --jsonArray
5. Import the intitial book inventory data with: mongoimport --db studentsaver --collection Products --file Products.json --jsonArray

## Instructions

1. Copy addcart.php, checkout.css, checkout.php, createAccount.php, dbQuery.php, index.php, MDBManager.php, search.php, signIn.php and success.php into a directory located on an Apache web server

2. Navigate to localhost/directory_from_above/index.php to arrive at the home page

3. Proceed through registering, searching for books, adding them to the cart, and checking out