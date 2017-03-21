<?php
    /*
        * Place Order Page : part of the Express Checkout flow. Buyer can choose shipping option on this page.
    */
    if (session_id() == "")
        session_start();

    include('utilFunctions.php');
    include('paypalFunctions.php');

    $_SESSION['paymentID']= filter_input( INPUT_GET, 'paymentId', FILTER_SANITIZE_STRING );
    $_SESSION['payerID'] = filter_input( INPUT_GET, 'PayerID', FILTER_SANITIZE_STRING );
    $access_token = $_SESSION['access_token'];
    $lookUpPaymentInfo = lookUpPaymentDetails($_SESSION['paymentID'], $access_token);
    $recipientName= filter_var($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['recipient_name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $addressLine1= filter_var($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['line1'],FILTER_SANITIZE_SPECIAL_CHARS);
    $addressLine2 =  (isset($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['line2']) ?  filter_var($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['line2'],FILTER_SANITIZE_SPECIAL_CHARS) :  "");
    $city= filter_var($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['city'],FILTER_SANITIZE_SPECIAL_CHARS);
    $state= filter_var($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['state'],FILTER_SANITIZE_SPECIAL_CHARS);
    $postalCode = filter_var($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['postal_code'],FILTER_SANITIZE_SPECIAL_CHARS);
    $countryCode= filter_var($lookUpPaymentInfo['payer']['payer_info']['shipping_address']['country_code'],FILTER_SANITIZE_SPECIAL_CHARS);

?>
<html>
    <head>
        <title>Checkout</title>
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
                                <h1><a href="index.html">Meal Buddy Checkout</a></h1>
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
                    <div class="title">Checkout</div>
    <div class="row" >
        <div class="col-md-4" style="text-align:center;margin-left:-25%;width:60%;"></div>
        <div class="col-md-4" style="text-align:center;margin-left:-15%;width:60%;" >
            <h3>Ship To :</h3>
            <?php echo($recipientName);?><br/>
            <?php echo($addressLine1);?><br/>
            <?php echo($addressLine2);?><br/>
            <?php echo($city);?><br/>
            <?php echo($state.'-'.$postalCode);?><br/>
            <?php echo($countryCode);?>
            <?php echo ($_SESSION['oderNotes'])?>;

            <?php echo ($_SESSION['meetingLocation'])?>;

            <form action="pay.php" method="POST">
                <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>" hidden readonly/>
                <label>Shipping methods:</label>
                <select class="form-control" name="shipping_method" id="shipping_method" style="text-align:center; margin-left:37%;width: 250px;" class="required-entry">
                   
                    <optgroup label="Free Delivery" style="font-style:normal;">
                        <option value="0.00" selected>
                        Free Delivery</option>
                    </optgroup>
                </select>
                <br/>
                <button type="submit" class="btn btn-primary">Confirm Order</button>
            </form>
            <br/>
        </div>
        <div class="col-md-4"></div>
    </div>
<?php
    include('footer.php');
?>