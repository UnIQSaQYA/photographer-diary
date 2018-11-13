<?php
require_once('../../core/init.php');

$subCategory = new subCategory();
$subCategoryDetail = $subCategory->getSubCategory();

$category = new Category();
$categoryDetails = $category->getAllCategory();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
  $subCategory->updateSubCategory();  
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
          Edit Sub Category
        </header>
        <div class="panel-body">
          <form role="form" method="post">
            <?php echo Token::inputToken(); ?>
            <div class="form-group col-lg-6 <?php echo (hasError('sName')?'has-error':''); ?>" style="padding: 0px;" >
              <label for="subcategoryName" class="col-lg-12 control-label">Sub Category Name</label>
              <div class="col-lg-12">
                <input type="text" class="form-control" name="sName" placeholder="Sub Category Name"
                 value="<?= escape($subCategoryDetail->subcategory_name);?>" ?>
                 <?= validationErrors('help-block', 'sName');?>
              </div>
            </div>

             <div class="form-group col-lg-6 <?php echo (hasError('cid')?'has-error':''); ?>" style="padding: 0px;">
              <label for="CategoryName" class="col-lg-12 control-label">Category Name</label>
              <div class="col-lg-12">
                <select name="cid" class="form-control">
                  <?php foreach ($categoryDetails as $detail) { ?>
                  <option value="<?= escape($detail->id);?>"> <?= escape($detail->category_name);?> </option>
                  <?php } ?>
                </select>
                <?= validationErrors('help-block', 'cid');?>
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
