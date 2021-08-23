<?php
include './inc/functions.php';

$log = array();
$log['version'] = "1.1";
$log['host'] = $_GET['from'];
$log['short_message'] = $_GET['msg'];
$log['_customer'] = $_GET['customer'];
$log['_type'] = $_GET['type'];

$logdata = json_encode($log);

$result = sendInput($logdata);

?>
