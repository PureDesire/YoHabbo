
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
        <?php $this->insertStyles(); ?>

    </HEAD>
    <BODY>
    <div class="grid-container">

        <div class="grid-x grid-margin-x">
            <div class="large-12 cell">

                <?php $this->insertUserBox($_SESSION['yoHabbo']['userID']); ?>
            </div>
            <?php $this->insertStats($_GET['doPage']) ?>

        </div>

    </div>
    </div>


    <?php $this->insertMenu($_GET['doPage']);?>

    <div class="lowerContain">

        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="large-9 cell staffContent">
                    <p class="staffTitle">
                       YoHabbo Staff
                    </p>
                    <div class="grid-x grid-margin-x staff user plates">
                        <?php $this->InsertStaff(); ?>
                    </div>



                </div>
                <div class="large-3 cell side-content">
                    <div class="generic-box blue">
                        <div class="generic-title">
                            Enjoying YoHabbo?
                        </div>
                        <div class="boxContent">
                            Head on over to and vote for us on FindRetros! Just click below!<Br />
                            <b> <a href="https://findretros.com/servers/yohabboxyz/vote">VOTE NOW!!!</a></b>
                        </div>
                    </div>
                    <div class="generic-box blue">
                        <div class="generic-title">
                            SAFETY TIPS
                        </div>
                        <div class="boxContent">Protect yourself with awareness! Learn how to stay safe on the internet.</div>
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



<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 8/21/2018
 * Time: 2:36 PM
 */