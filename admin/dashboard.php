<?php
    require_once('../core/init.php');
    Session::isLoggedIn();
    $obj = new Dashboard();
    $users = $obj->registeredUser();
    require_once(ROOT . '/admin/includes/header.php');
    require_once(ROOT . '/admin/includes/navbar.php');
    require_once(ROOT . '/admin/includes/sidebar.php');
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--main content goes here-->
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">Notification
                </div>
                <div class="panel">
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>username </th>
                                <th>email</th>
                                <th>joined</th>
                                <th>other</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($users) > 0){ ?>
                                <?php foreach($users as $user) { ?>
                                    <tr>
                                        <td><?= $user->id?></td>
                                        <td><?= $user->username?></td>
                                        <td><?= $user->email?></td>
                                        <td><?= $user->joined ?></td>
                                        <td><a href="<?= URL . 'admin/activate.php?id=' .$user->id?>">Activate</a></td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?> 
                                <tr>
                                    <td>Currently nothing to display</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->


<?php
	require_once(ROOT . '/admin/includes/footer.php');
?>
