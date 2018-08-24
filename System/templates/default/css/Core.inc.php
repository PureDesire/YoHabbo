<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 3/11/2018
 * Time: 9:14 PM
 */
require_once("System/core/Database.inc.php");
require_once("System/core/Templates.inc.php");
class Core{
    private $GUARDKEY;
    public $DATABASE;
    private $DEBUG;
    public $TEMPLATES;
    public $DEV;

    function initialize($GUARDKEY) {

            $this->GUARDKEY = $GUARDKEY;
        if($this->GUARDKEY != TRUE && $this->DEBUG == TRUE) {
            DIE("Core Initialization Failure.... <br />");
        } else {


                    $this->DATABASE = new Database($this->DEBUG);

                        try{
                            $SQL = "SELECT * FROM cms_settings WHERE setting_name = 'is_development'";
                                $this->DATABASE->query($SQL);
                                $this->DATABASE->execute();
                                    foreach($this->DATABASE->resultset() as $setting) {
                                        $this->DEV = $setting['setting_value'];

                                    }
                        }catch(PDOException $exception) {
                            DIE ("could not fetch HabboWEB Settings" . $exception);
                        }
                    $this->PreInitTemplates();


                if($this->DEBUG == true) {
                    echo "Core Initialization Successful..... <Br/>";
                }

        }


    }

    function PreInitTemplates() {

        if($this->DEBUG == true) {
            echo "Template System Pre-Initialization Successful...... <Br />";


        }
    }
    function generateSSO($len)
    {
        $string = "";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for($i=0;$i<$len;$i++)
            $string.=substr($chars,rand(0,strlen($chars)),1);
        return $string;
    }


    function updateOnLogin($username, $userIP) {
            try {
                $this->DATABASE = new Database($this->DEBUG);
                $currentTime = time();
                $updatedSSO = $this->generateSSO('25');
                $SQL = "UPDATE users SET ip_current = '$userIP', last_login = '$currentTime', auth_ticket = '$updatedSSO' WHERE username = '$username' ";
                $this->DATABASE->query($SQL);
                $this->DATABASE->execute();
            } catch (PDOException $exception) {
                DIE("ERROR UPDATING INFO" . $exception);
            }
    }

    function updateSSO($username) {
        try {
            $this->DATABASE = new Database($this->DEBUG);
            $newSSO = $this->generateSSO('25');
            $SQL = "UPDATE users SET auth_ticket = '$newSSO' WHERE username = '$username'";
            $this->DATABASE->query($SQL);
            $this->DATABASE->execute();

        } catch (PDOException $exception) {
            DIE("ERROR UPDATING YOUR AUTH TICKET<Br />" . $exception );
        }
        return $newSSO;
    }


    function doLogin($username, $password, $userIP) {

        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "SELECT * FROM users WHERE username = :username and password = :password";
            $this->DATABASE->query($SQL);
                $this->DATABASE->bind(":username", "$username");
                $this->DATABASE->bind(":password", "$password");


                    $this->DATABASE->execute();
                    $count = $this->DATABASE->rowCount();
                        if($count == 0) {
                            header("location:default?error=loginFailure");
                        } else {
                            $rs = $this->DATABASE->resultset();
                            foreach($rs as $info)
                            $_SESSION['yoHabbo']['userID'] = $info['id'];
                            $_SESSION['yoHabbo']['username'] = $info['username'];
                            $this->updateOnLogin($username, $userIP);
                            header("location:me");

                        }




        } catch(PDOException $exception) {
            die("DATABASE ERROR ON LOGIN" . $exception );
        }
    }

    function checkUserExist($username) {
        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "SELECT * FROM users WHERE username = :username";
            $this->DATABASE->query($SQL);
                $this->DATABASE->bind(":username", "$username");
                $this->DATABASE->execute();
                    $count = $this->DATABASE->rowCount();

                    if($count <= '0') {
                        return true;
                    } else {
                        return false;
                    }

        } catch(PDOException $exception) {
            DIE("DATABASE REPORTS FATAL ERROR" . $exception);
        }

    }

    function doRegister($username, $password, $userIP, $email) {
        $currentTime = time();
            if($this->checkUserExist($username) == true) {

        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "INSERT INTO users (username, password, account_created, last_login, last_online, ip_register, ip_current, credits, mail) 
                               VALUES (:username, :password, '$currentTime', '$currentTime', '$currentTime', '$userIP', '$userIP', '1000', :email)";
            $this->DATABASE->query($SQL);
            $this->DATABASE->bind(":username", "$username");
            $this->DATABASE->bind(":password", "$password");
            $this->DATABASE->bind(":email", "$email");
            $this->DATABASE->execute();
               $result = $this->DATABASE->rowCount();
                    if($result == '1') {
                        $_SESSION['yoHabbo']['username'] = $username;
                        header("location:me");
                    }
        } catch (PDOException $exception) {
            DIE("ERROR ON DATABASE" . $exception);
        }
            } else {
                header("location:register?error=usernameTaken");
            }
    }

    function getStats() {

        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "SELECT * FROM users WHERE online = '1'";
            $this->DATABASE->query($SQL);
            $this->DATABASE->execute();

                return $this->DATABASE->rowCount();

        } catch (PDOException $exception) {
            DIE("Fatal : Server failed to return usable value : <Br />" . $exception);
        }


    }

    function getNewsPromo() {
            try {
                $this->DATABASE = new Database($this->DEBUG);
                $SQL = "SELECT * FROM cms_news ORDER by date DESC LIMIT 1";
                $this->DATABASE->query($SQL);
                $this->DATABASE->execute();
                    foreach($this->DATABASE->resultset() as $newsPromo) {
                        echo "
                        <div class=\"news promo-box\">

                        <div class=\"news image-large\">
                            <img src=\"". $this->TEMPLATES->PATH . "/img/news-images/" .$newsPromo['image_large'] . "\" class=\"news img-large\">
                        </div>
                            <div class=\"news content-short\">
                                <p class=\"promo title\">" . $newsPromo['title'] ."</p>
                                <p class=\"promo date author\">" . date('d F Y', $newsPromo['date']) ." | " . $newsPromo['author'] . "</p>
                                <p class=\"promo content-main\">
                                " . $newsPromo['content'] . "  
                                </p>
                            </div>

                    </div>
                        ";

                    }
            }catch(PDOException $exception) {
                echo "WARNING : System could not fetch the latest news from the database!<br />" . $exception;
            }

    }

    function getNewsSmall() {
        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "SELECT * FROM cms_news ORDER by date DESC LIMIT 6 OFFSET 1";
            $this->DATABASE->query($SQL);
            $this->DATABASE->execute();
            foreach($this->DATABASE->resultset() as $newsSmall) {
                echo "
                       
                       <div class=\"cell generic-box news\">
                        <div class=\"news image-small\">
                            <img src=\"". $this->TEMPLATES->PATH ."/img/news-images/" . $newsSmall['image_small']."\"/>
                        </div>
                        <div class=\"news short-right\">
                            <p class=\"news short-title\">" . $newsSmall['title'] . "</p>
                            <p class=\"news short-date_author\">
                              ". date('d F Y', $newsSmall['date']) ." | ". $newsSmall['author']. "
                            </p>
                            <p class=\"news short-content\">
                                " . $newsSmall['content'] . "
                            </p>
                        </div>

                     </div>
                       
                        ";

            }
        }catch(PDOException $exception) {
            echo "WARNING : System could not fetch the latest news from the database!<br />" . $exception;
        }

    }


}