<?php
include('includes/config.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Thean</title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" href="assets/semantic-ui/dist/semantic.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">

	<script type="text/javascript" src="assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$("#preloader").show();
	</script>
</head>
<body>
	<?php include('includes/menu-bar.php');?>
	<div class="pusher">
		<div class="ui page vertically divided centered grid">
			<div class="row">
				<div class="column">
					<div class="ui fluid container slider">
						<div class="owl-carousel" id="single-slider">
							<a class="item"><img src="assets/img/1000x400.png"></a>
							<a class="item"><img src="assets/img/1000x400.png"></a>
							<a class="item"><img src="assets/img/1000x400.png"></a>
							<a class="item"><img src="assets/img/1000x400.png"></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row section">
				<div class="column">
					<h1 class="ui header">Products</h1>
					<br>
					<div class="ui three stackable link cards">
						<?php include('includes/category-card.php');?>
					</div>
				</div>
			</div>
			<div class="ui row section segment">
				<div class="column">
					<h1 class="ui header">About Us</h1>
					<div class="ui stackable grid">
						<div class="row section">
							<div class="eight wide column">
							</div>
							<div class="eight wide column" style="text-align: justify;">
								We are a social enterprise based in Chennai , Tamilnadu in southern India.We were incubated as a social enterprise in Indian Institute of Technology Madras  almost 8 yrs back. We were involved initially in tourism in remote parts of tamilnadu as a major focus and slowly our acquaintance with the tribals in the remote parts led to exploration of honey as a product. Initial feedback received from the trial run suggested that there is good demand for raw honey as a product as it is a regular ingredient for all medicine in Ayurveda. 
								We run a for profit company called ecologin which helps in marketing the products of rural and tribal people  and a  Non Governmental organisation called Basecamp which works in capacity development amongst the tribals and imparts training to ensure quality of products. the above efforts enabled us to give good returns tour tribal partners who have begun trusting us and we have been able to spread our collection across Tamilnadu. Our plan is to spread our collection across India.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row section">
				<div class="column">
					<h1 class="ui header">Why Us</h1>
					<br>
					<div class="ui three stackable link cards">
						<div class="card">
							<div class="image">
								<img src="assets/img/400x400.png">
							</div>
							<div class="center aligned content">
								<div class="header">Rock Bee Honey (Malai Thaen)</div>
								<div class="description">
									Under Rs.399/-
								</div>
							</div>
						</div>
						<div class="card">
							<div class="image">
								<img src="assets/img/400x400.png">
							</div>
							<div class="center aligned content">
								<div class="header">Dammer Bee Honey (Siru Thaen)</div>
								<div class="description">
									Under Rs.399/-
								</div>
							</div>
						</div>
						<div class="card">
							<div class="image">
								<img src="assets/img/400x400.png">
							</div>
							<div class="center aligned content">
								<div class="header">Indian Bee Honey (Pondhu Thaen)</div>
								<div class="description">
									Under Rs.399/-
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row section">
				<div class="column">
					<h1 class="ui header">Contact Us</h1>
					<div class="ui grid segment">
						<div class="row">
							<div class="eight wide column" align="left">
								Address:<br>
								Phone number:<br>
								E-mail:<br>
							</div>
							<div class="eight wide column">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="column">
					Powered by Cousins Lab - 2017
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="assets/semantic-ui/dist/semantic.js"></script>
	<script type="text/javascript" src="assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>	
</body>
</html>