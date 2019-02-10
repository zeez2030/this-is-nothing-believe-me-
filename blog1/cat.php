<?php 
include_once 'includes/header.php';
include 'config/config.php';
include 'classes/database.php';
include 'helpers/format_helper.php';


/*
 *************** This is the page that will be shown to the user when he chooses any of the categories icon in the index page

 */

$db = new Database;
$id = $_GET['id'];

// see how many articles in the category 
$query = "SELECT count(*) as count from posts where post_category = $id ";
$posts = $db->get_query_result($query);
$post = $posts->fetch_assoc();


//update the category_no_of articles column 
$query = "UPDATE categories set category_no_of_articles =" . $post['count'] . " where id = $id ";
$do = $db->insert_query($query);


$query = "SELECT * from posts where post_category = $id order by post_view";
$posts = $db->get_query_result($query);

//this is the top post that will appear in each category as  a jumbotron 
$query = "SELECT * from posts where post_category = $id order by post_view desc limit 1";
$top = $db->get_query_result($query);

?>
<?php include 'includes/navbar.php'; ?>

<?php 
        //fethcing the top post info 
?>
<header class="cat-header get-id" id="<?php echo $id; ?>">
        <div class="cat-top-post">
                    <?php while ($post = $top->fetch_assoc()) : ?>
                    <img src="<?php echo $post['post_picture']; ?>" alt="">
                    
                    <div class="container">
                        <h1 class="display-4"><?php echo $post['post_title']; ?></h1>
                        <p class="lead"><?php echo $post['post_intro']; ?></p>
                        <a href="post.php?id=<?php echo $post['id']; ?>"> Read More </a>
                    </div>
                    <?php endwhile; ?>
        </div>
 </header>


<?php 
        //recent and popular buttons
?>
        <div class="container selectors d-flex ">
                <header class="d-flex ">
                        <button id="recent" class="">recent</button>
                        <button  id="popular" class="">popular</button>
                </header> 
        </div>





<?php 
        //section where the articles will be shown after pressing the recent or popular button
        // it will be filled by javascript through a ajax connenction 
?>
        <section>
            <div class="container-fluid margin">
                <div class="row  cards" id="posts">

                </div>
            </div>
        </section>

     <?php 
        //The show all button by default it is hidden it will only be shown after pressing either of the recent or popular button 
    ?>   
  
  <div class="container text-center showall"><button id="show-more" class="">show all</button></div>
        
             
           
            





<?php include 'includes/footer-section.php'; ?>

<?php include_once 'includes/footer.php'; ?>