<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$user = new User();
$userDetail = $user->getUserDetail();
$photographer = new Photographer();
$detail = $photographer->getPhotographerDetail();
require_once(ROOT . 'user/includes/header.php');
require_once(ROOT . 'user/includes/navbar.php');
?>
<!--main content start-->
<section id="main">
  <section class="container">
    <!-- page start-->
    <div class="row">
      <?php require_once(ROOT . 'user/includes/sidebar.php');?>
      <aside class="profile-info col-lg-9">
        <section class="panel">
          <header class="panel-heading">
            Bio Graph
            <a href="<?= URL . 'user/profile/edit_profile.php'; ?>" class="btn btn-primary btn-xs pull-right"><i class="icon-edit"></i> Edit Profile</a>
          </header>
          <div class="panel-body bio-graph-info">
            <div class="row">
              <div class="bio-row">
                <p><span>First Name </span>: <?= escape($userDetail->first_name);?></p>
              </div>
              <div class="bio-row">
                <p><span>Last Name </span>: <?= escape($userDetail->last_name);?></p>
              </div>
              <div class="bio-row">
                <p><span>Subcategory </span>: 
                <?= $userDetail->subcategory_name ?>
                </p>
              </div>
              <div class="bio-row">
                <p><span>Gender </span>: 
                <?php if(isset($userDetail->gender)) {?>
                  <?= gender($userDetail->gender) ?>
                <?php }else { ?>
                  <a href="<?= URL . 'user/profile/edit_profile.php'; ?>">Add Gender</a>
                <?php }?>
              </div>
              <div class="bio-row">
                <p><span>Caption </span>: <?php 
                  if(!empty($userDetail->caption)){
                    ?>
                    <?= escape($userDetail->caption)?>
                    <?php
                  }else{?>
                  <span class="text-danger">Caption Not Set</span>
                  <?php
                }?></p>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </section>
      </aside>
      <aside class="profile-info col-lg-9">
        <section class="panel">
          <header class="panel-heading">
            Details About You
            <?php if(count($detail) > 0) {?>
              <a href="<?= URL . 'user/profile/edit_about.php'; ?>" class="btn btn-primary btn-xs pull-right"><i class="icon-edit"></i> Edit Detail</a>
            <?php }?>
          </header>
          <div class="panel-body bio-graph-info">
            <?php if(count($detail) > 0) { ?>
              <p><span>Contact Number </span>: <?= escape($detail->contact_num);?>
                <?php if($detail->show_contact == 0) { ?> 
                <span class="text-danger">(hide)</span>
                <?php }else{?>
                <span class="text-warning">(show)</span>
                <?php } ?>
              </p>
              <p><span>Address </span>: <?= escape($detail->address);?></p>
              <p><span>Facebook </span>: 
              <?php if(empty($detail->facebook)) { ?>
                <a class="text-danger" href="<?= URL . 'user/profile/edit_about.php'; ?>">Add Facebook Url</a>
              <?php }else { ?>
                <a href="<?php echo $detail->facebook;?>"><?= escape($detail->facebook);?></a>
              <?php }?></p>
              <p><span>Twitter </span>: 
              <?php if(empty($detail->twitter)) { ?>
                <a class="text-danger" href="<?= URL . 'user/profile/edit_about.php'; ?>">Add Twitter Url</a>
              <?php }else { ?>
                <a href="<?php echo $detail->twitter;?>"><?= escape($detail->twitter);?></a>
              <?php }?></p>
              <p><span>Linkedin </span>: 
              <?php if(empty($detail->linkedin)) { ?>
                <a class="text-danger" href="<?= URL . 'user/profile/edit_about.php'; ?>">Add Linkedin Url</a>
              <?php }else { ?>
                <a href="<?php echo $detail->linkedin;?>"><?= escape($detail->linkedin);?></a>
              <?php }?></p>
              <p><span>Instagram </span>: 
              <?php if(empty($detail->instagram)) { ?>
                <a class="text-danger" href="<?= URL . 'user/profile/edit_about.php'; ?>">Add Instagram Url</a>
              <?php }else { ?>
                <a href="<?php echo $detail->instagram;?>"><?= escape($detail->instagram);?></a>
              <?php }?></p>
              <p><span>Google </span>: 
              <?php if(empty($detail->google)) { ?>
                <a class="text-danger" href="<?= URL . 'user/profile/edit_about.php'; ?>">Add Google Url</a>
              <?php }else { ?>
                <a href="<?php echo $detail->google;?>"><?= escape($detail->google);?></a>
              <?php }?></p>

              <div class="clearfix"></div>
              <hr>
              <h4>Details: </h4>
              <?= $detail->detail;?>
            <?php } else {?>
            <div class="form-signin" align="center">
              <i class="icon-bullhorn icon-5x icon"></i><p> Start writing about yourself.. </p>
              <a href="<?= URL . 'user/profile/create_about.php'?>" class="btn btn-primary text-white">Create About</a>
            </div>
            <?php }?>
          </div>
        </section>
      </aside>
    </div>
    <!-- page end-->
  </section>
</section>
<!--main content end-->
<?php
require_once(ROOT . 'user/includes/footer.php')
?>