<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo  'admin/dashboard.php' ?>">Dashboard</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['user'])) : ?>
                    <li><a href="<?php echo  'index.php' ?>"><span class="glyphicon glyphicon-globe"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['user']['username'] . ' (' . $_SESSION['user']['role'] . ')'; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo  'admin/users/editProfile.php' ?>">Profile</a></li>
                            <li><a href="<?php echo  'admin/dashboard.php' ?>">Dashboard</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo  'logout.php' ?>" style="color: red;">Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>