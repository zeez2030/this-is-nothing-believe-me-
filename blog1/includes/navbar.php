<section id="nav-bar">
    <div class="nav-container container-fluid">
        <nav class="navbar  fixed-top  justify-content-between">
            <!--  Span to keep the logo centered and the icon right-side  -->
            <?php 
            if (isset($_SESSION['user_name']) & $_SERVER['PHP_SELF'] != "/blog1/index2.php") :
            ?>
            <span><?php echo $_SESSION['user_name']; ?>
                
                <a href="process.php?logout=true" class="btn btn-outline-primary ml-4">Log out </a>
            </span>
           
              <?php 
                elseif (!isset($_SESSION['user_name']) & $_SERVER['PHP_SELF'] != "/blog1/index2.php") :
                ?>
            <span> <a href="process.php?login=true" class="btn btn-outline-secondary ml-4">Log In </a> </span>
              <?php 
                endif;
                ?>
            <a class="navbar-brand " href="index.php">
                <img src="img/logo.png" alt="APEC">
            </a>
            <a href="#" id="searchBtn"><i class="fa fa-search" ></i></a>
        </nav>
    </div>
</section>
   
            <!---------------------- the modal that appears when click the search icon  ------------------------->

<div class="" id="whitepage">
    <div class="modal-content">
        <span class="closeBtn" id="closeBTN">&times;</span>
        <div class="brand"><h1>APEC</h1></div>
        <div class="search container">
            <input id="scriptBox" type="text" class="form-control"name="search" placeholder="Search something">
        </div>




        <?php 
                //this will show only after the user press the search icon 
        ?>
        <div class="tags-area">
            <p class="text-muted">Can't find what you looking for? try Tags</p>
            <div class="tags container ">
                <?php 
                //                  connection to the database to get the tags to view them in buttons
                $db = new Database;
                $query = "SELECT DISTINCT post_tags from posts order by id desc ;";
                $tags = $db->get_query_result($query);



                //                 
                //                    
                //                    maybe a post has more than one tag they will be sperated by commas
                //                  so we use the (getArray) function that will split the tagname into array and return it
                //                      
                //
                //
                //
                while ($tag = $tags->fetch_assoc()) :
                    $t = getArray($tag['post_tags']);
                $i = 0;
                //
                //          this while is to go through each element and put it inside a button tag 
                //  
                //
                while ($i < count($t)) :
                ?>
                
                <button id="tag" class=""> <a href="tag.php?tag=<?php echo $t[$i]; ?>"><?php echo $t[$i]; ?></a>  </button>
                 <?php $i++;
                endwhile;
                ?>   
                <?php endwhile; ?>
                
            </div>
        </div>
    </div>
</div>