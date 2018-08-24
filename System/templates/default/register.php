<?php
if($_SESSION['yoHabbo']['userID'] == null) {

    ?>

    <!doctype html>
    <HTML>
    <HEAD>
        <title><?php echo $this->settings['siteName'];?></title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->insertStyles(); ?>

    </HEAD>
    <BODY>
    <?php $this->insertMenu($_GET['doPage']);?>
    <div class="grid-container teaser">

        <div class="grid-x grid-margin-x">
            <div class="large-12 cell">

            <div class="medium-6 cell teaser-img"></div>

            </div>

        </div>
    </div>





    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="large-12 cell registration">

                <form action="?DO=register&doPage=register" method="POST" data-abide>
                    <div data-abide-error class="alert callout" style="display: none;">
                        <p><i class="fi-alert"></i> Please correct the mistakes in RED below.</p>
                    </div>
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="medium-6 cell">
                                <label>Desired Username:
                                    <input type="text" name="username" required>
                                    <span class="form-error">This field is required.</span>
                                </label>
                            </div>
                            <div class="medium-6 cell">

                            </div>

                            <div class="medium-6 cell">
                                <label>Email Address:
                                    <input type="email" name="email" required>
                                    <span class="form-error">This field is required.</span>
                                </label>
                            </div>
                            <div class="medium-6 cell">

                            </div>
                            <div class="medium-6 cell">
                                <label>Password
                                    <input type="password" name="password" required>
                                    <span class="form-error">This field is required.</span>
                                </label>
                            </div>
                            <div class="medium-6 cell">

                            </div>

                            <div class="medium-6 cell">
                                <label>Repeat Password:
                                    <input type="password" name="password2" required>
                                    <span class="form-error">This field is required.</span>
                                </label>
                            </div>
                            <div class="medium-6 cell">

                            </div>

                            <div class="medium-6 cell">
                                <label>
                                    <input type="submit" class="button" value="REGISTER!">&nbsp;&nbsp;<a href="default" class="button">Cancel</a>
                                </label>
                            </div>


                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script src="<?php echo $this->PATH . "/js/vendor/jquery.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/vendor/what-input.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/vendor/foundation.js"; ?>"></script>
    <script src="<?php echo $this->PATH . "/js/app.js"; ?>"></script>
    </BODY>
    </HTML>

<?php } else {
    header("location: me");
}

?>