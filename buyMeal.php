<?php
    /*
        * Home Page - has Sample Buyer credentials, Camera (Product) Details and Instructiosn for using the code sample
    */
    include('apiCallsData.php');
    include('header.php');
    include('paypalConfig.php');

    //setting the environment for Checkout script
    if(SANDBOX_FLAG) {
        $environment = SANDBOX_ENV;
    } else {
        $environment = LIVE_ENV;
    }
?>
<!--
	Escape Velocity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Buy a Meal</title>
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
								<h1><a href="index.html">Buy a Meal</a></h1>
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
					<div class="title">Buy a Meal</div>
													<!-- Sign Up Form -->

									<section>
										 <form action="startPayment.php" method="POST">
                 <input type="text" name="csrf" value="<?php echo($_SESSION['csrf']);?>" hidden readonly/>
                 <table>
                    <!-- Item Details - Actual values set in apiCallsData.php -->
                     <tr><td>Camera </td><td><input class="form-control" type="text" name="camera_amount" value="300" readonly></input></td></tr>
                     <tr><td>Tax </td><td><input class="form-control" type="text" name="tax" value="5" readonly></input> </td></tr>
                     <tr><td>Insurance </td><td><input class="form-control" type="text" name="insurance" value="10" readonly></input> </td></tr>
                     <tr><td>Handling Fee </td><td><input class="form-control" type="text" name="handling_fee" value="5" readonly></input> </td></tr>
                     <tr><td>Estimated Shipping </td><td><input class="form-control" type="text" name="estimated_shipping" value="2" readonly></input> </td></tr>
                     <tr><td>Shipping Discount </td><td><input class="form-control" type="text" name="shipping_discount" value="-2" readonly></input> </td></tr>
                     <tr><td>Total Amount </td><td><input class="form-control" type="text" name="total_amount" value="320" readonly></input> </td></tr>
                     <tr><td>Currency</td><td>
                        <select class="form-control" name="currencyCodeType">
                        						<option value="AUD">AUD</option>
                        						<option value="BRL">BRL</option>
                        						<option value="CAD">CAD</option>
                        						<option value="CZK">CZK</option>
                        						<option value="DKK">DKK</option>
                        						<option value="EUR">EUR</option>
                        						<option value="HKD">HKD</option>
                        						<option value="MYR">MYR</option>
                        						<option value="MXN">MXN</option>
                        						<option value="NOK">NOK</option>
                        						<option value="NZD">NZD</option>
                        						<option value="PHP">PHP</option>
                        						<option value="PLN">PLN</option>
                        						<option value="GBP">GBP</option>
                        						<option value="RUB">RUB</option>
                        						<option value="SGD">SGD</option>
                        						<option value="SEK">SEK</option>
                        						<option value="CHF">CHF</option>
                        						<option value="THB">THB</option>
                        						<option value="USD" selected>USD</option>
                     </td></tr>

                 </table>

                <br/>
                <!--Container for Checkout with PayPal button-->
                <div id="payPalButtonDiv"></div>
                <br/>
                <span style="margin-left:60px">OR</span>
                <br/><br/>
                <div>
                    <button class="btn btn-primary" formaction="shipping.php" role="button">Proceed to Checkout</button>
                </div>
            </form>
									</section>

							</div>
							<div class="6u 12u(mobile)">

				</div>
				    <script type="text/javascript">
     window.paypalCheckoutReady = function () {
         paypal.checkout.setup('<?php echo(MERCHANT_ID); ?>', {
             container: 'myContainer', //{String|HTMLElement|Array} where you want the PayPal button to reside
             environment: '<?php echo($environment); ?>' //or 'production' depending on your environment
         });
     };
     </script>
     <script src="//www.paypalobjects.com/api/checkout.js" async></script>
<?php
     include('footer.php');
?>