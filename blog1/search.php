<?php

include_once 'includes/header.php';
include 'config/config.php';
include 'classes/database.php';
include 'helpers/format_helper.php';

/*
        the user will be redirected to this page after he search for something he types not by tags 

 */


$db = new Database;
$search = $_GET['search'];

//to remove any spaces in the string
$search = str_replace(" ", "", $search);


//get all posts that has the searched word in it 
$query = "SELECT * from posts where post_author LIKE '%" . $search . "%' OR post_title LIKE '%" . $search . "%'  OR post_body LIKE '%" . $search . "%' OR post_tags LIKE '%" . $search . "%'";
$posts = $db->get_query_result($query);
?>
<?php include 'includes/navbar.php'; ?>



<section class="card-contain">
    <div class="container-fluid margin ">

        <!----------------------------Place holder for the tag name H1  --------------------------->
        <div class="search-name d-flex container">
            <span>Search Result for </span>
            <form action="search.php" method="GET">
            <input type="text" name="search" value=" <?php echo $search; ?>">
            <input type="submit" value="Search Again">
            </form>
        </div>

        <div class="row  cards">
            <!--   ---------- Card -----------------        -->
            <?php 
                //place for the results of the search 


            if ($posts) :
                while ($post = $posts->fetch_assoc()) : ?>
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
                <?php else : 
                    // if there is no results 

                ?>
                <h1>Sorry No Results for <?php echo "'" . $search . "'"; ?> </h1>
            <?php endif; ?>

        </div>
    </div>


</section>




<?php include 'includes/footer-section.php';
include 'includes/footer.php'; ?>