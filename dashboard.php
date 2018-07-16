<?php include 'includes/header.php'; ?>
<?php include 'app/session_control.php'; ?>
<?php include 'app/load_dashboard.php'; ?>  

<div id="main_dashboard">
<div id="projects">
	<h1>Projects Under Development</h1>
	<?php foreach ($projects as $project) : ?>
	<section class="project_items">
		<div class="project_image">
			<img src='storage/project_pictures/<?php echo $project['project_profile_picture'];   ?>' alt="" />
		</div>
    

    <?php  $i = 0; ?>
    <?php foreach ($colloborations as $colloborator) : ?>
    <?php if($colloborator['user_id'] == $_SESSION['user']['id'] and $colloborator['project_name'] == $project['project_name']) : ?>
        <p class="info"> Project Name: <a href="editor.php?name=<?php echo $project['project_name']; ?>"><?php echo $project['project_name'];?></a></p>
        <?php $i = 1; break; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php if($i !== 1) : ?>
        <p class="info"> Project Name: <?php echo $project['project_name'];?></p>
    <?php endif; ?>
        
		     
        
    <?php $i = 0; ?>         
        
		<p class="info"> Description: <?php echo $project['project_description']; ?></p>
		<p class="info"> Owner:&nbsp;<a href="profile.php?id=<?php echo $project['user_id'];  ?>"><?php echo $project['owner']; ?></a></p>
		<p class="info">Website: <a href="app/mysite.php"><?php  echo $project['project_unique_host']; ?>.localtunnel.me</a></p>

    <?php foreach ($colloborations as $colloborator) : ?>
    <?php if($colloborator['user_id'] === $_SESSION['user']['id'] and $colloborator['project_name'] === $project['project_name']) : ?>
        <?php $i = 1; break; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php if($i === 0) : ?>
       <p class="info"><a href="#"> Be part of this project</a></p>
    <?php endif; ?>
		
	</section>
	<?php endforeach; ?>
		
</div>  
</div>

 