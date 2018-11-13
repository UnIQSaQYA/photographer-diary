<?php

require_once('core/init.php');

$obj = new Home();
$ajax = new Ajax();
$photographer = $obj->getPhotographer();
$datas = $obj->getPhotographerEventById();
$gallerys = $obj->getGallery();
$obj->hitCounter();
$type = $obj->getPhotographerType();
$type = $obj->getPhotographerType();
$photographer_types = array_unique($type, SORT_REGULAR);
require_once(ROOT . 'includes/header.php');
require_once(ROOT . 'includes/navbar.php');
?>
<style type="text/css">

	.navbar {
		margin-bottom: -20px !important;
	}
	.comma:after{
    content: ", ";
	}
	.comma:last-child{
		content: " ";
	}
</style>
<header class="detail-header">
	<div class="fb-profile">
		<img align="left" class="fb-image-lg" src="<?= ASSET . checkImage($photographer->cover_pic, 'profile');?>" alt="Profile image example"/>

		<div class="container">
			<img align="left" class="fb-image-profile thumbnail" src="<?= ASSET . checkImage($photographer->profile_pic, 'profile'); ?>" alt="Profile image example"/>
			<div class="fb-profile-text pull-left">
				<h5 class="text-muted"><?= $photographer->first_name . ' '. $photographer->last_name?></h5>
			</div>
			<ul class="nav nav-tabs pull-right" style="margin-right: 10px;">
				<li><a href="#about" data-toggle="tab" id="aboutTab">About</a></li>
				<li><a href="#events" data-toggle="tab" id="eventsTab">Events</a></li>
				<li><a href="#portfolio" data-toggle="tab">Portfolio</a></li>
			</ul>
		</div>
	</div>
	<!-- Nav tabs -->
</header>
<div class="clearfix"></div>
<!-- Tab panes -->
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<div class="panel">
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane active" id="about">
								<?php if(!empty($photographer->detail)) {?>
								<div class="col-md-4">

									<p>Email : <?= $photographer->email; ?></p>
									<p>Address : <?= $photographer->address ?></p>
									category:
									<?php foreach($photographer_types as $type): ?>
										<span class="comma"><?php echo $type->subcategory_name?></span>
									<?php endforeach ?>
									<hr>
									<?php if(!empty($photographer->address)){ ?>
									<a href="<?= $photographer->facebook ?>" class="facebook"><i class="icon-facebook"></i></a>
									<?php } ?>
									<?php if(!empty($photographer->google)){ ?>
									<a href="<?= $photographer->google ?>"><i class="icon-google-plus"></i></a>
									<?php } ?>
									<?php if(!empty($photographer->twitter)){ ?>
									<a href="<?= $photographer->twitter ?>"><i class="icon-twitter"></i></a>
									<?php } ?>
									<?php if(!empty($photographer->instagram)){ ?>
									<a href="<?= $photographer->instagram ?>"><i class="icon-instagram"></i></a>
									<?php } ?>
									<?php if(!empty($photographer->linkedin)){ ?>
									<a href="<?= $photographer->linkedin ?>"><i class="icon-linkedin"></i></a>
									<?php } ?>
								</div>
								<div class="col-md-8">
									<?= $photographer->detail; ?>  
								</div>
								<?php }else{?>
								<div class="text-center">
									<span class="" align="center">
										<i class=" icon-frown icon-5x"></i>
									</span>
									<br>
									<h4>No description available</h4>
								</div>
								<?php }?>
							</div>
							<div class="tab-pane" id="events">
								<div class="ajax">
									<?php if(count($datas) > 0) { ?>
									<ul class="grid cs-style-3">
										<?php foreach($datas as $data) {?> 
										<li>
											<figure>
												<img src="<?= ASSET . checkImage($data->image, 'event'); ?>" alt="Event Image" height="200px;">

												<figcaption>
													<?php if(!empty($data->caption)){?>
													<h3><?= substr($data->caption, 0, 10); ?></h3>
													<?php }else {?>
													<h3>No caption</h3>
													<?php }?>
													<a href="#" class="eventImg" data-id="<?= $data->id; ?>">Take a look</a>
												</figcaption>
											</figure>
										</li>
										<?php } ?>
									</ul>
									<?php }else {?>
									<div class="text-center">
										<span class="" align="center">
											<i class=" icon-frown icon-5x"></i>
										</span>
										<br>
										<h4>No Portfolio available</h4>
									</div> 
									<?php } ?>
								</div>
							</div>
							<div class="tab-pane" id="portfolio">
								<?php if (count($gallerys) > 0){ ?> 
								<div class="row masonry-container">
									<?php foreach($gallerys as $gallery) {?>
									<div class="col-md-6 col-sm-6 item">
										<img src="<?= ASSET . checkImage($gallery->photo, 'gallery'); ?>" class="media__image"/>
										<div class="media__body">
											<?php if(!empty($gallery->caption)) {?> 
											<p><?= $gallery->caption; ?></p>
											<?php }else { ?> 
											<p>No caption added</p>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
								</div>
								<?php }else{ ?> 
								<div class="text-center">
									<span class="" align="center">
										<i class=" icon-frown icon-5x"></i>
									</span>
									<br>
									<h4>No Portfolio available</h4>
								</div> 
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	(function( $ ) {

		var $container = $('.masonry-container');
		$container.imagesLoaded( function () {
			$container.masonry({
				columnWidth: '.item',
				itemSelector: '.item'
			});
		});



    //Reinitialize masonry inside each panel after the relative tab link is clicked - 
    $('a[data-toggle=tab]').each(function () {
    	var $this = $(this);

    	$this.on('shown.bs.tab', function () {

    		$container.imagesLoaded( function () {
    			$container.masonry({
    				columnWidth: '.item',
    				itemSelector: '.item'
    			});
    		});

        }); //end shown
    });  //end each
    
})(jQuery);

</script>
<script type="text/javascript">
	$(function () {
		prev = $(".ajax").html(); 
		$('.eventImg').click(function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var baseUrl = "<?= URL . 'ajax.php' ?>";
			var ASSET = "<?= ASSET .'image/event/'?>";
			$.ajax({
				url: baseUrl,
				data: {'do': 'get_ajax_data', 'id': id},
				type: 'get',
				cache: false,
				dataType: 'json',
				success:function(data) {
					if(data.status == "success") {
						var output = "<div class='row masonry-container'>";
						$.each(data.result, function(i, each){
							output+="<div class='col-md-4 item'>";
							for(res in each) {
								if(res=="id") {
									output+="<img class='media__image' src='" + ASSET + each.image + "' />";
									output+="<div class='media__body'>"
									output+="<p>" + each.caption + "</p>"
									output+="</div>"
								}
							}
							output+="</div>"
						});
						$(".ajax").html(output);
						
						var $container = $('.masonry-container');
						$container.imagesLoaded( function () {
							$container.masonry({
								columnWidth: '.item',
								itemSelector: '.item'
							});
						});
					}else{
						var output = "<p> Nothing to display</p>";
						$(".ajax").html(output);
					}
				}
			});

			$("#eventsTab").click(function(){
				if($("#event").find(".masonry-container"))
				{
					$(".ajax").html(prev);
				}else{

				}
			});
		});
	});

</script>
<script type="text/javascript">
	$(function() {
        //    fancybox
        jQuery(".fancybox").fancybox();
    });

</script>
<?php
require_once(ROOT . 'includes/footer.php');
?>