<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 8/15/2018
 * Time: 6:47 AM
 */

ini_set("display_errors","On");
require_once("System/core/Database.inc.php");

class ASE {
    public $getPage;
    public $title;
    private $username;
    private $rank;
    private $rankFriendlyName;
    private $database;
    private $RS;
    private $ranks;
    public $PATH;
    public $time;
    public $date;
    function __construct() {
        $this->database = new Database($isDebug = false);
        $this->getPage = $_GET['page'];
        $this->title = "YoHabbo ASE | " . strtoupper($_GET['page']);
        $this->PATH = "../System/ase";
        $this->time = time();
        $this->date = date("m-d-Y",$this->time);
        $this->ranks = array(
            1 =>"Regular User",
            2 => "unknown rank",
            3 => "unknown rank",
            4 => "Mod",
            5 => "Super Mod",
            6 => "Admin",
            7 => "Super Admin / Developer",
            8 => "Owner",);
            if(isSet($_SESSION['yoHabbo']['username'])) {
                $this->username = $_SESSION['yoHabbo']['username'];
                try {
                    $sql = "SELECT * FROM users WHERE username = '$this->username'";
                    $this->database->query($sql);
                    $this->database->execute();

                    foreach ($this->database->resultset() as $this->RS ) {
                        $this->rank = $this->RS['rank'];
                            switch($this->rank) {
                                default:
                                    $this->rankFriendlyName = "default";
                                    break;
                                case 1:
                                    $this->rankFriendlyName = $this->ranks[1];
                                    break;
                                case 2:
                                    $this->rankFriendlyName = $this->ranks[2];
                                    break;
                                case 3:
                                    $this->rankFriendlyName = $this->ranks[3];
                                    break;
                                case 4:
                                    $this->rankFriendlyName = $this->ranks[4];
                                    break;
                                case 5:
                                    $this->rankFriendlyName = $this->ranks[5];
                                    break;
                                case 6:
                                    $this->rankFriendlyName = $this->ranks[6];
                                    break;
                                case 7:
                                    $this->rankFriendlyName = $this->ranks[7];
                                    break;
                                case 8:
                                    $this->rankFriendlyName = $this->ranks[8];
                                    break;

                            }

                    }
                } catch(PDOException $exception) {
                    DIE("The Database retruned an error : <Br />" . $exception);

                }

                if($this->rank >= 4) {
                    //echo "Welcome " . $this->username . " you've reached the ASE your rank is " . $this->rankFriendlyName . " which is rank " . $this->rank . "!";
                } else {
                    header("location:default");
                }
                } else {
                header("location:default");
            }
    }
        function generatePageForASE($page) {
                require_once("System/ase/" . $page . ".php");
        }

        function insertStyles() {


            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"". $this->PATH . "/css/foundation.min.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"".  $this->PATH . "/css/ase.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"".  $this->PATH . "/css/icons.css\"/>
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Ubuntu:regular,bold|Ubuntu+Condensed:regular\" />";
    }

    function insertScripts(){
        echo "<script src=\"$this->PATH/js/vendor/jquery.js\"></script>
    <script src=\"$this->PATH/js/vendor/what-input.js\"></script>
    <script src=\"$this->PATH/js/vendor/foundation.js\"></script>
    <script src=\"$this->PATH/js/ase.js\"></script>";
    }

    function insertNewsArticle($title, $ILarge, $ISmall, $content, $LStory, $author) {
        try {
            $SQL = "INSERT INTO cms_news( title, image_large, image_small, content, longstory, author, date, type, roomid, updated) 
                VALUES(:title, :image_large, :image_small, :content, :long_story, '$author', '$this->time', '1', '0', '1')";
            $this->database->query($SQL);
            $this->database->bind(":title", "$title");
            $this->database->bind(":image_large", "$ILarge");
            $this->database->bind(":image_small", "$ISmall");
            $this->database->bind(":content", "$content");
            $this->database->bind(":long_story", "$LStory");
            $this->database->execute();
                if($this->database->lastInsertId() >= 1) {
                    return true;

                } else {
                    return false;
                }

        } catch (PDOException $exception) {
            echo "THERE WAS AN EXCEPTION THAT PREVENTED YOUR NEWS FROM BEING POSTED!" . $exception;

        }



    }
}



$ASE = new ASE();

if(isSet($_GET['do'])){
    switch($_GET['do']){
        default:
            break;
        case "addNews":
            try {
                if($ASE->insertNewsArticle($_POST['title'], $_POST['ILarge'], $_POST['ISmall'], $_POST['content'], $_POST['LStory'], $_POST['author']) == true) {
                    header("location:?page=news");

                }            } catch(PDOException $exception) {
                DIE("Add News Failed.... Reason -> : " . $exception);

            }                break;
    }
} else {
    //nothing
}
    if($ASE->getPage != null) {
        $ASE->generatePageForASE($ASE->getPage);
    } else {
        header("location:?page=default");
    }



?>