<?php

require_once('twitteroauth/autoload.php');

require_once('inc/config.inc.php');
require_once('inc/mysql.inc.php');
require_once('inc/utils.inc.php');

use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

$key = generate_random_string(64);

$db_conn->query("INSERT INTO `flow` (`key`, `oauth_token`, `oauth_token_secret`) VALUES (%s, %s, %s)", $key, $request_token['oauth_token'], $request_token['oauth_token_secret']);

$q = $db_conn->query("SELECT `id` FROM `flow` WHERE `key` = %s", $key);

echo json_encode(array('id' => intval($q->fetchAll()[0]['id']), 'key' => $key));

?>