

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        Password Hashing
    </title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1>Password Hashing</h1>
        
        <?php
//            $password = password_hash("Qu3ntin1988", PASSWORD_DEFAULT);
//            echo $password;
        $hashedPassword = '$2y$10$aa6adcSZgDm1s9QZO9W7heZwIo.okSHlvy4kmR6g3cAs.MM1OL0Q6';
        
        
        
        if(isset($_POST['login'])){
           if(password_verify($_POST['password'], $hashedPassword)){
            echo "Password is correct";
            } else {
                echo "Incorrect password!";
            } 
        }
        
        ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="password">* Password</label>
            <input type="password" name="password"><br><br>
            
            <input type="submit" name="login" value="Log in">
            
        </form>
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>