<?php
require_once('../../core/init.php');
Session::isLoggedIn();
$obj = new photographerInfo();
if(Input::method() && Token::checkToken(Input::post('csrf_token'))) {
	$obj->createEventImage();
}
require_once(ROOT . '/admin/includes/header.php');
require_once(ROOT . '/admin/includes/navbar.php');
include(ROOT . '/admin/includes/sidebar.php');
?>
<section id="main-content">
	<section class="wrapper">
		<!--main content goes here-->
		<div class="col-lg-12">
			<?php echo sessionDisplayMessage(); ?>
			<?php echo uploadErrors('alert alert-danger'); ?>
			<section class="panel">
				<header class="panel-heading">
					Add Event Image
				</header>
				<div class="panel-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<?php echo Token::inputToken(); ?>
						<div id="sections">
							<div class="section">
								<div class="form-clone">
									<div class="form-group col-lg-6 <?php echo (hasError('profile')?'has-error':''); ?>" style="padding: 0px;">
										<label for="profile" class="col-lg-12 control-label">Event Pic</label>
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
														<input type="file" name="image[]" class="default" />
													</span>
													<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group col-lg-6 <?php echo (hasError('cover')?'has-error':''); ?>" style="padding: 0px;">
										<label for="Event cover" class="col-lg-12 control-label">cover</label>
										<div class="col-lg-12">
											<input type="checkbox" class="check" name="cover[]" onChange="cbChange(this)"> Set as Cover
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-group col-lg-6 <?php echo (hasError('caption')?'has-error':''); ?>" style="padding: 0px;">
										<label for="Event Caption" class="col-lg-12 control-label">Caption</label>
										<div class="col-lg-12">
											<input type="text" class="form-control" name="caption[]" placeholder="Event caption">
											<?= validationErrors('help-block', 'caption'); ?>
										</div>
									</div>
									<div class="clearfix"></div>
									<p><a href="#" class='remove'>Remove Section</a></p>
								</div>
							</div>
						</div>
						<div class="form-group col-lg-12">
							<a href="#" class='btn btn-success addsection'>Add Image</a>
							<button type="submit" class="btn btn-danger">Save</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</section>
<script type="text/javascript">
//define template
var template = $('#sections .section:first').clone();

//define counter
var sectionsCount = 1;

//add new section
$('body').on('click', '.addsection', function() {

//increment
sectionsCount++;

//loop through each input
var section = template.clone().find(':input').each(function(){

//set id to store the updated section number
var newId = this.id + sectionsCount;

//update for label
$(this).prev().attr('for', newId);

//update id
this.id = newId;

}).end()

//inject new section
.appendTo('#sections');
return false;
});

//remove section
$('#sections').on('click', '.remove', function() {
//fade out section
$(this).parent().fadeOut(300, function(){
//remove parent element (main section)
$(this).parent().parent().empty();
return false;
});
return false;
});
</script>

<script type="text/javascript">
$('form').submit(function () {
    $(this).find('input[type="checkbox"]').each( function () {
        var checkbox = $(this);
        if( checkbox.is(':checked')) {
            checkbox.attr('value','1');
        } else {
            checkbox.after().append(checkbox.clone().attr({type:'hidden', value:0}));
            checkbox.prop('disabled', true);
        }
    })
});
function cbChange(obj) {
    var cbs = document.getElementsByClassName("check");
    for (var i = 0; i < cbs.length; i++) {
        cbs[i].checked = false;
    }
    obj.checked = true;
}
</script>
<?php
require_once(ROOT . '/admin/includes/footer.php');

?>