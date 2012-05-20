<?php

	require_once "database.php";

	$user_id = $_GET['user_id'];

	echo json_encode(get_user_archives($user_id));
