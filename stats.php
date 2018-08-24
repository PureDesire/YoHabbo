<?php
/**
 * Created by PhpStorm.
 * User: tracy.kellogg
 * Date: 3/23/2018
 * Time: 10:49 PM
 */


require_once("system/core/core.inc.php");


$core = new Core();

echo $core->getStats() . " Users Online!";


