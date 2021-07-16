<?php

  include 'includes/head.html';
  include 'includes/header.php';

?>

<!--_______________________________________ Carousel__________________________________ -->
<div class="allcontain">
	<div id="carousel-up" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner " role="listbox">
			<div class="item active">
				<img src="public/image/oldcar.jpg" alt="oldcar">
				<div class="carousel-caption">
					<h2>Porsche 356</h2>
					<p>Lorem ipsum dolor sit amet, consectetur ,<br>
						sed do eiusmod tempor incididunt ut labore </p>
				</div>
			</div>
			<div class="item">
				<img src="public/image/porche.jpg" alt="porche">
				<div class="carousel-caption">
					<h2>Porche</h2>
						<p>Lorem ipsum dolor sit amet, consectetur ,<br>
						sed do eiusmod tempor incididunt ut labore </p>
				</div>
			</div>
			<div class="item">
				<img src="public/image/benz.jpg" alt="benz">
				<div class="carousel-caption">
					<h2>Car</h2>
					<p>Lorem ipsum dolor sit amet, consectetur ,<br>
						sed do eiusmod tempor incididunt ut labore </p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="allcontain">
	<div class="contact">
		<div class="newslettercontent">
			<div class="leftside">
				<img id="image_border" src="image/border.png" alt="border">
					<div class="contact-form">
						<h1 style="color: black !important;">Contact Us</h1>
							<div class="form-group group-coustume">
							<div style="color:#f8c72d; font-size:16px;"><?php if (!empty($data['message'])) echo 'You succesfully applied'; ?></div>
							<div style="color:red; font-size:16px;"><?= $data['error'] ?? '';?></div>
                                <form action="" method="POST">
								<input type="text" class="form-control name-form" placeholder="Name" name="name" style="color: black !important;">
								<input type="text" class="form-control email-form" placeholder="E-mail" name="email" style="color:black !important;">
								<input type="text" class="form-control subject-form" placeholder="Subject" name="subject" style="color:black !important;">
								<textarea rows="4" cols="50" class="message-form" style="color:black !important;" name="description"></textarea >
								<input type="submit" class="btn btn-default" name="submit" value="Submit" style="margin-bottom:30px; background-color:#F8C72D; ">
                                </form>
                            </div>
                            <div class="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d5992.187045978265!2d19.81877419017888!3d41.32857965728201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ssq!2s!4v1620505687929!5m2!1ssq!2s" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
			</div>
		</div>

	</div>
</div>
<?php  include 'includes/footer.html'; ?>

