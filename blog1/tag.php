<?php

include_once 'includes/header.php';
include 'config/config.php';
include 'classes/database.php';
include 'helpers/format_helper.php';

/*
        the user will be redirected to this page after he search for something by the shown tags 

 */


$db = new Database;
$tag_name = $_GET['tag'];
$query = "SELECT * from posts where post_tags LIKE '%" . $tag_name . "%'  ";
$posts = $db->get_query_result($query);
?>
<?php include 'includes/navbar.php'; ?>



<section class="card-contain">
    <div class="container-fluid margin ">

        <!----------------------------Place holder for the tag name H1  --------------------------->
        <div class="tag-name container">
            <h1>Tag: <?php echo $tag_name; ?></h1>
        </div>

        <div class="row  cards">
            <!--   ---------- Card -----------------        -->
            <?php while ($post = $posts->fetch_assoc()) : ?>
            <a href="post.php?id=<?php echo $post['id']; ?>" class="card col-md-5 border-light bg-light  mb-3">
                <!--  Card img-->
                <img class="card-img-top" src="<?php echo $post['post_picture']; ?>" alt="Card image cap">

                <div class="card-body">

                    <!--Author title -->
                    <h5 class="card-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        &nbsp;<?php echo $post['post_author']; ?>
                        <!--   Category icon -->
                        <?php
                        /*          
                                fetching the category icon from the database and give the icon a class to style it 
                         */

                        $query = "SELECT category_icon , category_name from categories where id = " . $post['post_category'];
                        $cat = $db->get_query_result($query);
                        $icon = $cat->fetch_assoc();
                        ?>
                        <i class="<?php echo $icon['category_icon'] . " " . $icon['category_name']; ?>back card-icon text-center" aria-hidden="true"></i>
                    </h5>
                    <!--   Date -->
                    <p class="text-muted card-date"><?php echo formatDate($post['post_date']); /* formatdate function takes the timestamp and return a good-looking date  */ ?></p>
                    <!--   Intro-->
                    <p class="card-text text-center">&ldquo;
                        <?php echo $post['post_title']; ?> &rdquo;</p>
                </div>
            </a>
<?php endwhile; ?>
           

        </div>
    </div>


</section>




<?php include 'includes/footer-section.php';
include 'includes/footer.php'; ?>