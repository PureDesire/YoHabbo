<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 3/11/2018
 * Time: 9:31 PM
 */

ini_set('error_reporting', '1');
ini_set("display_errors", "true");
require_once("System/core/Core.inc.php");
session_start();
class Config extends Core{
    private $PATH;
    private $SYSTEM;
    private $CORE;
    private $DEBUG;
    public $DEBUGMSG;
    private $GUARDKEY;
    function __construct() {
        $this->PATH = "/";
        $this->SYSTEM = "System/";
        $this->GUARDKEY = true;
        $this->DEBUG = false;

    }

    function preInitCore() {
        if($this->GUARDKEY != TRUE) {
            DIE("CORE PRE-INITIALIZATION..... FAILED....");
        } else {
            $this->CORE = new Core($this->DEBUG);
                if($this->DEBUG == true) {
                    echo "Core Pre-Initialization Successful..... <Br />";
                }
            $this->CORE->initialize($this->GUARDKEY, $this->DEBUG);
        }

        return $this->CORE;
    }

    function SetDebugMsg() {
        $this->DEBUGMSG = array(
            "Core Initialization Failure.... <Br />",
            "Core Initialization Successful.....</br />",
            "Core Pre-Initialization Successful..... <Br />",
            "CORE PRE-INITIALIZATION..... FAILED....<Br />"

        );

    }
}

$preinit = new Config();