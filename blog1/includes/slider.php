<?php
/*
    this is the slider in the index page we will put here top 4 articles in the slider but the carousel class from bootstrap in order for it to work it need an active class in on of it
    so we have done two queries to the database in order to get 1 article to be the active one and the second query to get the remaining 3 articles
 */
$db = new Database;
// get the three article
$query = "SELECT * from posts order by post_view desc limit 3";
$result = $db->get_query_result($query);

//get the article that will have active class 
$query = "SELECT * from posts order by post_view desc limit 1";
$top = $db->get_query_result($query);

?>

<!------------ Section1 Slider  ------------>
<section class="slider margin">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">

        <?php while ($post = $result->fetch_assoc()) : ?>
            <!-----------  Slider imgs ---------->
            <div class="carousel-item ">
                <img src="<?php echo $post['post_picture']; ?>" class="d-block w-100 slide-img " alt="...">
                <div class="carousel-caption d-none d-block slide-text">
                    <h1 class=""><?php echo $post['post_title']; ?></h1>
                    <a href="post.php?id=<?php echo $post['id']; ?>">Read More</a>
                </div>
            </div>
<?php endwhile; ?>
            <!--        ----    2nd img  ----    -->
            <?php while ($posts = $top->fetch_assoc()) : ?>
            <!-----------  Slider imgs ---------->
            <div class="carousel-item active ">
                <img src="<?php echo $posts['post_picture']; ?>" class="d-block w-100 slide-img " alt="...">
                <div class="carousel-caption d-none d-block slide-text">
                    <h1 class=""><?php echo $posts['post_title']; ?></h1>
                    <a href="post.php?id=<?php echo $posts['id']; ?>">Read More</a>
                </div>
            </div>
<?php endwhile; ?>
        </div>


        
    </div>
</section>
