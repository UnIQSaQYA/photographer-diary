<?php
require_once('../../core/init.php');

$category = new Category();
$categoryDetail = $category->getCategory();

if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
  $category->updateCategory();  
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
      <section class="panel">
        <header class="panel-heading">
          Edit Category
        </header>
        <div class="panel-body">
          <form role="form" method="post">
            <?php echo Token::inputToken(); ?>
            <div class="form-group col-lg-6 <?php echo (hasError('cName')?'has-error':''); ?>" style="padding: 0px;" >
              <label for="categoryName" class="col-lg-12 control-label">Category Name</label>
              <div class="col-lg-12">
                <input type="text" class="form-control" name="cName" placeholder="Category Name"
                 value="<?= escape($categoryDetail->category_name);?>" ?>
                 <?= validationErrors('help-block', 'cName');?>
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
