
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
        <link rel="preload" href="http://swf.localhost/gordon/PRODUCTION-201611291003-338511768/Habbo.swf" />
		<script type="text/javascript">
        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
			
          if (!event.target.matches('.dropbtn')) {

            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
        </script>

        <?php $this->insertStyles(); ?>

    </HEAD>
    <BODY>
	

    <div class="grid-container">

        <div class="grid-x grid-margin-x">
            <div class="large-12 cell">

                    <?php $this->insertStats($_GET['doPage']); ?>

            </div>

        </div>
    </div>
	
	                   <?php $this->insertDropdown($_GET['doPage']); ?>


    <?php $this->insertMenu($_GET['doPage']);?></br>
	<?php $this->insertSubmenu($_GET['doPage']);?>

    <div class="lowerContain">
	
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
                <div class="large-9 cell">
				
                    <?php
                        $this->CORE->getNewsPromo();
                    ?>


                <div class="grid-x grid-margin-x large-up-2">
                    <?php $this->CORE->getRank();?>
                </div>
                </div>
                <div class="large-3 cell">
                    <div class="generic-box blue">
                        <div class="generic-title">
                            YoHabbo Staff
                        </div>
                        <div class="boxContent">
							<center><a href="owners">&nbsp;<font color="#FFFFFF">Owners/Founders</font></a></br>
                                    <a href="managers">&nbsp;<font color="#FFFFFF">Manager/Tech</font></a></br>
                                    <a href="admins">&nbsp;<font color="#FFFFF">Admins</font></a></br>
                                    <a href="mods">&nbsp;<font color="#FFFFFF">Mods</font></a></br>
									
									</center>
<Br />
                           
                        </div>
                    </div>
                    <div class="generic-box blue">
                        <div class="generic-title">
                            YoHabbo Events & VIPS
                        </div>
                        <div class="boxContent"><center><a href="events">&nbsp;<font color="#FFFFFF">Event Manager</font></a></br>
						<a href="ultimate">&nbsp;<font color="#FFFFFF">Ultimate VIP</font></a></br>
						<a href="vip">&nbsp;<font color="#FFFFFF">VIP</a></font></br></center>
						</div>
                    </div>
                </div>


        </div>
    </div>


<?php $this->insertFoot(); ?>

    <div class="pageEndMargin"></div>
    <script src="<?php echo $this->PATH . "/js/vendor/jquery.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/vendor/what-input.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/vendor/foundation.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/app.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/stats.js"; ?>"></script>
    </BODY>
    </HTML>

<?php } else {
    header("location: default");
}

?>



