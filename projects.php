<?php include 'includes/header.php'; ?>
<?php include 'app/session_control.php'; ?>
<?php include 'app/loadprojects.php'; ?>


   
    
    <div id="main_dashboard">
      
      <div class="things">
            <?php if(isset($project['user_id'])) : ?>
                  <div class="image">
                        <img style="max-height:200px;margin-left:15px;" src="storage/project_pictures/<?php echo $project['profile_picture']; ?>"/>
                  </div>
                  <div class='elements'>
                        <p>Name: <a href="app/mysite.php"><?php echo $project['name'];?></a></p>
                  </div>
                  <div class='elements'>
                        <p>Owner: <a href="profile.php?id=<?php echo $project['user_id'] ?>"><?php echo $project['first_name'] . ' ' . $project['last_name']; ?></a></p>
                  </div>
                  <div class='elements'>
                        <p>Description: <?php echo $project['description']; ?></p>
                  </div>
                  <?php if($_SESSION['user']['id'] === $project['user_id']) : ?>
                        <div class='elements'>
                              <form id="upload" action="app/uploadprojectimage.php" method="post" enctype="multipart/form-data">
                                    <input type="file" name="image">
                                    <input type="submit" name="submit" value="Upload">
                              </form>
                        </div>
                  <?php endif; ?>
            <?php else : ?>
                  <div class='elements'>
                        <p>You do not own a project<br>In order to start writing PHP, create a project<br>Choose a name and a description of the project<br><br></p>
                  </div>

                  <div style="margin-top:100px;" class="elements">
                         <form id="upload" action="app/createproject.php" method="post">
                              <input style="width:30%;"  type="text" name="name" placeholder="Name" >
                              <input style="width: 30%;"  type="text" name="description" placeholder="Description" >
                              <input type="submit" name="submit" value="Create">
                        </form>
                  </div>

            <?php endif; ?>
      </div>      
    
    </div>

 <?php include 'includes/footer.php'; ?>