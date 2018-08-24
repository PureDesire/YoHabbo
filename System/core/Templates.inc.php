<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 3/12/2018
 * Time: 8:12 PM
 */

class Templates {
    private $CORE;
    private $RS;
    private $settings;
    public $PATH;
    private $userRank;
    private $userHead;
    function __construct($CORE) {
        $this->CORE = $CORE;
        $this->settings = array();
        try{
            if($this->settings['templateName'] == null) {
                $SQL = "SELECT * FROM cms_settings WHERE setting_name = 'templateName'";
                $this->CORE->DATABASE->query($SQL);
                $this->CORE->DATABASE->execute();
                $this->RS = $this->CORE->DATABASE->resultset();
                foreach ($this->RS as $results) {
                    $this->settings['templateName'] = $results['setting_value'];
                }
                if($this->DEBUG == true) {
                    echo "Template Name Pulled from Database.... <Br />";
                }
            }
            if($this->settings['siteName'] == null) {
                $SQL = "SELECT * FROM cms_settings WHERE setting_name = 'siteName'";
                $this->CORE->DATABASE->query($SQL);
                $this->CORE->DATABASE->execute();
                $this->RS = $this->CORE->DATABASE->resultset();
                foreach ($this->RS as $results) {
                    $this->settings['siteName'] = $results['setting_value'];
                }
                if($this->DEBUG == true) {
                    echo "Site Name Pulled from Database.... <Br />";
                }
            }
	      $this->PATHSWFS = "http://yohabbobeta.rgnstudios.us";
            $this->PATH = "System/templates/" . $this->settings['templateName'];
            return $this;
        }catch(PDOException $exception) {

        }
    }

    function loadPage($content) {
        include($this->PATH . "/".$content.".php");
    }

    function insertStats($page) { ?>

            <div class="stats counter-web <?php echo $page ?>">
                <span class="stats counter-web__text"><?php echo $this->CORE->getStats();?> Users Online</span>
                    <div class="stats hotel-image">
                    </div>


            </div>
   <?php }

    function insertMenu($page) { ?>


        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                 <div class="large-12 cell">
                   <div class="menu middle  <?php echo $page; ?>">
                    <div class="menu content  <?php echo $page; ?>">
              <a href='default'><li class='icons home'><i class='menuLabel'>&nbsp;HOME</i></li></a>
               <a href='forum'><li class='icons comm'><i class='menuLabel'>&nbsp;COMMUNITY</i></li></a>
                <a href='shop'><li class='icons shop'><i class='menuLabel'>&nbsp;SHOP</i></li></a>

                        <?php if($_SESSION['yoHabbo']['username'] != null) {

           echo "<a href = 'client' class='hotel-button'><span class='hotel-button__text'>HOTEL</span></a >";

          } ?>
                    </div>
                       <div class="menu sub">
                          <div class="sub content">
<ul class="subMenu">
    <li class="sub item"><a href="default" class="subLink <?php if($_GET['doPage'] == "me") {echo"viewing";} ?>">WHAT'S NEW</a></li>
    <li class="sub item"><a href="staff" class="subLink  <?php if($_GET['doPage'] == "staff") {echo"viewing";} ?>"> STAFF</a></li>
</ul>

                          </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>

        <div class="menu logo <?php echo $page; ?>">
            
        </div>


  <?php  }

    function insertStyles() {

        switch($_GET['doPage']) {
            default:
                 echo "
        
      <link rel=\"stylesheet\" type=\"text/css\" href=\"http://localhost/assets/css/habboindex.min.css\"/>
	     <script type=\"text/javascript\" src=\"".  $this->PATH . "/js/app.js\"></script>
    <link href=\"https://fonts.googleapis.com/css?family=Ubuntu+Mono\" rel=\"stylesheet\">

        
        ";
                break;
		

            case "client":
                echo "
                  <link rel=\"stylesheet\" type=\"text/css\" href=\"". $this->PATH . "/css/foundation.min.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"".  $this->PATH . "/css/app.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"".  $this->PATH . "/css/icons.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"".  $this->PATH . "/css/client.css\"/>
    <script type=\"text/javascript\" src=\"".  $this->PATH . "/js/swfobject.js\"></script>
    
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Ubuntu\"  /> 
               
                ";

                break;
        }

    }

