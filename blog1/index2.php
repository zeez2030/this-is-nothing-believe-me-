<?php 
include_once 'includes/header.php';
include 'config/config.php';
include 'classes/database.php';
include 'helpers/format_helper.php';
?>
<?php include 'includes/navbar.php'; ?>
<?php 
if (isset($_GET['message'])) :
?>
    <div class="alert alert-danger container" role="alert">
  <?php echo $_GET['message']; ?>
    </div>
    <?php endif; ?>

    <form class="container login-form" action="process.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
<?php include 'includes/footer-section.php'; ?>

<!--html footer-->

<?php include_once 'includes/footer.php'; ?>