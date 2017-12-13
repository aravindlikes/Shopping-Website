<?php
include('../includes/config.php');
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
	<link rel="stylesheet" href="../assets/semantic-ui/dist/semantic.css">
	<link rel="stylesheet" href="../assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.css">

	<script type="text/javascript" src="../assets/jquery/jquery.js"></script>
	<script type="text/javascript">
		$("#preloader").show();
	</script>
	<style type="text/css">
		.ui.grid{
			margin: 0px !important;
		}
	</style>
</head>
<body>
	<?php include('includes/menu-bar.php');?>
	<div class="pusher">
		<div class="ui page vertically divided grid">
			<div class="row">
				<div class="ui stackable grid" style="padding: 5% !important; margin: 0px;">
					<div class="row">
						<div class="thirteen wide column">
							<div class="ui stackable grid">
								<div class="row">
									<div class="column">
										<article>
											<div class="ui stackable vertically divided grid">
												<?php
													$poid = intval($_GET['poid']);
													$sql = "SELECT * from blogpost where poststatus='1' and id=".$poid;
													$query = mysqli_query($connection,$sql);
													if(!(mysqli_num_rows($query)>0))
													{
														echo "<script>location='index.php';</script>";
													}													
													while($row=mysqli_fetch_array($query)){
												?>
												<div class="row">
													<div class="ten wide column">
														<h3><a href="article.php?poid=<?php echo $row['id']; ?>"><?php echo $row['posttitle']; ?></a></h3>
														<h4>Written by <?php echo $row['postby']." at ".$row['posttime']; ?></h4><br>
														<p style="text-align: justify;">
															<?php echo $row['postcontent']; ?>
														</p>
													</div>
													<div class="six wide column">
														<div class="ui large image">
															<img src="../admin/appimage/post/<?php echo $row['postimage']; ?>">
														</div>
													</div>
												</div>
												<?php 
													}
												?>
											</div>
										</article>
									</div>
								</div>
								<div class="row" align="center">
									<div class="column">
										<div class="ui buttons">
											<?php
												$poid = intval($_GET['poid']);
												$sql = "SELECT * from blogpost where poststatus='1' and id<".$poid." order by id desc limit 1";
												$query = mysqli_query($connection,$sql);
												if((mysqli_num_rows($query)>0)){
												$row=mysqli_fetch_array($query);
											?>
												<a class="ui primary button" style="width: 30%;" href="article.php?poid=<?php echo $row['id']; ?>">Previous</a>
											<?php 
												}else{
											?>
												<a class="ui disabled primary button" style="width: 30%;">Previous</a>
											<?php 													
												}
												$poid = intval($_GET['poid']);
												$sql = "SELECT * from blogpost where poststatus='1' and id>".$poid." order by id asc limit 1";
												echo $sql;
												$query = mysqli_query($connection,$sql);
												if((mysqli_num_rows($query)>0)){
												$row=mysqli_fetch_array($query);
											?>
												<a class="ui primary button" style="width: 30%;" href="article.php?poid=<?php echo $row['id']; ?>">Next</a>
											<?php 
												}else{
											?>
												<a class="ui disabled primary button" style="width: 30%;" href="article.php">Next</a>
											<?php 
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="three wide column">
							<label class="ui header">Recent Posts</label>
							<div class="ui relaxed divided list">
								<?php
									$sql = "SELECT * from blogpost where poststatus='1' order by posttime asc limit 5";
									$query = mysqli_query($connection,$sql);
									while($row=mysqli_fetch_array($query)){
								?>								
								<div class="item">
									<div class="content">
										<a class="header" href="article.php?poid=<?php echo $row['id']; ?>"><?php echo $row['posttitle']; ?></a>
										<div class="description">Updated <?php echo $row['posttime']; ?></div>
									</div>									
								</div>
								<?php 
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" align="center">
				<div class="column">
					Powered by Cousins Lab - 2017
				</div>
			</div>			
		</div>
	</div>
	<script type="text/javascript" src="../assets/semantic-ui/dist/semantic.js"></script>
	<script type="text/javascript" src="../assets/js/owl.carousel.js"></script>
	<script type="text/javascript" src="../assets/js/main.js"></script>	
</body>
</html>