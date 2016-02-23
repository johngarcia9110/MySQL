<?php 
 
if( isset( $_POST['login'])){
    //build a function to validate data
    function validateFormData( $formData){
        $formData = trim( stripslashes( htmlspecialchars( $formData)));
        return $formData;
    }
    $formUser = validateFormData( $_POST['username']);
    $formPass = validateFormData( $_POST['password']);
    
    //connect to db
    include('connection.php');
    
    // create SQL query
    $query = "SELECT username, email, password FROM users WHERE username='$formUser'";
    
    //store the result
    $result = mysqli_query( $conn, $query);
    
    //verify if result is returned
    if( mysqli_num_rows($result)>0){
        //store basic user data in some variables
        while( $row = mysqli_fetch_assoc($result)){
            $user       =$row['username'];
            $email      =$row['email'];
            $hashedPass =$row['password'];
        }
        //verify hashed password with the typed password
        if( password_verify( $formPass, $hashedPass)){
            //correct login details
            //start the session
            session_start();
            
            //store data in SESSION variables
            $_SESSION['loggedInUser'] = $user;
            $_SESSION['loggedInEmail'] = $email;
            
            header("Location: profile.php");
        }else{
            //error message
            $loginError = "<div class='alert alert-danger'> Wrong Username/Password combination. Try Again.</div>";
        }
    }else{
        //no results in database
        $loginError = "<div class='alert alert-danger'>No such user in database.<a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    // close the mysql connection
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log In</title>
        
        
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        <div class="container">
            <h1>Log In</h1>
            <p class="lead">Use this form to log in to your account.</p>
            <?php echo $loginError;?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="form-inline" method="post">
               <div class="form-group">
                    <label for="login-username" class="sr-only">Username</label>
                    <input type="text" class="form-control" id="login-username" placeholder="username" name="username">
                </div>
                <div class="form-group">
                    <label for="login-password" class="sr-only">Password</label>
                    <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
                </div>
                <button type="submit" class="btn btn-default" name="login">Login</button>
            </form>


        </div>
    <!--jQuery -->
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>    
    </body>
</html>