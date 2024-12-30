<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Password</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .auth-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-form {
            padding: 20px;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
session_start();
include '../connection.php';



$errors = array();



if (isset($_POST['update-pass-btn'])){
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if(empty($password) || empty($cpassword)){
        $errors[] = "Please fill in all fields";
    }
    else if($password !== $cpassword) {
        $errors[] = "Passwords do not match";
    }

        // echo "Please fill in all fields";
    else if(strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    else if(!preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[^a-zA-Z0-9]/", $password)) {
        $errors[] = "Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.";
    }
    if (empty($errors)) {
        // Hash the password before storing it in the database
        $hashedPassword = md5($password);

        if($conn){
            echo "still connected";
        }
   
        $user_id = $_SESSION['id'];
        $update_query = "UPDATE user SET pass = '$hashedPassword' WHERE id = $user_id";
        
        if ($conn->query($update_query)) {
            echo "
                <script>
                    swal('Done', 'Password Updated Successful, You can now login with your new password.', 'success')
                    .then(function(result){
                        if(result){window.location = '../index.php?option=login'}
                    });
                </script>
            ";
        }

    }



}

?>
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h2>Update User Password</h2>
            

                <p class="text-muted">Please Choose a Strong Password</p>
            </div>
            <?php
                //    include "authController.php";
                   include "errors.php";

            ?>
            <div class="auth-form">
                <form action="update_login.php" method="POST">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="password" 
                               name="password" 
                               placeholder="Enter your password"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="cpassword" 
                               name="cpassword" 
                               placeholder="Confirm password"
                               required>
                    </div>
                    <button type="submit" class="btn btn-success btn-submit" name="update-pass-btn">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
