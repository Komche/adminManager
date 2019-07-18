<?php
global $title;
$title = "Inscription";
if (!empty($_POST)) {
    extract($_POST);
} else {
    $username = '';
    $email = '';
}
global $errors;
ob_start();
include('navbar.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form class="form" action="" method="post">
                <h2 class="text-center">Login</h2>
                <hr>
                <!-- display form error messages  -->
                <?php include("messages.php") ?>
                <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : '' ?>">
                    <label class="control-label">Username or Email</label>
                    <input type="text" name="email" id="password_" value="<?php echo $email; ?>" class="form-control">
                    <?php if (isset($errors['email'])) : ?>
                        <span class="help-block"><?php echo $errors['email'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo isset($errors['password_']) ? 'has-error' : '' ?>">
                    <label class="control-label">Password</label>
                    <input type="password_" name="password_" id="password_" class="form-control">
                    <?php if (isset($errors['password_'])) : ?>
                        <span class="help-block"><?php echo $errors['password_'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </form>
        </div>
    </div>
</div>


<?php
global $content;
$content = ob_get_clean();
require('template.php');
?>