<?php
    if(isset($_POST['login'])){
        //build a function to validate data
        function validateFormData($formData){
            $formData = trim(stripslashes(htmlspecialchars($formData)));
            return $formData;
        }
        
        // create variables
        // wrap the data with our function
        $formUser = validateFormData($_POST['username']);
        $formPass = validateFormData($_POST['password']);
        
        //connect to database
        include('connection.php');
        
        // create SQL query
        $query = "SELECT username, email, password FROM users WHERE username='$formUser'";
        
        // store the result
        $result = mysqli_query($conn, $query);
        
        // verify if result is returned
        if(mysqli_num_rows($result) > 0){
            // store basic user data in variables
            while($row = mysqli_fetch_assoc($result)){
                $user = $row['username'];
                $email = $row['email'];
                $hashedPass = $row['password'];
            }
            
            // verify hashed password with the typed password
            if(password_verify($formPass, $hashedPass)){
                //correct login details:
                // start the session
                session_start();
                
                //store data in SESSION variables
                $_SESSION['loggedInUser'] = $user;
                $_SESSION['loggedInEmail'] = $email;
                
                header("Location: profile.php");
            } else { //hashed password didn't verify
                // error message
                $loginError = "<div class='alert alert-danger'>Wrong username / password combination. Try again.</div>";
            }
        } else { // there are no results in database
            $loginError = "<div class='alert alert-danger'>NO such user in the database! <a class='close' data-dismiss='alert'>$times</a></div>";
        }
        // close the mysql connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        Login
    </title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1>Login</h1>
        
        <p class="lead">Use this form to log in to your account</p>
        
        <?php echo $loginError; ?>
        
        <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <label for="username">User Name</label><br>
          <input type="text" name="username"> <br>
          <label for="password">Password</label><br>
          <input type="password" name="password"><br><br>
          <button type="submit" name="login">Login</button>
        </form>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>