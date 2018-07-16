<?php include 'includes/header.php'; ?>
<?php include 'app/session_control.php'; ?>
<?php include 'app/loadprofile.php'; ?>

   
    
    <div id="main_dashboard">
      
      <div class="things">
      	<div class="image">
      		<img style="max-height:200px;margin-left:15px;" src="storage/profile_pictures/<?php echo $user['profile_picture']; ?>"/>
      	</div>
      	<div class='elements'>
      		<p>First Name: <?php echo $user['first_name'];?></p>
      	</div>
      	<div class='elements'>
      		<p>Last Name: <?php echo $user['last_name']; ?></p>
      	</div>
      	<div class='elements'>
      		<p>E-mail: <?php echo $user['email']; ?></p>
      	</div>
      	<?php if($_SESSION['user']['id'] === $user['id']) : ?>
      		<div class='elements'>
	      		<form id="upload" action="app/uploadprofileimage.php" method="post" enctype="multipart/form-data">
	      			<input type="file" name="image">
	      			<input type="submit" name="submit" value="Upload">
	      		</form>
      		</div>
      	<?php endif; ?>
      
      </div>   
    
    </div>

 <?php include 'includes/footer.php'; ?>