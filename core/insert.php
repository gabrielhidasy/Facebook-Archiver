<?php 

require_once 'database.php';

$post_id = $_GET['post_id'];
$user_id = $_GET['user_id'];
$from_id = $_GET['from_id'];

echo insert_user_archive($user_id, $post_id, $from_id);

?>