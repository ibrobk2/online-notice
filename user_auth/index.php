<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication</title>
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
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h2>User Authentication</h2>
                <p class="text-muted">Please enter your registration number</p>
            </div>
            <?php
                   include "authController.php";
                   include "errors.php";

            ?>
            <div class="auth-form">
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label for="regNumber" class="form-label">Registration Number</label>
                        <input type="text" 
                               class="form-control" 
                               id="regNumber" 
                               name="regNumber" 
                               placeholder="Enter your registration number"
                               required>
                    </div>
                    <button type="submit" class="btn btn-success btn-submit" name="auth-btn">
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
