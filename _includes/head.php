<!DOCTYPE html>
<html lang="en">
<!--

	♥ Hand coded with love by EvergreenBob.com

-->
<head>
	<meta charset="UTF-8">	
	
	<title>BroswerGadget | Browser Utility</title>
	<link rel="icon" type="image/ico" href="_images/favicon.ico">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="Stop browsing the Internet like a Neanderthal! Upgrade to a Swiss Army homepage. BrowserGadget is designed for professional Internet surfers and precision engineered to betterize browsing.">
	<meta name="format-detection" content="telephone=no">

	<meta property="og:url" content="https://browsergadget.com/" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="BrowserGadget | Browser Utility" />
	<meta property="og:image" content="https://browsergadget.com/_images/BrowserGadget.jpg" />
	<meta property="og:image:alt" content="BrowserGadget" /> 
	<meta property="og:description" content="Stop browsing the Internet like a Neanderthal! Upgrade to a Swiss Army homepage. BrowserGadget is designed for professional Internet surfers and precision engineered to betterize browsing." />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css">
  	
  <?php // if (WWW_ROOT != 'http://localhost/browsergadget') {      /* not sure why I had this wrapped */ ?>
	<link href='https://fonts.googleapis.com/css?family=Architects+Daughter|Courier+Prime|Roboto|Special+Elite' rel='stylesheet' type='text/css'>
  <?php // } /* it was causing blurry text when on localhost though so now it's off */ ?>

  <?php if ($layout_context == 'new-project') { 
    ?><link rel="stylesheet" href="style-dark.css?<?php echo time(); ?>" type="text/css">
  <?php } else if (isset($_SESSION['color']) && $_SESSION['color'] == "3") { 
		?><link rel="stylesheet" href="style-light.css?<?php echo time(); ?>" type="text/css">
	<?php } else if (isset($_SESSION['color']) && $_SESSION['color'] == "2") { 
		?><link rel="stylesheet" href="style-spring.css?<?php echo time(); ?>" type="text/css">
	<?php } else {  
		?><link rel="stylesheet" href="style-dark.css?<?php echo time(); ?>" type="text/css">
	<?php } // keeping things pretty in the sorcecode
	?><div><a class="oo-aos back-to-top" data-aos="fade-up" data-aos-offset="205"><i class="fa fa-angle-up"></i></a></div>

    <?php if (WWW_ROOT != 'http://localhost/browsergadget') { ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <?php } else { ?>
      <script src="scripts/jquery-3.5.1.min.js"></script>
    <?php } ?>
  	<script src="scripts/jquery_1-12-1_ui_min.js"></script>
  	<script src="scripts/jquery-ui_touch-punch.js"></script>
  	<script src="scripts/jquery.hoverIntent.min.js"></script>

  	<script src="scripts/header-scripts.js?<?php echo time(); ?>"></script>

  <?php if (WWW_ROOT != 'http://localhost/browsergadget') { ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-ER0L96WN41"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-ER0L96WN41');
	</script>
  <?php } ?>
	
	<script src="scripts/preload.js?<?php echo time(); ?>"></script>
</head>
