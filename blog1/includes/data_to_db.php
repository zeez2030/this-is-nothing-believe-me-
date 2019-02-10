<?php
include '../config/config.php';
include '../classes/database.php';

/* 

 ************this file is responsible to send the entered comment to the database *************************

    takes the comment body and the id of the post 

 */
if (isset($_GET['comment'])) {
    $comm = $_GET['comment'];
    $postId = $_GET['id'];
    $userId = $_GET['userId'];

    $db = new Database;
    $query = "INSERT INTO comments (comment_post_id,comment_content,comment_user_id)
    VALUES ( $postId,'$comm',$userId)";
    $db->insert_query($query);

}
