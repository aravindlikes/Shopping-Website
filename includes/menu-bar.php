<div id="preloader"></div>
<div class="computer tablet only">
	<div class="ui fixed menu navbar">
		<a href="index.php" class="brand item">Project Name</a>
		<div class="right menu">
			<div class="ui simple dropdown item">Buy
				<i class="dropdown icon"></i>
				<div class="menu">
					<?php
						$sql= "SELECT id,categoryName from category limit 6";
						$result = mysqli_query($connection,$sql);
						while($row = mysqli_fetch_array($result)){
					?>					
					<a class="item" href="subproduct.php?cid=<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></a>
					<?php } ?>
				</div>
			</div>
			<a class="item" href="blog\"><i class=""></i>Blog</a>
			<a href="my-cart.php" class="item"><i class="shop icon"></i>Cart</a>
			<?php if(strlen($_SESSION['login']))
			{
			?>
				<a class="item" href="my-account.php"><i class="user icon"></i>Account</a>
				<a class="item" href="logout.php"><i class="sign out icon"></i>Sign out</a>				
			<?php				
			}else{
			echo '<a href="login.php" class="item"><i class="sign in icon"></i>Login</a>';				

			}
			?>
		</div>
	</div>
</div>
<div class="mobile only">
	<div class="ui navbar fixed menu">
		<a href="index.php" class="brand item">Project Name</a>
		<div class="right menu">
			<?php if(strlen($_SESSION['login']))
			{
			?>
				<a class="item" href="logout.php"><i class="sign out icon"></i></a>
			<?php				
			}else{
			echo '<a href="login.php" class="item"><i class="sign in icon"></i></a>';				

			}
			?>
			<div class="item open">
				<i class="sidebar icon"></i>
			</div>				
		</div>
	</div>
	<div class="ui sidebar overlay vertical menu">
		<div class="ui item">
			<div class="text">Buy</div>
			<div class="menu">
				<?php
					$sql= "SELECT id,categoryName from category limit 6";
					$result = mysqli_query($connection,$sql);
					while($row = mysqli_fetch_array($result)){
				?>
				<a class="item" href="subproduct.php?cid=<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></a>
				<?php } ?>
			</div>
		</div>
		<div class="menu">
			<a href="my-cart.php" class="item"><i class="shop icon"></i>Cart</a>
			<?php if(strlen($_SESSION['login']))
			{
			?>
				<a class="item" href="my-account.php"><i class="user icon"></i>Account</a>
				<a class="item" href="logout.php"><i class="sign out icon"></i>Sign out</a>				
			<?php				
			}else{
			echo '<a href="login.php" class="item"><i class="sign in icon"></i>Login</a>';				

			}
			?>
		</div>
		<div class="ui divider"></div>
		<div class="menu">
			<a class="item" href="blog\"><i class=""></i>Blog</a>
		</div>
	</div>
</div>