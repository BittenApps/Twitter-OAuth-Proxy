<?php

require_once('inc/config.inc.php');
require_once('inc/mysql.inc.php');

$q = $db_conn->query("SELECT `oauth_token` FROM `flow` WHERE `id` = %s", $_REQUEST['id']);

$oat = $q->fetchAll()[0]['oauth_token'];

if ($oat) {
    session_start();
    
    $_SESSION['id'] = $_REQUEST['id'];
    $_SESSION['oauth_token'] = $oat;
    
    header('Location: https://api.twitter.com/oauth/authorize?oauth_token=' . $oat);
}

?>