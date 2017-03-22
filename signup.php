  <?php
  require 'PHPMailerAutoload.php';

    header('Content-Type: application/json');

    $aResult = array();

   

    if( !isset($_POST['name']) ) { $aResult['error'] = 'No name!'; }
if( !isset($_POST['email']) ) { $aResult['error'] = 'No email!'; }
if( !isset($_POST['address']) ) { $aResult['error'] = 'No address!'; }
if( !isset($_POST['city']) ) { $aResult['error'] = 'No city!'; }
if( !isset($_POST['state']) ) { $aResult['error'] = 'No state!'; }
if( !isset($_POST['zip']) ) { $aResult['error'] = 'No zip!';}
if( !isset($_POST['phone']) ) { $aResult['error'] = 'No phone!';}
if( !isset($_POST['buyer']) ) { $aResult['buyer'] = 'No buyer data!';}

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
$sql = "INSERT INTO customers (name, email,address,city,state,zip,phone,buyer)
VALUES ('{$_POST['name']}','{$_POST['email']}','{$_POST['address']}','{$_POST['city']}','{$_POST['state']}','{$_POST['zip']}','{$_POST['phone']}','{$_POST['buyer']}')";

if ($conn->query($sql) === TRUE) {
  $aResult['connection'] = 'good sql';


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'john.weber1995@gmail.com';                 // SMTP username
$mail->Password = 'maryjane1290';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom('john.weber1995@gmail.com', 'Meal Buddy');
$mail->addAddress('jgw4sq@virginia.edu', 'Joe User');     // Add a recipient
    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Meal Buddy Sign Up Confirmation';
$mail->Body    = '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="assets/css/main.css" />
  <style type="text/css">
    * { font-family: Verdana, Arial, sans-serif; }
    body { background-color: #fff; cursor: default; }
    h1 { font-size: 15pt; }
    p { font-size: 10pt; }
  </style>
</head>

<body><center>
    <img src="https://s-media-cache-ak0.pinimg.com/736x/33/04/e3/3304e35f47f81180e8c8b896b5d57332.jpg" style="width:100px;height:100px;">
  <h1>Welcome to MealBuddy!</h1></center><br>
  <div class="row 50%" style="text-align:center;margin-left:25%;width:50%;">
  <p>Thanks for registering with MealBuddy. <br><br>To begin using MealBuddy, place a meal request or accept one on the website. </p>
</div>
</body>
</html>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;


} else {
     echo "Message sent!";

}

} else {
  $aResult['error'] = 'bad sql ';
}}else{
  $aResult['error'] = 'That User Already exists ';
}

$conn->close();
}}

    echo json_encode($aResult);

 









?>