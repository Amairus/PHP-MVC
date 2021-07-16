<?php

  include 'includes/head.html';
  include 'includes/header.php';
?>

<div class="allcontain">
	<div class="feturedsection">
		<h1 class="text-center" style="color:black !important;"><span class="bdots">&bullet;</span>Y O U R<span class="carstxt">C A R S</span>&bullet;</h1>
	</div>
	<div class="feturedimage">
		<div class="row firstrow">
			<?php foreach($data[0] as $car): ?>
			<div class="col-lg-6 costumcol colborder1">
				<div class="row costumrow">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 img1colon">
						<img src=<?php echo "public/image/".$car->photo; ?> alt="porsche">
					</div>
					<div>
						<img src="<?= $car->icon; ?>" alt="" width="30">
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 txt1colon ">
						<div class="featurecontant">
						<h1><button class="btn btn-danger" id="delete" value=<?=$car->id;?>>Delete</button></h1>
							<p>"Lorem ipsum dolor sit amet, consectetur ,<br>
			 						sed do eiusmod tempor incididunt </p>
			 				<h2><?= $car->price;?> &euro;</h2>
			 				<button id="btnRM" onclick="rmtxt()">READ MORE</button>
			 				<div id="readmore">
			 						<h1>Car Name</h1>
			 						<p>"Lorem ipsum dolor sit amet, consectetur ,<br>
			 						sed do eiusmod tempor incididunt <br>"Lorem ipsum dolor sit amet, consectetur ,<br>
			 						sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1 ,
			 						sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1
			 						sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1<br>
			 						</p>
			 						<button id="btnRL">READ LESS</button>
			 				</div>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="allcontain">
	<div class="feturedsection">
		<h1 class="text-center" style="color:black !important;"><span class="bdots">&bullet;</span>R E S E R V E D<span class="carstxt">C A R S</span>&bullet;</h1>
	</div>
	<div class="feturedimage">
		<div class="row firstrow">
			<?php foreach($data[1] as $car): ?>
			<div class="col-lg-6 costumcol colborder1">
				<div class="row costumrow">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 img1colon">
						<img src=<?php echo "public/image/".$car->photo; ?> alt="porsche">
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 txt1colon ">
						<div class="featurecontant">
							<p>"Lorem ipsum dolor sit amet, consectetur ,<br>
			 						sed do eiusmod tempor incididunt </p>
			 				<h2><?= $car->price;?> &euro;</h2>
			 				<button id="btnRM" onclick="rmtxt()">READ MORE</button>
			 				<div id="readmore">
			 						<h1>Car Name</h1>
			 						<p>"Lorem ipsum dolor sit amet, consectetur ,<br>
			 						sed do eiusmod tempor incididunt <br>"Lorem ipsum dolor sit amet, consectetur ,<br>
			 						sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1 ,
			 						sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1
			 						sed do eiusmod tempor incididunt"Lorem ipsum dolor sit amet, consectetur1<br>
			 						</p>
			 						<button id="btnRL">READ LESS</button>
			 				</div>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php include 'includes/footer.html'; ?>