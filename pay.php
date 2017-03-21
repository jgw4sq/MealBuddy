<?php
    /*
        * Payment Confirmation page : has call to execute the payment and displays the Confirmation details
    */
    if (session_id() == "")
        session_start();

    include('utilFunctions.php');
    include('paypalFunctions.php');


    if( isset($_GET['paymentId']) && isset($_GET['PayerID'])){ //Proceed to Checkout or Mark flow

        //call to execute payment
        $response = doPayment(filter_input( INPUT_GET, 'paymentId', FILTER_SANITIZE_STRING ), filter_input( INPUT_GET, 'PayerID', FILTER_SANITIZE_STRING ), NULL);

    } else { //Express checkout flow

        if(verify_nonce()){
            $expressCheckoutFlowArray = json_decode($_SESSION['expressCheckoutPaymentData'], true);
                    $expressCheckoutFlowArray['transactions'][0]['amount']['total'] = (float)$expressCheckoutFlowArray['transactions'][0]['amount']['total'] + (float)$_POST['shipping_method'] - (float)$expressCheckoutFlowArray['transactions'][0]['amount']['details']['shipping'];
                    $expressCheckoutFlowArray['transactions'][0]['amount']['details']['shipping'] = $_POST['shipping_method'];
                    $transactionAmountUpdateArray = $expressCheckoutFlowArray['transactions'][0];
                    $_SESSION['expressCheckoutPaymentData'] = json_encode($expressCheckoutFlowArray);

                    //call to execute payment with updated shipping and overall amount details
                    $response = doPayment($_SESSION['paymentID'], $_SESSION['payerID'], $transactionAmountUpdateArray);
        } else {
            die('Session expired');
        }
    }
	
	// REST validation; route non-HTTP 200 to error page
	if ($response['http_code'] != 200 && $response['http_code'] != 201) {		
		$_SESSION['error'] = $response;
		header( 'Location: error.php');
		
		// need exit() here to maintain session data after redirect to error page
		exit();
	}
	
	$json_response = $response['json']; 
	
    $paymentID= $json_response['id'];
    $paymentState = $json_response['state'];
    $finalAmount = $json_response['transactions'][0]['amount']['total'];
    $currency = $json_response['transactions'][0]['amount']['currency'];
    $transactionID= $json_response['transactions'][0]['related_resources'][0]['sale']['id'];

    $payerFirstName = filter_var($json_response['payer']['payer_info']['first_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $payerLastName = filter_var($json_response['payer']['payer_info']['last_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $recipientName= filter_var($json_response['payer']['payer_info']['shipping_address']['recipient_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $addressLine1= filter_var($json_response['payer']['payer_info']['shipping_address']['line1'],FILTER_SANITIZE_SPECIAL_CHARS);
    $addressLine2 = (isset($json_response['payer']['payer_info']['shipping_address']['line2']) ? filter_var($json_response['payer']['payer_info']['shipping_address']['line2'],FILTER_SANITIZE_SPECIAL_CHARS) :  "" );
    $city= filter_var($json_response['payer']['payer_info']['shipping_address']['city'],FILTER_SANITIZE_SPECIAL_CHARS);
    $state= filter_var($json_response['payer']['payer_info']['shipping_address']['state'],FILTER_SANITIZE_SPECIAL_CHARS);
    $postalCode = filter_var($json_response['payer']['payer_info']['shipping_address']['postal_code'],FILTER_SANITIZE_SPECIAL_CHARS);
    $countryCode= filter_var($json_response['payer']['payer_info']['shipping_address']['country_code'],FILTER_SANITIZE_SPECIAL_CHARS);
	
    
?>
<html>
    <head>
        <title>Confirmation</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    </head>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript" src="inputvalidation.js"></script>
    <body class="homepage">
        <div id="page-wrapper">

            <!-- Header -->
                <div id="header-wrapper" class="wrapper">
                    <div id="header">

                        <!-- Logo -->
                            <div id="logo" style="position:relative;display: table-cell;vertical-align: middle;display: inline-block;">
<div>
                                <h1><a href="index.html">Meal Buddy Confirmation</a></h1>
                                <p>The Swipe that Pays you Back</p>
                                
<img src="logo.png" style="width:200px;height:200px;"  >
    </div>
                            
</div>
                        <!-- Nav -->
                            <nav id="nav">
                                <ul>
                                    <li class="current"><a href="index.html">Home</a></li>
                                    <li>
                                        <a href="about.html">About Us</a>
                                        <ul>
                                            <li><a href="about.html#whoarewe">What do we do?</a></li>
                                            <li><a href="about.html#whyuse">Why use Meal Buddy?</a></li>
                                            
                                            <li>
                                                <a href="about.html#benefits">What makes us great</a>
                                                
                                            </li><li>
                                                <a href="about.html#values">What do we stand for?</a>
                                                
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <li><a href="#">Sign Up</a></li>
                                    
                                </ul>
                            </nav>

                    </div>
                </div>

<!-- Intro -->
                <div id="intro-wrapper" class="wrapper style1">
                    <div class="title">Confirmation</div>
    <div class="row" >
    <div class="row">
        <div class="col-md-4" style="text-align:center;margin-left:-25%;width:60%;"></div>
        <div class="col-md-4" style="text-align:center;margin-left:55%;width:100%;">
            <h4>
                <?php echo($payerFirstName.' '.$payerLastName.', Thank you for your Order!');?><br/><br/>
                Shipping Address: </h4>
                <?php echo($recipientName);?><br/>
                <?php echo($addressLine1);?><br/>
                <?php echo($addressLine2);?><br/>
                <?php echo($city);?><br/>
                <?php echo($state.'-'.$postalCode);?><br/>
                <?php echo($countryCode);?>

                <h4>Payment ID: <?php echo($paymentID);?> <br/>
		Transaction ID : <?php echo($transactionID);?> <br/>
                State : <?php echo($paymentState);?> <br/>
                Total Amount: <?php echo($finalAmount);?> &nbsp;  <?php echo($currency);?> <br/>
            </h4>
            <br/>
            Return to <a href="index.php">home page</a>.
        </div>
        <div class="col-md-4"></div>
    </div>
      <?php
  require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'john.weber1995@gmail.com';                 // SMTP username
$mail->Password = 'maryjane1290';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom('john.weber1995@gmail.com', 'Mailer');
$mail->addAddress('jgw4sq@virginia.edu', 'Joe User');     // Add a recipient
    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$cost=  $_SESSION['cost'];
$meetingLocation = $_SESSION['meetingLocation'];
$mail->Subject = 'Purchase Confirmation';
$mail->Body    = '<head>
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
    <h1>MealBuddy Order Confirmation</h1></center><br>
    <div class="row 50%" style="text-align:center;margin-left:25%;width:50%;">
        <p>Thanks for ordering with MealBuddy! <br><br>To receive your meal, simply show up to the designated meeting spot with your seller. Your seller\'s contact info is: jgw4sq@virginia.edu.</p>
    </div>
    <center><h2><b><p>Your Order</p></b></h2></center>
    <div class="row 50%" style="text-align:center;margin-left:35%;width:50%;">
        <p>Order: <br>
        Meeting location:'. $meetingLocation . '<br>
        Total:'. $cost . '<br></p>
</div>
<p><b><h2><center>Bon appetit!<center></h2>></b></p>
</body>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;


} else {
     echo "Message sent!";

}
?>
<?php
    if (session_id() !== "") {
               session_unset();
               session_destroy();
            }
    include('footer.php');
?>

