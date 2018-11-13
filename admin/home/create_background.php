<?php
require_once('../../core/init.php');

$background = new Background();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
  $background->createImage();    
}
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
include(ROOT . '/admin/includes/sidebar.php');
?>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <!--main content goes here-->
    <div class="col-lg-12">
      <?php echo sessionDisplayMessage(); ?>
      <?php echo uploadErrors('alert alert-danger'); ?>
      <section class="panel">
        <header class="panel-heading">
          Add Background Image
        </header>
        <div class="panel-body">
          <form role="form" method="post" enctype="multipart/form-data">
            <?php echo Token::inputToken(); ?>
            <div class="form-group col-lg-6 <?php echo (hasError('profile')?'has-error':''); ?>" style="padding: 0px;">
            <label for="profile" class="col-lg-12 control-label">Background Image</label>
              <div class="col-lg-12">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                  </div>
                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                  <div>
                    <span class="btn btn-white btn-file">
                      <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                      <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                      <input type="file" name="image" class="default" />
                    </span>
                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-6 <?php echo (hasError('img_type')?'has-error':''); ?>" style="padding: 0px;">
              <label for="image_type" class="col-lg-12 control-label">Image Type</label>
              <div class="col-lg-12">
                <select name="img_type" class="form-control">
                  <option value="background">Background</option>
                  <option value="cover">Cover</option>
                </select>
                <?= validationErrors('help-block', 'img_type'); ?>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-danger">Add</button>
            </div>
          </form>
        </div> <!-- enf of panel-body -->
      </section>
    </div>

  </section>
</section>
<!--main content end-->
<?php
require_once(ROOT . '/admin/includes/footer.php');
?>
