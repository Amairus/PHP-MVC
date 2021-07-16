<?php
  if(isset($_GET['error']) && $_GET['error'] == 'empty_fields'){
    echo '<h4>Please enter all fields.</h4>';
  }
  if(isset($_GET['messagge']) && $_GET['messagge'] == 'success'){
    echo '<h4>Edit was made successfully</h4>';
  }
?>
	<!-- Navbar Up -->
	<nav class="topnavbar navbar-default topnav">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed toggle-costume" data-toggle="collapse" data-target="#upmenu" aria-expanded="false">
					<span class="sr-only"> Toggle navigaion</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand logo" href="#"><img src="../../pubic/image/images.png" width="90" alt="logo"></a>
			</div>
		</div>
		<div class="collapse navbar-collapse" id="upmenu">
			<ul class="nav navbar-nav" id="navbarontop">
				<li class="active"><a href="../Home">HOME</a> </li>
        <li class="active"><a href="../Rental">Rent a Car</a></li>
        <?php if (App\Services\AbstractService::userLoggedin()):?>
        <li><a href="../Home\Logout">Logout</a></li>
		<li><a href="../Profiles"><img src="../public/image/user.png" width="16">	Profile</a></li>
        <?php else: ?>
        <li><a href="../Signup">Register</a></li>
        <?php endif ?>
				<button><span class="postnewcar"><a href="../Rental\AddCar">POST NEW CAR</a></span></button>
			</ul>
		</div>
	</nav>
