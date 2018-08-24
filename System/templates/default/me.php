
<?php
if($_SESSION['yoHabbo']['username'] != null) {

    ?>

    <!doctype html>
<HTML>
<HEAD>
    <title><?php echo $this->settings['siteName'];?></title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://localhost/js/app.js"></script>
    <?php $this->insertStyles($_GET['doPage']); ?>
						<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
							<link rel="stylesheet" href="http://localhost/assets/css/habboindex.min.css">
							<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" crossorigin="anonymous">
							
							
							
	
</HEAD>
<BODY>
	<main>
	



		<div class="column">
			<div id="header">
			
				<a href="#" id="logo" class="animated fadeInDown"></a>
				<div id="infoHotel">
					<span><p class="noselect"><?php echo $this->CORE->getStats();?> YoHabbo's</p></span>
					<div id="sep"></div>
					<span><p class="noselect"><?php echo $this->CORE->getStats();?> Members</p></span>
					
				</div>
			</div>

			
			</br>
			<section>
				<article>
				
					<p id="title" class="noselect" width="25px">So Many New Updates</p>
					<p id="desc" class="noselect">We have had alot of recent updates to YoHabbo Hotel!</p>
				</article>
				<article>
					<p id="title" class="noselect">We Are Open!</p>
					<p id="desc" class="noselect">Yeah, What title says, we are now open for the community!</p>
				</article>
				<article>
					<p id="title" class="noselect">Welcome Back Everyone!</p>
					<p id="desc" class="noselect">We have made our transfer succesfully, Enjoy!</p>
				</article>
			</section>
			<div class="meicon"><p class="noselect"><?php $this->CORE->getLook();?></p></div>
			<div class="chatbubble animated fadeInDown"><i class="fas fa-user"></i></div>
		
			
			<div class="mainFoot me">
			
<div class="homeicon me"></div>
<div class="roomicon"></div>
<div class="meiconbut"><p class="noselect"><?php $this->CORE->getLooks();?></p></div>
  <span class="mepopup">Popup text or content here!!! :\</span>
</div>
			
			
			
			<div id="dragme"><div class="mytext"><b>My Profile</b></div>
			<div class="dragme dragtop">
			
			</div>
			</br></br></br>
			<p class="noselect">
			<?php $this->CORE->getInfo(); ?>
			
			
			
			</p>
			
			</div>
			</div>
			
			
			
			
			
			   
			   
			   
			   
			   
			   
			   <script src="<?php echo $this->PATH . "/js/vendor/jquery.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/app.js"; ?>"></script>

	</main>
	
</BODY>
</HTML>

<?php } else {
    header("location: default");
}

?>



