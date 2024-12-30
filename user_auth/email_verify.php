<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .container{
            margin-top: 120px;
            width: 350px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-success">Verify Email</h3>
        <p class="text-center">Please Enter The OTP sent to your Email Below:</p>
        <form action="verify.php" method="get">
            <div class="form-group">
                <label for="otp">Enter OTP Code:</label>
                <input type="text" class="form-control" name="token">
            </div>

            <div class="form-group">
                <button class="btn btn-success mt-3 form-control">Verify</button>
            </div>
        </form>
    </div>
</body>
</html>