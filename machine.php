<?php include 'includes/header.php'; ?>
<?php include 'app/session_control.php'; ?>
<?php include 'app/loadmachine.php'; ?>


   
    
    <div id="main_dashboard">
      
      <div class="things">
      	<?php if(isset($machine['user_id'])) : ?>
                  <div class="image">
                        <img style="max-height:200px;margin-left:15px;" src="storage/virtual_machine_pictures/<?php echo $machine['profile_picture']; ?>"/>
                  </div>
                  <div class='elements'>
                        <p>Name: <?php echo $machine['name'];?></p>
                  </div>
                  <div class='elements'>
                        <p>Owner: <a href="profile.php?id=<?php echo $machine['user_id'] ?>"><?php echo $machine['first_name'] . ' ' . $machine['last_name']; ?></a></p>
                  </div>
                  <?php if($_SESSION['user']['id'] === $machine['user_id']) : ?>
                        <div class='elements'>
                              <form id="upload" action="app/uploadmachineimage.php" method="post" enctype="multipart/form-data">
                                    <input type="file" name="image">
                                    <input type="submit" name="submit" value="Upload">
                              </form>
                        </div>
                  <?php endif; ?>
            <?php else : ?>
                  <div class='elements'>
                        <p>You do not own a virtual machine<br>Virtual machine can be created in a brezze!!<br>Just choose a name</p>
                  </div>

                  <div style="margin-top:40px;" class="elements">
                         <form id="upload" action="app/createvirtualmachine.php" method="post">
                              <input type="text" name="name">
                              <input type="submit" name="submit" value="Create">
                        </form>
                  </div>

            <?php endif; ?>
      </div>   
    
    </div>

 <?php include 'includes/footer.php'; ?>