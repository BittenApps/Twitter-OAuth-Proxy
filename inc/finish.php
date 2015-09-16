<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once('twitteroauth/autoload.php');

require_once('config.inc.php');
require_once('mysql.inc.php');
require_once('utils.inc.php');

use Abraham\TwitterOAuth\TwitterOAuth;

session_start();

$q = $db_conn->query("SELECT * FROM `flow` WHERE `id` = %s", $_SESSION['id']);

$res = $q->fetchAll();

$oat = $res[0]['oauth_token'];
$oats = $res[0]['oauth_token_secret'];

if (isset($_REQUEST['oauth_token']) && $oat !== $_REQUEST['oauth_token']) {
    // Abort! Something is wrong.
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oat, $oats);

$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

$db_conn->query("UPDATE `flow` SET `access_token` = %s, `access_token_secret` = %s WHERE `id` = %s", $access_token['oauth_token'], $access_token['oauth_token_secret'], $_SESSION['id']);

echo '<p>Token: ' . $access_token['oauth_token'] . '</p>';
echo '<p>Secret: ' . $access_token['oauth_token_secret'] . '</p>';

?>

Done!