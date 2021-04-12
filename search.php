<?php
	session_start();
	$pageTitle='search';
	include 'init.php';
	?>
	
	<div class="container">
	<form action="items.php" method="post">
			<div class="col-sm-12">
				<div class="col-sm-3">
					District
					<select name="district">
						
						<option value="الحى السادس">الحى السادس</option>
						<option value="الحى السابع">الحى السابع</option>
						<option value="الحى العاشر">الحى العاشر</option>
					</select>
				</div>
				<div class="col-sm-3">
					Minimum Price
					<select name="min_price">
						
						<option value="200EG">200EG</option>
						<option value="250EG">250EG </option>
						<option value="300EG">300EG </option>
					</select>
				</div>
				<div class="col-sm-3">
				Maximum Price
					<select name="max_price">
						
						<option value="250EG">250EG</option>
						<option value="350EG">350EG</option>
						<option value="400EG">400EG </option>
					</select>
				</div>	
				<div class="col-sm-3">

					<input type="submit" value="Search" class="btn btn-danger">
				</div>
				
			</div>
		</form>
	</div>

<?php
	include $tp1.'footer.php';?>