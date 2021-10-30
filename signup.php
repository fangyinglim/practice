<?php

    $username = $password = $email = '';
    // $errors = ['username' => '', 'password'=>'', 'email' => ''];
    $errors = array('username' => '', 'password'=>'', 'email' => ''); //this works as well, better practice
    $errorSwitch = false;
    echo 'testing :' . $_POST['submit']; //returns 'Sign Up, value of button'
    //empty vs isset
    //empty checks if variable is empty, i.e. returns TRUE if variable == 0, NULL, FALSE or empty value
    //isset checks if variable has a value, i.e returns TRUE if variable == false, 0, empty value; returns FALSE for NULL 
    if(isset($_POST['submit'])) {
        // assign to variable then check instead to keep code shorter:
        // $username = $_POST['username'];
        // if empty($_POST['username']) {
        //     $errors['username'] = 'Username cannot be empty';
        // }
        if(empty($_POST['username'])) {
            $errors['username'] = 'Username cannot be empty';
            $errorSwitch = true;
        } else {
            $username = $_POST['username'];      
        }
        if(empty($_POST['password'])) {
            $errors['password'] = 'Password cannot be empty';
        } else {
            $password = $_POST['password'];
        }

        if(empty($_POST['email'])) {
            $errors['email'] = 'Email cannot be empty';
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Not a valid email address';
            }
        }

        
        $servername = 'localhost';
        $user = 'testuser';
        $pw = '123456';
        $dbname = 'project1_pet';

        $connection = mysqli_connect($servername, $user, $pw, $dbname);
        if (!$connection) {
            die("connection failed:" . mysqli_connect_error()); //die == exit
        } echo 'connected successfully';
        
        
        if(true) {
            // mysqli_real_escape_string adds an escape character, the backslash, \,  
            // before certain potentially dangerous characters in a string passed in to the function. 
            // The characters escaped are \x00, \n, \r, \, ', " and \x1a.
            // This can help prevent SQL injection attacks which are often performed by using the ' character 
            // to append malicious code to an SQL query.
            // $username = mysqli_real_escape_string($connection, ";$:/\ab'cde"); 
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
          
            $sql = "INSERT INTO users (username, pw, email) VALUES ('".$username."', '".$password."', '".$email."')";
            // $sql2 = "INSERT INTO users (username, pw, email) VALUES ('$username', '$password', '$email')";

            echo $sql;
            // echo $sql2;
            
            if(mysqli_query($connection, $sql)) {
                echo 'new user created';
                header( 'Location: index.php'); 
                //cannot use at the bottom of the file, if any HTML is output before this method it wont work
                // echo out javascript method: 
                // echo <script type='text/javascript'> window.location.replace('index.php')</script>"; exit;
                // header() function must be called before any actual output is sent
            } else {
                echo 'error' . mysqli_error($connection);
            }
        }


    }



?>





<!-- leave space to distinguish front end and backend  -->


<?php include('template/header.php')?>

<div class="container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $username ?>" id="username">
            <div class="error-msg"><?php echo $errors['username'];?></div>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="text" name="password" value="<?php echo $password ?>" id="password">
            <div class="error-msg"><?php echo $errors['password'];?></div>

        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $email ?>" id="email">
            <div class="error-msg"><?php echo $errors['email'];?></div>

        </div>
        <div>
            <input type="submit" value="Sign Up" name="submit">
        </div>
    </form>
</div>

<?php include('template/footer.php')?>