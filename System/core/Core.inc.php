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
    public $ranks;

    function initialize($GUARDKEY) {
        $this->ranks = array(
            1 =>"Regular User",
            2 => "unknown rank",
            3 => "unknown rank",
            4 => "Mod",
            5 => "Super Mod",
            6 => "Admin",
            7 => "Developer",
            8 => "Owner",);
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
            $useridString = $_SESSION['yoHabbo']['userID'];
            $userIdInt = (int)$useridString;
            $newSSO = $this->generateSSO('25');
            $SQL = "UPDATE users SET auth_ticket = '$newSSO' WHERE username = '$username'";
            $SQL2 = "SELECT * FROM user_auth_ticket WHERE user_id = $userIdInt";
            $this->DATABASE->query($SQL2);
            $this->DATABASE->execute();
            $resultSet1 = $this->DATABASE->rowCount();
            $this->DATABASE->query($SQL);
            $this->DATABASE->execute();
            if($resultSet1 >= 1) {
                $SQL4 = "UPDATE user_auth_ticket SET auth_ticket = '$newSSO' WHERE user_id = '$userIdInt'";
                $this->DATABASE->query($SQL4);
                $this->DATABASE->execute();
            } else {
                $SQL3 = "INSERT INTO user_auth_ticket VALUES ('$userIdInt', '$newSSO')";
                $this->DATABASE->query($SQL3);
                $this->DATABASE->execute();
            }

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
	
		    function getLooks() {
        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "SELECT * FROM users WHERE username = '" . $_SESSION['yoHabbo']['username'] . "'";
            $this->DATABASE->query($SQL);
            $this->DATABASE->execute();
            foreach($this->DATABASE->resultset() as $look) {
                echo "
                       
                            <img src=\"https://www.habbo.com/habbo-imaging/avatarimage?figure=" . $look['look'] ."&action=std&gesture=sml&direction=2&head_direction=2&size=n&headonly=1\"/>
                        

                       
                        ";

            }
        }catch(PDOException $exception) {
            echo "WARNING : System could not fetch your looks!<br />" . $exception;
        }

    }
	
	    function getLook() {
        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "SELECT * FROM users WHERE username = '" . $_SESSION['yoHabbo']['username'] . "'";
            $this->DATABASE->query($SQL);
            $this->DATABASE->execute();
            foreach($this->DATABASE->resultset() as $look) {
                echo "
                       
                            <img src=\"https://www.habbo.com/habbo-imaging/avatarimage?figure=" . $look['look'] ."&size=m&gesture=spk&direction=2&head_direction=3&action=std,wav\"/>
                        

                       
                        ";

            }
        }catch(PDOException $exception) {
            echo "WARNING : System could not fetch your looks!<br />" . $exception;
        }

    }
		    function getInfo() {
        try {
            $this->DATABASE = new Database($this->DEBUG);
            $SQL = "SELECT * FROM users WHERE username = '" . $_SESSION['yoHabbo']['username'] . "'";
            $this->DATABASE->query($SQL);
            $this->DATABASE->execute();
            foreach($this->DATABASE->resultset() as $info) {
				echo "<div class=\"userName\"><b>" . $info['username'] . "</b></div>";
				if($info['rank'] == '8') {
                        echo "<div class=\"userRank\">Owner</div>
						
						";
                    }
				if($info['rank'] == '7') {
					echo "
					<div class=\"userRank\">Manager</div>
					";
				}
				if($info['rank'] == '6') {
					echo "<div class=\"userRank\">Admin</div>
					";
				}
				if($info['rank'] == '5') {
					echo "<div class=\"userRank\">Moderator</div>
					";
				}
				if($info['rank'] == '4') {
					echo "<div class=\"userRank\">Events</div>
					";
				}
				if($info['rank'] == '3') {
					echo "<div class=\"userRank\">Ultimate VIP</div>
					";
				}
				if($info['rank'] == '2') {
					echo "<div class=\"userRank\">VIP</div>
					";
				}
				if($info['rank'] == '1') {
					echo "<div class=\"userRank\">User</div>
					";
				}
                echo "
                       </br></br><div class=\"userHeadContain\">
					
                            <img src=\"https://www.habbo.com/habbo-imaging/avatarimage?figure=" . $info['look'] ."&size=m&gesture=spk&direction=2&head_direction=3&action=std,wav\"/>
                        </div>
						</br>
						
						
						<div class=\"userCreated\"><b><h5>Created:&nbsp</b>". date('m / d / y', $info['created']) ."</h5></div></br></br></br>
						<div class=\"userCreated\"><b><h5>Last Login:&nbsp</b>". date('m / d / y', $info['last_online']) ."</h5></div></br>
							<div class=\"userCredits\"><b><h5>" . $info['credits'] . "</h5></b></div>
								Points:" . $info['points'] . "</br>
									Activity Points:" . $info['activity_points'] . "</br>
										GOTW:" . $info['gotw_points'] . "</br>
											VIP Points:" . $info['vip_points'] . "</br>

                       
                        ";
			

            }
        }catch(PDOException $exception) {
            echo "WARNING : System could not fetch your looks!<br />" . $exception;
        }

    }




}