<?php

require_once("config.inc.php");

class Index{
    private $self;
    private $CORE;
    private $CONFIG;
    private $TEMPLATES;

    function init() {
        $this->CONFIG = new config();
        $this->self = "index";
        $this->CORE = $this->CONFIG->preInitCore();


    }

    function generatePage($content) {
        $this->TEMPLATES = $this->CORE->TEMPLATES = new Templates($this->CORE);
        $this->TEMPLATES->loadPage($content);
    }

    function DOLOGIN($username, $password, $userIP) {

        $this->CORE->doLogin($username, $password, $userIP);
    }
    function DOREGISTER($username, $password, $userIP, $email) {
        $this->CORE->doRegister($username, $password, $userIP, $email);
    }
}

$ind = new Index();
$ind->init();

$doPage = $_GET['doPage'];
$DO = $_GET['DO'];
$userIP = $_SERVER['REMOTE_ADDR'];

    if($DO == null) {

    } else {
        switch($DO) {
            default:
                break;

            case "login":
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $userIP = $_SERVER['REMOTE_ADDR'];
                $ind->DOLOGIN($username, $password, $userIP);

                break;

            case "register":
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);
                    $password2 = md5($_POST['password2']);
                        if($password == $password2) {
                            $ind->DOREGISTER($username, $password, $userIP, $email);
                        }
                break;

            case "disconnect":
                 echo var_dump($_POST);
                break;

        }
    }
    if($doPage == null) {
        $doPage = "default";
    }

    $error = $_GET['error'];
    switch($error) {

        default:
            break;

        case "loginFailure":
            echo "
                    <div class=\"grid-container\">
                        <div class=\"grid-x grid-margin-x\">
                         <div class=\"callout error\">
                         <i class='closeCallout'><a href='#'><sup>X</sup></a></i>
                         <p>That username and password did not match our records please try again or register below.</p>
                         </div>
                        </div>
                    </div>
            ";
            break;

        case "usernameTaken":
            echo "
                    <div class=\"grid-container\">
                        <div class=\"grid-x grid-margin-x\">
                         <div class=\"callout error\">
                         <i class='closeCallout'><a href='#'><sup>X</sup></a></i>
                         <p>That username already exists please choose a different username.</p>
                         </div>
                        </div>
                    </div>
            ";
            break;

    }

$ind->generatePage($doPage);


