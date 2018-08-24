<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 8/15/2018
 * Time: 6:46 AM
 */
?>


    <!doctype html>
    <HTML>
    <HEAD>
        <title><?php echo $this->title; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->insertStyles(); ?>
    </HEAD>
    <BODY>
    <div class="grid-container collapse">
        <div class="grid-x grid-margin-x">
            <div class="large-2 cell">
                <div class="navi base">
                    <ul class="navi ul">
                    <li class="navi item active"> USERS</li>
                    <a class="navi a" href="?page=news"><li class="navi item"> NEWS</li></a>
                    </ul>
                </div>
        </div>
    </div>


        <div class="grid-container collapse">
            <div class="grid-x grid-margin-x">
                <div class="large-12 cell">
                    <div class="content container">
                        <h1>This section is still under development, please check back later.</h1>
                    </div>
                </div>
            </div>






    <?php $this->insertScripts(); ?>

    </BODY>
    </HTML>

<?php


?>
