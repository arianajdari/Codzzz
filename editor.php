<?php include 'includes/header.php'; ?>
<?php include 'app/session_control.php'; ?>
<?php include 'app/load_project.php'; ?>  
<?php include 'app/print_elements.php'; ?>

<script type="text/javascript" src="public/js/jquery.js"></script>

<div id="mainarea">
    <div id="left"> 
        <?php printelements($project); ?>
    </div>
    <div id="middle">
    	<div class="openDialog" id="Folder" style="border-left:1px solid white;">
    		new Folder
    	</div>
    	<div class="openDialog" id="File">
    		new File
    	</div>
    	<div class="openDialog" id="Delete">
    		Delete
    	</div>
    </div>
    <div class="down" id="dropzone">
        Drop to Upload
    </div>
    <div id="right">
    	<textarea id="myTextarea">
    		
    	</textarea>
    	<div id="operations">
	    	<form method="post">
	    		<input id='path' type="hidden" name="path">
	    		<button class="save">Save</button>
	    	</form>
    	</div>
    </div>
    <div id="dialog">
    	<div id="title">
    		<div id='exit'>X</div>
    	</div>
    	<div id="name">
    		<label for='filename'>Enter the name:</label>
    		<input id="filename" type="text" name="filename">
    	</div>
    	<div id="files">
    	<ul>
    		
    	</ul>
    	</div>
    </div>
</div>
    
<script type="text/javascript" src="app/codemirror/lib/codemirror.js"></script>
<script type="text/javascript" src="public/js/custom_2.js"></script>


