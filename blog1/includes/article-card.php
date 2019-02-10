<?php 
$db = new Database;
$query = "SELECT * from posts order by id desc";
$result = $db->get_query_result($query);

?>

<section>
    <div class="container-fluid margin card-contain">

        <div class="row  cards ">
            <!--   ---------- Card -----------------        -->
            <?php while ($post = $result->fetch_assoc()) : ?>
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
                        $query = "SELECT category_icon , category_name from categories where id = " . $post['post_category'];
                        $cat = $db->get_query_result($query);
                        $icon = $cat->fetch_assoc();
                        ?>
                        <i class="<?php echo $icon['category_icon'] . " " . $icon['category_name']; ?>back card-icon text-center" aria-hidden="true"></i>
                    </h5>
                    <!--   Date -->
                    <p class="text-muted card-date"><?php echo formatDate($post['post_date']); ?></p>
                    <!--   Intro-->
                    <p class="card-text ">&ldquo;
                        <?php echo $post['post_title']; ?> &rdquo;</p>
                </div>
            </a>
<?php endwhile; ?>
           

        </div>
    </div>


</section>
