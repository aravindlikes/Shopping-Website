<?php
	$sql= "SELECT * from category where isAvailable=1";
	$result = mysqli_query($connection,$sql);
	while($row = mysqli_fetch_array($result)){
?>
	<a href="subproduct.php?cid=<?php echo $row['id'];?>" class="card">
		<div class="image">
			<img src="admin/appimage/category/<?php echo $row['categoryImage'];?>">
		</div>
		<div class="center aligned content">
			<div class="header"><?php echo $row['categoryName'];?></div>
			<div class="description" style="text-align: justify;">
				<?php echo $row['categoryDescription'];?>
			</div>
		</div>
	</a>
<?php } ?>