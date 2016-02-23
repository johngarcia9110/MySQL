<?php 

include('connection.php'); 

if( isset( $_POST["add"])){
    function validateFormData( $formData ){
        $formData = trim( stripslashes( htmlspecialchars($formData)));
        return $formData;
    }
    
    $username = $email = $password = $bio = "";
    
    if( !$_POST["username"]){
        $nameError = "Please enter your username <br>";
    }else{
        $name = validateFormData( $_POST["username"]);
    }
    if( !$_POST["email"]){
        $emailError = "Please enter your email <br>";
    }else{
        $email = validateFormData( $_POST["email"]);
    }
    if( !$_POST["password"]){
        $passwordError = "Please enter your password <br>";
    }else{
        $password = validateFormData( $_POST["password"]);
    }
    if( !$_POST["biography"]){
        $biographyError = "Please enter a bio <br>";
    }else{
        $biography = validateFormData( $_POST["biography"]);
    }
    if( $name && $email && $password && $biography){
        $query = "INSERT INTO users (id, username, password, email, signup_date, biography)
        VALUES (NULL, '$name', '$password', '$email', CURRENT_TIMESTAMP, '$biography')";

        if( mysqli_query($conn, $query)){
           echo "<div class='alert alert-success'>New record in database</div?>";
        }else{
           echo "Error:".$query."<br>".mysqli_error($conn);
        }
    }else{
        echo " user:".$name." email:".$email." password:".$password." bio:".$biography;
    }
    
}

mysqli_close($conn);



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MySQL INSERT</title>
        
        
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
            <h1>MySQL Insert</h1>
            

                <p class="text-danger">* Required Fields</p>
                <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"]);?>" method="post">
                    <small class="text-danger">* <?php echo $nameError;?></small>
                    <input type="text" placeholder="Username" name="username"><br><br>
                    <small class="text-danger">* <?php echo $emailError;?></small>
                    <input type="text" placeholder="Email" name="email"><br><br>
                    <small class="text-danger">* <?php echo $passwordError;?></small>
                    <input type="password" placeholder="Password" name="password"><br><br>
                    <small class="text-danger">* <?php echo $biographyError;?></small>
                    <textarea type="text" name="biography"></textarea><br><br>
                    <input type="submit" name="add" value="Add Entry">
                </form>

        </div>
    <!--jQuery -->
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>    
    </body>
</html>