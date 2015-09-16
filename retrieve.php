<?php

require_once('inc/config.inc.php');
require_once('inc/mysql.inc.php');

if (!$_REQUEST['id'] || !$_REQUEST['key'])
    die('No id/key!');

$q = $db_conn->query("SELECT * FROM `flow` WHERE `id` = %s AND `key` = %s", $_REQUEST['id'], $_REQUEST['key']);

$res = $q->fetchAll();

if (!count($res))
    $dict = array('error' => 'NOT_FOUND');
else if (!$res[0]['access_token'])
    $dict = array('error' => 'NO_DATA');
else
    $dict = array('oauth_token' => $res[0]['access_token'], 'oauth_token_secret' => $res[0]['access_token_secret']);

echo json_encode($dict);

?>