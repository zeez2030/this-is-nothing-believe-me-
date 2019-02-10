<?php 
include "../config/config.php";
include "../classes/database.php";
/*
 *************** This file is responsible of the actions that will happen after the user press the popular button in the category page ***********

    it takes the id of the category and returns back the top viewed articles that has the same category id limit 2 


 */
$db = new Database;
$id = $_GET['id'];
$query = "SELECT * from posts where post_category = $id order by post_view limit 2 ; ";
$posts = $db->get_query_result($query);
$post = $posts->fetch_all(MYSQLI_ASSOC);
echo json_encode($post);





?>