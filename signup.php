  <?php
    header('Content-Type: application/json');

    $aResult = array();

   

    if( !isset($_POST['name']) ) { $aResult['error'] = 'No name!'; }
if( !isset($_POST['email']) ) { $aResult['error'] = 'No email!'; }
if( !isset($_POST['address']) ) { $aResult['error'] = 'No address!'; }
if( !isset($_POST['city']) ) { $aResult['error'] = 'No city!'; }
if( !isset($_POST['state']) ) { $aResult['error'] = 'No state!'; }
if( !isset($_POST['zip']) ) { $aResult['error'] = 'No zip!';}
if( !isset($_POST['phone']) ) { $aResult['error'] = 'No phone!';}

    if( !isset($aResult['error']) ) {

     $servername = "localhost";
     $username = "root";
     $password = "password";
     $dbname = "MealBuddy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
$aResult['error'] = 'bad connection';
   //die("Connection failed: " . $conn->connect_error);

} else{

$users = "SELECT* from customers where email = '{$_POST['email']}' ";
$result = $conn->query($users);


if($result->num_rows==0) {
$sql = "INSERT INTO customers (name, email,address,city,state,zip,phone)
VALUES ('{$_POST['name']}','{$_POST['email']}','{$_POST['address']}','{$_POST['city']}','{$_POST['state']}','{$_POST['zip']}','{$_POST['phone']}')";

if ($conn->query($sql) === TRUE) {
  $aResult['connection'] = 'good sql';
} else {
  $aResult['error'] = 'bad sql ';
}}else{
  $aResult['error'] = 'That User Already exists ';
}

$conn->close();
}}

    echo json_encode($aResult);

 









?>