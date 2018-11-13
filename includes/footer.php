<?php
$obj  = new Home();
$photographers = $obj->getLatestPhotographer();
?>
	<!-- /Content -->

	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 footerleft ">
				<!-- 	<div class="logofooter"> <a class="" href="<?= URL . 'home' ?>"><img src="<?= ASSET . "image/pglogo.png" ?>" alt="photographersDiary" style="width: 80px !important;"></a></div>
 -->					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
					<!-- <p><i class="fa fa-map-pin"></i> 210, Aggarwal Tower, Rohini sec 9, New Delhi -        110085, INDIA</p>
					<p><i class="fa fa-phone"></i> Phone (India) : +91 9999 878 398</p>
					<p><i class="fa fa-envelope"></i> E-mail : info@webenlance.com</p>
					 -->
				</div>
				
				<div class="col-md-3 col-sm-6 col-md-offset-1 paddingtop-bottom">
					<h6 class="heading7">LATEST PHOTOGRAPHER</h6>
					<div class="post">
						<?php foreach($photographers as $photographer):?>
							<p><?= $photographer->first_name." ".$photographer->last_name?> <span><?= $photographer->created_at ?></span></p>
						<?php endforeach ?>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 paddingtop-bottom">
					<div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<div class="fb-xfbml-parse-ignore">
							<blockquote cite=""><a href="">Facebook</a></blockquote>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--footer start from here-->

	<div class="copyright">
		<div class="container">
			<div class="col-md-6">
				<p>© <?php echo date("Y") ?>- All Rights with photographersDiary</p>
			</div>
			<!-- <div class="col-md-6">
				<ul class="bottom_ul">
					<li class="active"><a href="#">photographersdiary.com</a></li>
					<li><a href="#">About us</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Faq's</a></li>
					<li><a href="#">Contact us</a></li>
					<li><a href="#">Site Map</a></li>
				</ul>
			</div> -->
		</div>
	</div>
	<!-- /Footer -->

	<!-- JS -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.primary-navbar').scrollToFixed({
			preFixed: function() { $(this).addClass('shrink'); },
			postFixed: function() { $(this).removeClass('shrink'); }
		});
	});

</script>
</body>
</html>