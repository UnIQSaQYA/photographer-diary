<?php

require_once('core/init.php');

$photographerObj = new Home();
$photographers = $photographerObj->getAllPhotographer();
$image = $photographerObj->getCoverImage();
$sn = (Pagination::$_current_page*Pagination::$_limit)-Pagination::$_limit;
require_once(ROOT . 'includes/header.php');
require_once(ROOT . 'includes/navbar.php');
?>
<style type="text/css">
	
	.navbar {
		margin-bottom: -10px !important;
	}

	.card .content-card .main {
		min-height: 0;
	}
	.card-container, .front, .back {
		height: 290px;
	}

	.card .content-card {
		padding-bottom: 0px;
		padding-top: 0px !important;
	}

	ul.alphabets li {
		padding-right: 10px;
		padding-left: 20px;
		padding-bottom: 5px;
	}
</style>

<!-- Header -->
<header class="cover-picture">
	<?php if(isset($image)){ ?>
	<img src="<?= ASSET . "image/background/". $image->image ?>">
	<?php }else{ ?>
		<img src="public_html/image/cover.jpg">
	<?php } ?>
</header>

<div class="content">
	<div class="container">
		<div class="row">
			
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="btn-toolbar" role="toolbar" aria-label="...">
							<div class="btn-group" role="group" aria-label="...">
								<a href="#" class="btn btn-info text-white">All Photographers</a>
								<?php foreach (range('A', 'Z') as $char): ?>
									<a href="<?= URL .'photographer?sort='.$char ?>"  class="btn btn-default"><?php echo $char . "\n"; ?></a>
								<?php endforeach ?>
							</div>
						</div>
					</div>	
				</div>
				<div class="row">
									<?php if(!empty($photographers)){ ?>
				<?php foreach($photographers as $photographer){ ?>
				<div class="col-md-4 col-sm-6">
					<div class="card-container manual-flip">
						<div class="card">
							<div class="front">
								<div class="cover">
									<img src="<?= ASSET .checkImage($photographer->cover_pic, 'profile')?>"/>
								</div>
								
								<div class="user">
									<img class="img-circle" src="<?= ASSET .checkImage($photographer->profile_pic, 'profile') ?>"/>
								</div>
								<div class="content-card">
									<div class="main">
										<h2 class="name"><a href="<?= URL . $photographer->slug ?>"><?= $photographer->first_name .' ' .$photographer->last_name?></a></h2>
									</div>
									<div class="footer">
										<button class="btn btn-simple" onclick="rotateCard(this)">
											<i class="icon-mail-forward"></i> Flip
										</button>
									</div>
								</div>
							</div> <!-- end front panel -->
							<div class="back">
								<div class="content-card">
									<div class="main">
										<h4 class="text-center">Photographer Description</h4>
										<div class="text-center"><?= html_substr($photographer->detail, 115) ?></div>

										<div class="stats-container">
											<div class="stats">
												<h4><a href="<?= $photographer->facebook ?>" class="facebook"><i class="icon-facebook icon-fw"></i></a></h4>
												
											</div>
											<div class="stats">
												<h4>
													<a href="<?= $photographer->google ?>" class="google"><i class="icon-google-plus icon-fw"></i></a></h4>
												</div>
												<div class="stats">
													<h4><a href="<?= $photographer->twitter ?>" class="twitter"><i class="icon-twitter icon-fw"></i></a></h4>
												</div>
											</div>

										</div>
									</div>
									<div class="footer">
										<a class="btn btn-simple text-center" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
											<i class="icon-reply"></i> Back
										</a>
									</div>
								</div> <!-- end back panel -->
							</div> <!-- end card -->
						</div> <!-- end card-container -->
					</div> <!-- end col sm 3 -->
					<?php } ?>
					<?php }else{?>
					<div class="col-md-12 col-sm-12">
						<div class="panel" align="center">
							<i class="icon-bullhorn icon-5x"></i>
							<h3>No photographer has been added yet</h3>
						</div>
					</div>
					<?php } ?>
				</div> <!-- end col-sm-10 -->					
				</div>

				<div class="text-center">
					<?php
					$photographerObj = new Home();
					$photographerObj->pagination; 
					?>
				</div>
			</div> <!-- end row -->
		</div>	
	</div>

	<!-- /Header -->
	<script type="text/javascript">
		$().ready(function(){
			$('[rel="tooltip"]').tooltip();

		});

		function rotateCard(btn){
			var $card = $(btn).closest('.card-container');
			console.log($card);
			if($card.hasClass('hover')){
				$card.removeClass('hover');
			} else {
				$card.addClass('hover');
			}
		}
	</script>
	<?php
	require_once(ROOT . 'includes/footer.php');
	?>