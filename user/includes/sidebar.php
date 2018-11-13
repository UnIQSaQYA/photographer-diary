<?php
$user = new User();
$userDetail = $user->getUserDetail();
?>
<aside class="profile-nav col-lg-3">
    <section class="panel">
        <div class="user-heading round">
            <a href="#">
                <img src="<?= ASSET . checkImage($userDetail->profile_pic, 'profile') ?>">
            </a>
            <h1><?php echo Session::get('username'); ?></h1>
            <p><?php echo Session::get('email'); ?></p>
        </div>

        <ul class="nav nav-pills nav-stacked">
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'class="active"' ?>><a href="<?= URL .'user/dashboard.php';?>"> <i class="icon-home"></i> Dahboard</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'view_profile.php') echo 'class="active"' ?> <?php if (basename($_SERVER['PHP_SELF']) == 'edit_profile.php') echo 'class="active"' ?>><a href="<?= URL .'user/profile/view_profile.php';?>"> <i class="icon-user"></i> Profile</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'event_detail.php') echo 'class="active"' ?> <?php if (basename($_SERVER['PHP_SELF']) == 'create_event.php') echo 'class="active"' ?> <?php if (basename($_SERVER['PHP_SELF']) == 'create.php') echo 'class="active"' ?>><a href="<?= URL .'user/event/view_event.php'; ?>"> <i class=" icon-calendar"></i> Event</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'view_portfolio.php') echo 'class="active"' ?> <?php if (basename($_SERVER['PHP_SELF']) == 'create_portfolio.php') echo 'class="active"' ?>><a href="<?= URL .'user/portfolio/view_portfolio.php'; ?>"> <i class=" icon-picture"></i> Portfolio</a></li>
            <li><a href="<?= URL . 'user/logout.php';?> "> <i class="icon-edit"></i> Logout</a></li>
        </ul>
    </section>
</aside>