        function insertFoot() {
            echo "
            <div class=\"grid-container\">
            <div class=\"grid-x grid-margin-x\">
                <div class=\"large-12 cell\">
                    <div class=\"mainFoot ".  $_GET['doPage'] . "\">
					
					
					
                       
					   
					   
					   
					   </div></div>
                </div>
            </div>
        </div>
            
            ";
    }

    function insertUserBox($userID) {
        try {
            $sql = "SELECT * FROM users WHERE id = $userID";
            $this->CORE->DATABASE->query($sql);
            $this->CORE->DATABASE->execute();
            $resultSet1 = $this->CORE->DATABASE->resultSet();
            foreach ($resultSet1 as $this->RS) {
                $this->userRank = $this->RS['rank'];
                $this->userHead = "https://www.habbo.com/habbo-imaging/avatarimage?figure=" . $this->RS['look'] . "&headonly=1&size=L&gesture=sml&direction=2&head_direction=10&action=std";
            }
        }catch (PDOException $exception) {
            echo "There was an error getting your user info from the DB: <Br />". $exception;
        }
        echo "<div class=\"userBox\">" . $_SESSION['yoHabbo']['username'] . "</div>
                <span class=\"arrow-down\" id=\"drop-out-arrow\"></span>
                <div class=\"userHeadContain\">
                    <img class=\"headImg\" src=\"". $this->userHead . "\">
                </div>
                <div class=\"user info popout\">
                    <ul class=\"userbox popout nav\">
                        <li class=\"userbox navitem\"><a href=\"#\">Account Settings</a></li>
                        <li class=\"userbox navitem\"><a href=\"logout\">Logout</a></li>
                    
                    
                    ";
                if($this->userRank >= 6) {
                    echo "<li class=\"userbox navitem\"><a href=\"ase\">ASE</a></li>";

                }        echo "</ul>";


    }

	    function insertUserHead($userID) {
        try {
            $sql = "SELECT * FROM users WHERE id = $userID";
            $this->CORE->DATABASE->query($sql);
            $this->CORE->DATABASE->execute();
            $resultSet1 = $this->CORE->DATABASE->resultSet();
            foreach ($resultSet1 as $this->RS) {
                $this->userRank = $this->RS['rank'];
                $this->userHead = "https://www.habbo.com/habbo-imaging/avatarimage?figure=" . $this->RS['look'] . "&headonly=1&size=L&gesture=sml&direction=2&head_direction=10&action=std";
            }
        }catch (PDOException $exception) {
            echo "There was an error getting your user info from the DB: <Br />". $exception;
        }
        echo "<div class=\"userBox\">" . $_SESSION['yoHabbo']['username'] . "</div>
                <span class=\"arrow-down\" id=\"drop-out-arrow\"></span>
                <div class=\"userHeadContain\">
                    <img class=\"headImg\" src=\"". $this->userHead . "\">
                </div>
                <div class=\"user info popout\">
                    <ul class=\"userbox popout nav\">
                        <li class=\"userbox navitem\"><a href=\"#\">Account Settings</a></li>
                        <li class=\"userbox navitem\"><a href=\"logout\">Logout</a></li>
                    
                    
                    ";
                if($this->userRank >= 6) {
                    echo "<li class=\"userbox navitem\"><a href=\"ase\">ASE</a></li>";

                }        echo "</ul>";


    }
	

	

    function InsertStaff() {
        try {
            $SQL = "SELECT * FROM users WHERE `rank` >= '4' ORDER BY `rank` DESC";
            $this->CORE->DATABASE->query($SQL);
            $this->CORE->DATABASE->execute();
           $this->RS = $this->CORE->DATABASE->resultSet();
            foreach ($this->RS as $results) {
                $rankNum = $results['rank'];
                $rankfriendly = $this->CORE->ranks["$rankNum"];

                echo "
                 <div class=\"large-3 cell\">
                        <div class=\"user plate web\">
                            <div class=\"user plate head\">
                            <img class=\"headImg\" src=\"https://www.habbo.com/habbo-imaging/avatarimage?figure=" . $results['look'] . "&headonly=1&size=L&gesture=sml&direction=2&head_direction=10&action=std\">
                            </div>
                           ";
                            if($results['online'] == 1) {

                            echo "<span class=\"user plate\"><div class=\"icons isOnline\"></div></span>";
                            } else {}
                echo "<p class=\"staffname\"> " .$results['username'] . "</p>
                            <p class=\"staffrank\">" . $rankfriendly . "</p>
                        </div>
                    </div>
                ";
            }
        } catch (PDOException $exception) {
            echo "There was an error" . $exception;
        }

    }
}