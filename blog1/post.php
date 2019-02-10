<?php 
include 'includes/header.php';
include 'config/config.php';
include 'classes/database.php';
include 'helpers/format_helper.php';

        /*
                this is the page that the user will be redirected to it after he choose a specific article

 */

(isset($_GET['id'])) ? $id = $_GET['id'] : $id = 0;
echo $id;
$db = new Database;


// get the selected article
$query = "SELECT * from posts where id=$id";
$post = $db->get_query_result($query);
$row = $post->fetch_assoc();

//update the article view column 
$query = "UPDATE posts set post_view=post_view + 1 where id =$id ;";
$db->insert_query($query);

//select all comments that are approved to be shown 
$query = "SELECT * from comments where comment_post_id=$id AND comment_status = 'approved' ORDER BY comment_date DESC;";
$result = $db->get_query_result($query);
?>
<?php include 'includes/navbar.php'; ?>
<!-- put your front end here  -->


<div class="page">
    <!--For Article Image-->
 <h1 class=""><?php echo $row['post_title']; ?></h1>   
<img src="<?php echo $row['post_picture']; ?>">
</div>
<!--**********************************-->
<section class ="author" id="<?php echo $row['id']; ?>">
    <div  class="auth-info container">
            <img class="auth_img" src="img/unknown.png" alt="avatar" class="img-thumbnail">
             <h1><?php echo $row['post_author']; ?>
            </h1>
            <p class="date"><?php echo formatDate($row['post_date']); ?></p>
            <p>Share this article</p>

             <?php 
                    //addthis api for the share mechanism
            ?>
                <div class=" addthis_inline_share_toolbox_2qqz mt-4"></div>
    </div>
 </section>
 <article class="article-body container">
<p >
  <?php 
    echo utf8_encode($row['post_body']); ?>
</p>


 </article>

 <section class="container comments" >
        <div class="comment">
            <h1></h1>
            <hr class="first-hr">
            <h3>comments</h3>
            <hr class="second-hr">
        </div>
        
    </section>

    <?php 
        //textarea and submit button for the comment
    ?>
    <section class="comment-area container getUserId" id="<?php echo $_SESSION['user_id']; ?>"> 
 <?php if (isset($_SESSION['login'])) : ?>
            <textarea name="comment" id="user_comment" cols="90" rows="10" placeholder="Write your comment"></textarea>
            <p id="success"></p>
            <button   value="" class ="button" name='submit' id="getform">Add comment</button>
<?php endif; ?>
   
    <?php 
        //here is the place for the comments that are approved to be shown
    ?>
    <?php if ($result) : ?>
    <?php while ($comment = $result->fetch_assoc()) :
        $query = "SELECT user_name from users where id =" . $comment['comment_user_id'];
    $user = $db->get_query_result($query)->fetch_assoc();
    ?>
        <div class="view-comment"> 
            <div class="upper-info d-flex"> <h4><?php echo $user['user_name']; ?></h4> <span><?php echo formatDate($comment['comment_date']); ?></span></div>
            <p><?php echo $comment['comment_content']; ?></p>
        </div>
<?php endwhile; ?>
<?php endif; ?>
    </section>
   

                    <!--*****Author and published date and share******-->

<?php include_once 'includes/footer-section.php'; ?>
<?php include_once 'includes/footer.php'; ?>
