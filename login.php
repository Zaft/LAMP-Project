<?php require('header.php'); ?>
<div id="background">
    <img src="images/grass.jpg" class="stretch" alt="" />
</div>
        <form method="post" action="userlogin.php">
            <p><strong>Username:</strong><br/>
            <input type="text" name="username"/></p>
            <p><strong>Password:</strong><br/>
            <input type="password" name="password"/></p>
            <p><input type="submit" name="submit" value="login"/></p>
        </form>
        
        <h3> Don't have an account? </h3>
        <p>Click <a href="createaccount.php">here</a> to create an account </p>
        
<?php require('footer.php'); ?>