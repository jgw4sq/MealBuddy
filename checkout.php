<?php
    /*
        * Home Page - has Sample Buyer credentials, Camera (Product) Details and Instructiosn for using the code sample
    */
    include('apiCallsData.php');
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
													<!-- Sign Up Form -->

									<section><form id="myContainer" action="startPayment.php" method="POST">
									<center><b>Meal Selection</b><br>	<input checked="checked" onchange= "selectChange(this)" type="radio" id="meal" name="meal" value="3.99" > Pavillion Meal Exchange (3.99)  <br>
  <input onchange= "selectChange(this)" type="radio" id="meal" name="meal" value="4.99"> Newcomb To-Go Meal (4.99) <br>
  <input onchange= "selectChange(this)" type="radio" id="meal" name="meal" value="5.99"> N2Go Box (5.99) <br>
  
  <input type="hidden" name="orderNotes" style="text-align:center;margin-left:3%;width:50%;"/><br>
  <center><b>Meeting Location: </b></center>
  							<input type="text" name="meetingLocation" style="text-align:center;margin-left:3%;width:50%;"/><input style="width:0%;height:0%;"type="hidden"/><br>
  							<center><b>Your order (ex. Chick-Fil-A Sandwich Meal, Sprite, BBQ Sauce): </b></center>
  <input type="text" name="orderDetails"style="text-align:center;margin-left:3%;width:50%;">
<div id="buttonContainer" class="row" style=" text-align:center;margin-left: 40%; margin-right:25%; width:50%;">
												<div class="12u">
												
												</div>
											</div>
    <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>"/>
    <!--Camera:--><input type="hidden" id="camera_amount" name="camera_amount" value="3.99" hidden readonly></input><br>
    <!--Tax:--><input type="hidden" name="tax" value="0" hidden readonly></input><br>
    <!--Insurance:--><input type="hidden" name="insurance" value="0" hidden readonly></input><br>
    <!--Handling:--><input type="hidden" name="handling_fee" value="0" hidden readonly></input><br>
    <!--Est. Shipping:--><input type="hidden" name="estimated_shipping" value="0" hidden readonly></input><br>
    <!--Shipping Discount:--><input type="hidden" name="shipping_discount" value="0" hidden readonly></input><br>
    <!--Total:--><input type="hidden" name="total_amount" value="0" hidden readonly></input><br>
    <!--Currency:--><input type="hidden" name="currencyCodeType" value="USD" hidden readonly></input>
      <input type="hidden" name="mealValue" value="0" hidden readonly></input><br>
<br>					

											
  
												<!--</div>-->
											</div><br>
			
										
											 
</form>
<!--
										<form action="shipping.php" method="POST" style="margin-left: 25%; margin-right:25%; width:50%;" >
<div class="row 50%" style=" text-align:center;margin-left: 25%; margin-right:25%; width:50%;" >
											<center><b>Meal Selection</b><br>

											
  <input type="radio" id="meal" name="meal" value="pav" > Pavillion Meal Exchange  <br>
  <input type="radio" id="meal" name="meal" value="newcomb"> Newcomb To-Go Meal  <br>
  <input type="radio" id="meal" name="meal" value="N2Go"> N2Go Box <br>

 </center> <br><br></div>

					<input type="text" name="csrf" value="<?php echo($_SESSION['csrf']);?>" hidden readonly/>
                 <table>
                    <!-- Item Details - Actual values set in apiCallsData.php --><!--
                     <tr><td>Camera </td><td><input class="form-control" type="text" name="camera_amount" value="300" hidden readonly></input></td></tr>
                     <tr><td>Tax </td><td><input class="form-control" type="text" name="tax" value="5" hidden readonly></input> </td></tr>
                     <tr><td>Insurance </td><td><input class="form-control" type="text" name="insurance" value="10" hidden readonly></input> </td></tr>
                     <tr><td>Handling Fee </td><td><input class="form-control" type="text" name="handling_fee" value="5" hidden readonly></input> </td></tr>
                     <tr><td>Estimated Shipping </td><td><input class="form-control" type="text" name="estimated_shipping" value="2" hidden readonly></input> </td></tr>
                     <tr><td>Shipping Discount </td><td><input class="form-control" type="text" name="shipping_discount" value="-2" hidden readonly></input> </td></tr>
                     <tr><td>Total Amount </td><td><input class="form-control" type="text" name="total_amount" value="320" hidden readonly></input> </td></tr>
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
											
<div class="row 50%" style=" text-align:center;margin-left: 30%; margin-right:25%; width:50%;">
		
													<br><b>Meeting location:</b> 												<input type="text" name="meetup" id="meetup-location" style="text-align:center;margin-left:3%;width:50%;" />
												</div>
											
<br>
											
								<div class="row 50%" style=" text-align:center;margin-left: 30%; margin-right:25%; width:50%;">
												<!--<div class="6u 12u(mobile)">-->
												<!--<center><b>Your order (ex. Chick-Fil-A Sandwich Meal, Sprite, BBQ Sauce): </b></center>
													<input type="text" name="notes" id="notes" style="text-align:center;margin-left:3%;width:75%;" ></input>
												<!--</div>-->
											<!--</div><br>
			
										<div class="row" style=" text-align:center;margin-left: 22%; margin-right:25%; width:50%;">
												<div class="12u">
												
												</div>
											</div>
											 <div style=" text-align:center;margin-left: 22%; margin-right:25%; width:50%;">
                    <button class="btn btn-primary" formaction="shipping.php" role="button">Proceed to Checkout</button>
                </div>
										</form>
									</section>

							</div>
							<div class="6u 12u(mobile)">

				</div>-->
				<script type="text/javascript">

function selectChange(item){
	var cameraCost = document.getElementById("camera_amount");
	cameraCost.value= item.value;
}
</script>
				 <script type="text/javascript">
     window.paypalCheckoutReady = function () {
         paypal.checkout.setup('<?php echo(MERCHANT_ID); ?>', {
             container: 'buttonContainer', //{String|HTMLElement|Array} where you want the PayPal button to reside
             environment: '<?php echo($environment); ?>' //or 'production' depending on your environment
         });
     };
     </script>
     <script src="//www.paypalobjects.com/api/checkout.js" async></script>
<?php
     include('footer.php');
?>

