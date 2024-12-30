

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    </head>
<body>
    <?php
session_start();
$conn = new mysqli("localhost", "root", "", "online_notice");



if(isset($_GET['token'])){
     $token = $_GET['token'];

    $sql = "SELECT * FROM user WHERE token='$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $id = $data['id'];
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $data['email'];

        $verify = 'true';
        $query = "UPDATE user SET verified=? WHERE id=?";
        $stmts = $conn->prepare($query);
        $stmts->bind_param('si', $verify, $id);
        if($stmts->execute()){
            echo "<script>swal('Congrats', 'Email Verified Successfully..', 'success')
            .then(function(result){window.location='./update_login.php?id=$id'})</script>";
        }
    }else{
        echo "<script>swal('Error', 'Invalid OTP entered', 'error')
        .then(function(result){window.location='./email_verify.php'})</script>";

    }

    




}

?>



</body>
</html>
