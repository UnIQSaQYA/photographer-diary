<?php
	require_once('../core/init.php');
  Session::isLoggedIn();
  $obj = new User();
  $data = $obj->getUserDetail();
	require_once(ROOT . 'user/includes/header.php');
	require_once(ROOT . 'user/includes/navbar.php');
?>
 <!--main content start-->
      <section id="main">
          <section class="container">
              <!-- page start-->
              <div class="row">
                  <?php require_once(ROOT . 'user/includes/sidebar.php');?>
                  <div class="row state-overview">
                   <div class="col-md-8">
                    <?php echo sessionDisplayMessage(); ?>
                    
                  </div>
                    <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                        <div class="symbol terques">
                          <i class="icon-eye-open"></i>
                        </div>
                        <div class="value">
                          <h1 class="count">
                            <?= $data->counter;?>
                          </h1>
                          <p>Profile Viewed</p>
                        </div>
                      </section>
                    </div>
                    <div class="col-md-3">
                      
                    </div>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

      <script>
       
      </script>
<?php
	require_once(ROOT . 'user/includes/footer.php')
?>