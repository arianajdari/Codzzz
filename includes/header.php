<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <title><?php echo ucfirst(split('.php', split('/', $_SERVER['REQUEST_URI'])[3])[0]); ?></title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="public/css/custom.css">
    <link rel="stylesheet" type="text/css" href="app/codemirror/lib/codemirror.css">  
</head>

<body>
    <header>
        <div id="home">
            <div id="get_home">Codzzz</div>
        </div>
        
        <?php if(isset($_SESSION['user'])) : ?>
            <div id="content_l">
                <center>
                   <?php echo ucfirst(split('.php', split('/', $_SERVER['REQUEST_URI'])[3])[0]); ?>
                </center>
            </div>
            <div id="loggedin">   
                <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];  ?>


                <div id="items">
                    <div class="item"><a href="profile.php?id=<?php echo $_SESSION['user']['id'];   ?>">Profile</a></div>
                    <div class="item"><a href="machine.php?id=<?php echo $_SESSION['user']['id'];   ?>">Machine</a></div>
                    <div class="item"><a href="projects.php?id=<?php echo $_SESSION['user']['id'];   ?>">Projects</a></div>
                    <div class="item"><a href="#">Inbox</a></div>
                    <div class="item"><a href="app/signout.php">Sign Out</a></div>
                </div>
            </div>
        <?php else : ?>
            <div id="content">
                <center>
                    
                </center>
            </div>
            <div id="signup">
                Sign Up    
            </div>
             <div id="signin">
                Sign In
            </div>
        <?php endif; ?>
    </header>
    <script type="text/javascript">
        var element = document.getElementById('get_home');

        element.onclick = function() {
            window.location.href ='dashboard.php';
        };
    </script>