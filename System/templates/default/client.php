<?php
require_once 'findretros_config.php';
require_once 'findretros.php';

$findRetros = new FindRetros();

if($findRetros->hasClientVoted()) {
    if($_SESSION['yoHabbo']['username'] != null) {

        ?>
        <!DOCTYPE html>
        <!-- Production Client -->
        <html lang="en">
        <head>
            <title><?php echo $this->settings['siteName'];?></title>
            <?php $this->insertStyles("client"); ?>
            <script type="text/javascript">
                if(window.name = "")
                    window.name="habboClient";

                var username = "<?php echo $_SESSION['yoHabbo']['username']; ?>";
            </script>
            <script type="text/javascript">
                var flashvars = {
                    "connection.info.host":"localhost",
                    "connection.info.port":"3000",
                    "client.reload.url": "/disconnected?DO=disconnect",
                    "client.fatal.error.url": "/disconnected?DO=disconnect",
                    "client.connection.failed.url": "/disconnected?DO=disconnect",
                    "logout.url": "/default",
                    "logout.disconnect.url": "/default",
                    "url.prefix":"http://yohabbo.local",
                    /*"client.starting":"Please wait! Habbo is starting up.",*/
                    "has.identity":"1",
                    "client.starting.revolving":"Welcome Back, To Version Two.",
                    "spaweb":"1",
                    "client.notify.cross.domain":"1",
                    "unique_habbo_id":"hhus-1265578",
                    "nux.lobbies.enabled":"true",
                    "flash.client.origin":"popup",
                    "processlog.enabled":"1",
                    "sso.ticket":"<?php echo $this->CORE->updateSSO($_SESSION['yoHabbo']['username']); ?>",
                    "productdata.load.url":"http://swf.localhost/gamedata/productdata.txt",
                    "furnidata.load.url":"http://swf.localhost/gamedata/furnidata.xml",
                    "external.texts.txt":"http://swf.localhost/gamedata/external_flash_texts.txt",
                    "external.variables.txt":"http://swf.localhost/gamedata/external_variables.txt",
                    "external.figurepartlist.txt":"http://swf.localhost/gamedata/figuredata.xml",
                    "external.override.texts.txt":"http://swf.localhost/gamedata/external_flash_override_texts.txt",
                    "external.override.variables.txt":"http://swf.localhost/gamedata/external_override_variables.txt",
                    "flash.client.url":"http://swf.localhost/gordon/PRODUCTION-201709052204-426856518/",
                };
            </script>
            <script src="http://playyo.us/System/templates/default/js/client.js" type="text/javascript"></script>
            <script type="text/javascript">
                window.FlashExternalInterface.disconnect = function() {
                    window.location.href = "disconnected?DO=disconnect";
                };

                window.FlashExternalInterface.logout = function() {
                    window.location.href = "disconnected?DO=disconnect";
                };

                var params = {
                    "base" : "http://swf.localhost/gordon/PRODUCTION-201709052204-426856518/",
                    "allowScriptAccess" : "always",
                    "menu" : "false",
                    "wmode": "opaque"
                };
                swfobject.embedSWF('http://swf.localhost/gordon/PRODUCTION-201709052204-426856518/Habbo.swf', 'flash-container', '100%', '100%', '11.1.0', '//habboo-a.akamaihd.net/habboweb/63_1d5d8853040f30be0cc82355679bba7c/10404/web-gallery/flash/expressInstall.swf', flashvars, params, null, null);
            </script>


        </head>

        <body >
        <div id="client-ui">
            <div id="flash-wrapper">
                <div id="flash-container">
                    <div class="client-error">
                        <h1 class="client-error__title" translate="client_error_title">YOU NEED TO USE FLASH TO PLAY HABBOON!</h1>
                        <p translate="client_error_flash">If you're using a computer, you need to <a href="https://www.adobe.com/go/getflashplayer" target="_blank">allow, install or update Flash</a> to play HABBOON. Please <a href="https://www.adobe.com/go/getflashplayer" target="_blank">CLICK HERE</a> to use Flash! NOTE: if you block Flash, you will need to go to your browser's settings to unblock it in order to play Habboon.</p>
                        <div class="client-error__downloads">
                            <a class="client-error__flash" href="https://www.adobe.com/go/getflashplayer" rel="noopener noreferrer" target="_blank"></a>
                        </div>
                        <p translate="CLIENT_ERROR_MOBILE">
                            If you need further guidance, please see <a href="https://habboon.pw/articles/1862-important-news-about-google-chrome-and-flash-player" target="_blank">this article</a> for more information on how to do this.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </div>


        </div>

        <script src="<?php echo $this->PATH . "/js/vendor/jquery.js"; ?>"></script>
        <script src="<?php echo $this->PATH . "/js/stats.js"; ?>"></script>

        </body>

        </html>
        <!-- END Production Client -->



    <?php } else {
        header("location:default");
    } }else{
    // echo 'You have yet to vote!';

    $findRetros->redirectClientToVote();
}




?>