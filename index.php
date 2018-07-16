<?php include 'includes/header.php'; ?>
<?php
    
    if($_SESSION['user']){
        header('Location: dashboard.php');
    }

?>
    <div id="main">
        <div class="content content_1">
            <section>
                <h1>Hassle to develop?</h1>
                <p>Ever had <strong>problems</strong> setting up <strong>development environment?</strong><br> Or had <strong>compatibility</strong> issues when moving from one system to another?<br><br> With <strong>Codzzz</strong>, you get a pre-configured virtual machine with all development tools.<br></p>
                <h3>Includes</h3>
                <ul>
                    <li>Apache2</li>
                    <li>PHP</li>
                    <li>MySQL</li>
                    <li>Custom domain</li>
                    <li>Code sharing</li>
                    <li>...and many more</li>
                </ul>
            </section>
            <section>
                <img src="resources/virtualmachine.png" alt="" />
            </section> 
        </div>
        <div class="content content_1 content_2 white">
            <section>
                <h1>Sleek code editor</h1>
                <p>With out code editor, writing code has never been easier.<br>With support for more than <strong>100 languages</strong>, it should meet all your needs.</p>
                <h3>Supports</h3>
                <ul>
                    <li>HTML</li>
                    <li>CSS</li>
                    <li>JavaScript</li>
                    <li>MySQL</li>
                    <li>...and many more</li>
                </ul>
            </section>
            <section>
                <img src="resources/codeeditor.png" alt="" />
            </section> 
        </div>
        <div class="content content_1 content_3  orange">
            <section>
                <h1>Stuck?</h1>
                <p>With <strong>Codzzz</strong> supporting peer-to-peer learning, it is impossible to be stuck on your way learning programming.</p>
                <h3>Offers</h3>
                <ul>
                    <li>Personal inbox</li>
                    <li>Be part as many as 5 projects</li>
                    <li>Share and view code</li>
                    <li>Learn together</li>
                </ul>
            </section>
            <section>
                <img src="resources/p2p.png" alt="" />
            </section> 
        </div>
        <div class="content content_1 content_4   green">
            
            <section>
                <h1>Sign Up</h1>
                <form id="signup" method="post" action="app/signup.php">
                    <input type="text" name="first_name" placeholder="Name">
                    <input type="text" name="last_name" placeholder="Lastname">
                    <input type="email" name="email" placeholder="E-mail">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" name="signup" value="Sign Up!">
                </form>
            </section>
            <section>
                <h1>Sign In</h1>
                <form id="signin" method="post" action="app/signin.php">
                    <input type="email" name="email" placeholder="E-mail">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" name="signin" value="Sign In!">
                </form>
            </section> 
        </div>
        
    </div>

 <?php include 'includes/footer.php'; ?>