<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <title><?= $title ?></title>
</head>

<body>
    <div class="container">
        <!-- The closing container div is found in the footer -->
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">UserAccounts</a>
                    </div>
                    <!-- <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
      </ul> -->
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['user'])) : ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $_SESSION['user']['username'] ?> <span class="caret"></span></a>

                                <?php if (UserManager::isAdmin($_SESSION['user']['id'])) : ?>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo  'admin/profile.php' ?>">Profile</a></li>
                                        <li><a href="<?php echo 'admin/dashboard.php' ?>">Dashboard</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo 'index.php?action=logout' ?>" style="color: red;">Logout</a></li>
                                    </ul>
                                <?php else : ?>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo 'index.php?action=logout' ?>" style="color: red;">Logout</a></li>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php else : ?>
                            <li><a href="<?php echo 'index.php?action=signup' ?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li><a href="<?php echo 'index.php?action=login' ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>

            <?php echo $content ?>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="public/js/display_profile_image.js"></script>
        <script src="public/js/script.js"></script>
</body>

</html>