<!--sidebar start-->
<aside>
  <div id="sidebar"  class="nav-collapse ">
   <!-- sidebar menu goes here-->
   <ul class="sidebar-menu" id="nav-accordion">
    <li class="active">
      <a class="" href="<?php echo URL . 'admin/dashboard.php'?>">
        <i class="icon-dashboard"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="sub-menu">
      <a href="javascript:;" class="">
        <i class="icon-tag"></i>
        <span>Category</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub">
        <li><a class="" href=" <?php echo URL . 'admin/category/create_category.php' ?>">Create Category</a></li>
        <li><a class="" href=" <?php echo URL . 'admin/category/view_category.php' ?>"> View Category</a></li>
      </ul>
    </li>
    <li class="sub-menu">
      <a href="javascript:;" class="">
        <i class="icon-tags"></i>
        <span>Sub-Category</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub">
        <li><a class="" href=" <?php echo URL . 'admin/subcategory/create_subcategory.php' ?>">Create Sub-Category</a></li>
        <li><a class="" href=" <?php echo URL . 'admin/subcategory/view_subcategory.php' ?>"> View Sub-Category</a></li>
      </ul>
    </li>
    <li class="sub-menu">
      <a href="javascript:;" class="">
        <i class="icon-tags"></i>
        <span>Photographer</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub">
        <li><a class="" href=" <?php echo URL . 'admin/photographer/create_photographer.php' ?>">Create Photographer</a></li>
        <li><a class="" href=" <?php echo URL . 'admin/photographer/view_photographer.php' ?>"> View photographer</a></li>
      </ul>
    </li>
     <li class="sub-menu">
      <a href="javascript:;" class="">
        <i class="icon-tags"></i>
        <span>Top Ten Photographer</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub">
        <li><a class="" href=" <?php echo URL . 'admin/photographer/view_top_ten.php' ?>"> View photographer</a></li>
      </ul>
    </li>
      <li class="sub-menu">
      <a href="javascript:;" class="">
        <i class="icon-tags"></i>
        <span>User Account</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub">
        <li><a class="" href=" <?php echo URL . 'admin/photographer/create_user_account.php' ?>"> Create User Account</a></li>
        <li><a class="" href=" <?php echo URL . 'admin/photographer/create_admin.php' ?>"> Create Admin Account</a></li>
      </ul>
    </li>
      <li class="sub-menu">
      <a href="javascript:;" class="">
        <i class="icon-picture"></i>
        <span>Image</span>
        <span class="arrow"></span>
      </a>
      <ul class="sub">
        <li><a class="" href=" <?php echo URL . 'admin/home/create_background.php' ?>">Add Image</a></li>
        <li><a class="" href=" <?php echo URL . 'admin/home/view_image.php' ?>"> View Home</a></li>
      </ul>
    </li>
  </ul>
</div>
</aside>

