<?php 

// if(isset($_POST['submit'])) {
//     echo $_POST[]


// }




?>


<?php include('template/header.php')?>


<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="" id="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="text" name="password" value="" id="password">
        </div>
        <div>
            <input type="submit" value="Login" name="submit">
        </div>

    <p>Not a user? click <a class="signup-link" href="signup.php">here</a> to sign up</p>
        


    </form>
</div>



<?php include('template/footer.php')?>