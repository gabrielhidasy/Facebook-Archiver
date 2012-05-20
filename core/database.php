<?php

/*
 * db_connect.php: Implements all the methods
 * related to the DB.
 */

	function get_user_archives($user_id = false){
		
		if($user_id == false){
			echo "Invalid parameter";
			exit();
		} else {
			$sql = "SELECT post_id, from_id FROM arch_users where id={$user_id}";

			$result = mysql_query($sql);

			if(mysql_num_rows($result) == 0){
				return "No data stored about this user.";
			} else {
				
				while($row[] = mysql_fetch_array($result));

				return $row;

			}
		}
	}

	function delete_user_archive($user_id = false, $post_id = false){
		
		if($user_id == false || $post_id == false){
			echo "Invalid parameteres";
			exit();
		} else {

			$sql = "DELETE * FROM arch_users WHERE id={$user_id} AND post_id={$post_id}";

			$result = mysql_query($sql);

			if(mysql_affected_rows($result) == 0){
				return "Failed to delete data.";
			} else {
				return "Data has been deleted.";
			}
		}		
	}

	function insert_user_archive($user_id = false, $post_id = false, $from_id = false){
		
		if($user_id == false || $post_id == false || $from_id == false){
			echo "Invalid parameteres";
			exit();
		} else {

			$sql = "INSERT INTO arch_users VALUES({$user_id}, {$post_id}, {$from_id})";

			$result = mysql_query($sql);

			if(!$result){
				return "Failed to archive post." . mysql_error();
			} else {
				return "Post has been archived";
			}
		}		
	}

    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    mysql_connect(
            $server = $url["host"],
            $username = $url["user"],
            $password = $url["pass"]);
            $db=substr($url["path"],1);
    
    mysql_select_db($db);

  

