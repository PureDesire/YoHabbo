<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 8/15/2018
 * Time: 7:41 AM
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
            <div class="large-12 cell">
                <div class="navi base">
                    <ul class="navi ul">
                        <a class="navi a" href="?page=default"><li class="navi item"> USERS</li></a>
                    <a class="navi a" href="?page=news"><li class="navi item active"> NEWS</li></a>
                    </ul>
                </div>
        </div>
    </div>
    </div>


    <div class="content container">
<div class="grid-container">
    <div class="grid-x grid-margin-x">
                <div class="large-9 cell">

                    <div class="box title">
                        Add a news article
                    </div>
                        <div class="box generic">

                        <form action="?page=news&do=addNews" method="POST">
                            <div class="grid-container">
                                <div class="grid-x grid-padding-x">
                                    <div class="medium-6 cell">
                                        <label class="formLabel">Article Name
                                            <input name="title" type="text" placeholder="Article Name">
                                        </label>
                                    </div>
                                    <div class="medium-6 cell">
                                        <label class="formLabel">Author Name
                                            <input name="author" type="text" value="<?php echo $_SESSION['yoHabbo']['username']?>" readonly>
                                        </label>
                                    </div>
                                    <div class="medium-6 cell">
                                        <label class="formLabel">Small Image (name_thumb.png)
                                            <input name="ISmall" type="text" placeholder="lpromo_habboxevent0918_thumb.png">
                                        </label>
                                    </div>
                                    <div class="medium-6 cell">
                                        <label class="formLabel">Large Image (name.png)
                                            <input name="ILarge" type="text" placeholder="lpromo_habboxevent0918.png">
                                        </label>
                                    </div>
                                    <div class="medium-6 cell">
                                        <label class="formLabel">Date Posted
                                            <input name="date" type="text" value="<?php echo $this->date; ?>" disabled>
                                        </label>
                                    </div>
                                    <div class="medium-12 cell">
                                        <label class="formLabel">Short Story
                                            <textarea name="content" placeholder="Shorty Story is a maximum of 150 characters."></textarea>
                                        </label>
                                    </div>
                                    <div class="medium-12 cell">
                                        <label class="formLabel">Long Story
                                            <textarea name="LStory" placeholder="This one can be a bit longer."></textarea>
                                        </label>
                                    </div>
                                    <div class="medium-5 cell">

                                    </div>
                                    <div class="medium-3 cell">
                                        <input type="submit" class="button" value="Submit Article">
                                    </div>
                                    <div class="medium-3 cell">

                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                </div>

                        <div class="large-3 cell">
                            <div class="box title">
                                Still Under Development
                            </div>
                            <div class="box generic">

                                This page is still under development at this time you will have to go to the database and manually remove news articles.
                                    <hr />
                                To find a news image to suit your need browse to /system/templates/default/img/news-images/ and copy the name from there to paste in the form to the left. <Br />
                                This will be updated in the future but for now the system works, and I have other more pressing matters to work on! <Br />
                                -Love Z3r0! <3

                            </div>
                        </div>
                    </div>
                </div>
    </div>





    <?php $this->insertScripts(); ?>

    </BODY>
    </HTML>


