<?php 

$db = new Database;
$query = "SELECT * from categories order by category_no_of_articles desc ";
$cats = $db->get_query_result($query);

/*
 *************** This file is responsible of showing the categories in the index page so the user can easily navigate through them ***********

 */


?>

<section id="show-category" class="margin bg-light">

    <div class="row justify-content-center">
        <h1 class="display-1">Looking For Something Specifically ? </h1>

    </div>

    <div class="d-flex justify-content-center categories w-80">
        <div class="row justify-content-center">
            <!--           Category   ---->
            <?php while ($cat = $cats->fetch_assoc()) : ?>
            <div class="d-flex col-auto mb-2">
                <a href="cat.php?id=<?php echo $cat['id']; ?>" class="category-item <?php echo $cat['category_name']; ?>"> 
                <i class = "<?php echo $cat['category_icon']; ?>">
            </i>
               <?php echo $cat['category_name']; ?> </a>
            </div>
<?php endwhile; ?>
                   
            <!--Line-->
            <hr class="col-auto light">

        </div>

    </div>


</section>
