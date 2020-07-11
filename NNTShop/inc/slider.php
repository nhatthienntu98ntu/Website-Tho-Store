<div class="header_bottom">
	<div class=" header_bottom_left">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php
				$show_Slider = $product->show_Slider();
				if ($show_Slider) {
					$dem = 0;
					while ($result = $show_Slider->fetch_assoc()) {
						if ($dem == 0) { ?>
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<?php $dem++;
						} else { ?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $dem ?>"></li>
				<?php }
					}
				} ?>
			</ol>
			<div class="carousel-inner">
				<?php
				$show_Slider = $product->show_Slider();
				if ($show_Slider) {
					$dem = 0;
					while ($result = $show_Slider->fetch_assoc()) {
						if ($dem == 0) {
				?>
							<div class="carousel-item active">
								<img class="d-block w-100 " src="admin/uploads/<?php echo $result['sliderImage'] ?>" max-width="100%" width="100%" height="310px">
								<div class="carousel-caption d-none d-md-block">
								</div>
							</div>
						<?php $dem++;
						} else { ?>
							<div class="carousel-item ">
								<img class="d-block w-100 " src="admin/uploads/<?php echo $result['sliderImage'] ?>" max-width="100%" width="100%" height="310px">
								<div class="carousel-caption d-none d-md-block">
								</div>
							</div>

				<?php
						}
					}
				} ?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	
	<div class="header_bottom_right_images">
		<img height="310px" width="100%" src="images/2.jpg" alt="">
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="imgbackgrough">
		<img src="images/backgrough.png" alt="">
	</div>
</div>