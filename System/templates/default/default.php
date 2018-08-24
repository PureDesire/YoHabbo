<?php
    if($_SESSION['yoHabbo']['username'] == null) {

?>

<!doctype html>
<HTML>
<HEAD>
    <title><?php echo $this->settings['siteName'];?></title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->insertStyles($_GET['doPage']); ?>
	
	
		<style>
			#dragme{
				margin-left: 550px;
				position:absolute;
				display:none;
				height:350px;
				width:450px;
				background-color:#DCDCDC;
				border:1px solid black;
				border-radius:15px;
				text-align:center;
				}
				.userHeadContain {
					background: transparent;
    margin-left:-27rem;
    margin-top: -5.5rem;
    height:5rem;
    width: 10rem;
    display: inline-block;
}
.userName{
	
	margin-top: -4.5rem;
	margin-left: -15rem;
	color: #000000;
	
}

.userRank{
	margin-top: 0rem;
	margin-left: -17.1rem;
	color: #000000;
}
.userCreated{
	margin-top: -3.5rem;
	margin-left: -12.2rem;
	color: #000000;
}
.userLast{
	margin-top: 0rem;
	margin-left: 0rem;
	color: #000000;
}
.userLog{
	margin-top: 0rem;
	margin-left: 0rem;
	color: #000000;
}
.helpicon.default{
	margin-top: 0rem;
	margin-left: 0rem;
	background: url('http://localhost/assets/images/helpicon.png');
	background-repeat: no-repeat;
}
	
	
.helpicon.me{
	margin-top: 0rem;
	margin-left: 0rem;
	background: url('http://localhost/assets/images/helpicon.png');
	background-repeat: no-repeat;
}


				.homeicon.me {

	height: 5rem;
	width: 5rem;
background: url('http://localhost/assets/images/homeicon.png');
background-repeat: no-repeat;
margin-top: 0.3rem;
margin-left: 0.3rem;


}
.roomicon{
	height: 7rem;
	width: 7rem;
	background: url('http://localhost/assets/images/roomsicon.png');
background-repeat: no-repeat;
margin-top: -5.2rem;
margin-left: 3.2rem;

}
.meicon{
	height: 7rem;
	width: 7rem;
	background-repeat:no-repeat;
	margin-top: 18rem;
	margin-left: 7.5rem;
}

.meiconbut{
	background-repeat: no-repeat;
	margin-top: -8rem;
	margin-left: 15rem;
		height: 2rem;
	width: 7rem;
}

.dragtop{
	height: 5rem;
	width: 40rem;
	background: url('http://localhost/assets/images/topdrag.png');
	background-repeat: no-repeat;
	margin-top: -2.8rem;
	margin-left: -0.5rem;
}

.chatbubble{
	height: 4rem;
	width: 30rem;
	background: url('http://localhost/assets/images/welcomechat.png');
	background-repeat: no-repeat;
	margin-top: -10.5rem;
	margin-left: 15rem;
	
}
.centereddd {
	width: 30rem;
    margin-top: -8.4rem;
	margin-left: 0.5rem;
}
.mytext{
	text-align: center;
	margin-top: 0.5rem;
	color: #FFFFFF;
}
.noselect {s
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none;
}
		.mepopup {
    margin-left: -1rem;
    margin-top: 23.2rem;
    width: 155px;
    height: 46px;
    background: #00211e;
    border: 2px solid #ff4f4f;
    border-right: none;
    border-radius: 5px 5px;
    box-shadow: 0.2rem 0.2rem rgba(12,40,55, 0.5);
    padding: 0.1rem;

}

.meepopup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  
}

.mepopup .show {
    margin-left: -1rem;
    margin-top: 23.2rem;
    width: 155px;
    height: 46px;
    background: #00211e;
    border: 2px solid #ff4f4f;
    border-right: none;
    border-radius: 5px 5px;
    box-shadow: 0.2rem 0.2rem rgba(12,40,55, 0.5);
    padding: 0.1rem;
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}
				</style>
				<script>var mousex;
				var mousey;
				var move = false;
				var ldivx = 200;
				var ldivy = 200;
				window.onload = init;
				function init() 
				{var d = document.getElementById('dragme');
				d.onmousedown = mousedown;
				d.onmouseup = mouseup;
				d.onmousemove = mousemove;
				d.style.left = ldivx +'px';
				d.style.top = ldivy +'px';
				d.style.display = 'block';
				}
				function mousedown(e) {
					document.getElementById('dragme').style.color = 'red';
					move = true;mousex = e.clientX;
					mousey = e.clientY;
					}
					function mouseup(e) {
						document.getElementById('dragme').style.color = 'black';
						move = false;
						}
						function mousemove(e) {
							if(move){ldivx = ldivx + e.clientX - mousex;
							ldivy = ldivy + e.clientY - mousey;
							mousex = e.clientX;
							mousey = e.clientY;
							var d = document.getElementById('dragme');
							d.style.left = ldivx +'px';
							d.style.top = ldivy +'px';
							}
							}
							function myFunction(event) {
  const currentlyVisible = document.querySelector('.mepopup .show');
  if(currentlyVisible) {
    currentlyVisible.classList.toggle('show');
  }
  var popup = event.currentTarget.querySelector('.mypopuptext');
  popup.classList.toggle("show");
}
							        
							</script>
							
	
</HEAD>
<BODY>
	<main>

		<div class="column">
			<div id="header">
			
			
				<a href="#" id="logo"></a>
				<div id="infoHotel">
					<span><p class="noselect"><?php echo $this->CORE->getStats();?> YoHabbo's</p></span>
					<div id="sep"></div>
					<span><p class="noselect"><?php echo $this->CORE->getStats();?> Members</p></span>
					
				</div>
			</div>
				   
			<form action="?doPage=default&DO=login" method="POST">
				<input type="text" name="username" id="login__input" class="fullInput" placeholder="Username ..">
				<input type="password" name="password" id="login__input" class="fullInput" placeholder="Password ..">
				<input type="submit" name="login" id="login__submit" value="Confirm and Log In">
				<a href="./register.php" id="btn__register">Sign Up</a>
			</form>
			<section>
				<article>
				
					<p id="title" class="noselect">So Many New Updates</p>
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
			
			
			
			<div class="mainFoot default">
			
<div class="homeicon me"></div>
<div class="roomicon"></div>
<div class="helpicon default"><p class="noselect"></p></div>
  <span class="mepopuptext" ></span>
</div>
			
			
			
			<div id="dragme"><div class="mytext"><p class="noselect"><b>My Index Box</b></div>
			<div class="dragme dragtop">
			
			</div>
			</br></br></br>
			
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
    header("location: me");
}

?>


