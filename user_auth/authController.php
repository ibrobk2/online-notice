<?php
include "../connection.php";


        //PHP MAILER ...
//Include required PHPMailer files
require './config/phpMailer/PHPMailer.php';
require './config/phpMailer/SMTP.php';
require './config/phpMailer/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$errors = array();
$regNo = "";
// $email = "";








if(isset($_POST['auth-btn'])){
    //variables declarations
    $regNo = $_POST['regNumber'];
    
   

    //validation
    if(empty($regNo)){
        $errors['regNo'] = "Registration Number Required";
    } 

   
    $sql = "SELECT * FROM user WHERE regid=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $regNo);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowCount = $result->num_rows;
    if($rowCount==0){
        $errors['exists'] = "User Not Found in The Database";
    }
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $_SESSION['user'] = $row;
   



    if(count($errors)===0){
        $token = substr(time()*rand(),1,6);
        // $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET token=? WHERE regid=?";
        $stmts = $conn->prepare($sql);
        $stmts->bind_param('si', $token, $regNo);
        if($stmts->execute()){
            
            $subject = "OTP Verification Code";
            $message = "Welcome to Online Notice Board, your verification code is: <b>".$token."</b><br> or click verify button to verify your email <br> <a href='http://localhost/online%20notice/user_auth/verify.php?token=$token'>Verify Email</a>";
            $headers = "From: umargarbasani60@gmail.com" . "\r\n" .

            "CC: umargarbasani60@gmail.com";

                 
            //Create instance of PHPMailer
            $mail = new PHPMailer();
            //Set mailer to use smtp
            $mail->isSMTP();
            //Define smtp host
            $mail->Host = "smtp.gmail.com";
            //Enable smtp authentication
            $mail->SMTPAuth = true;
            //Set smtp encryption type (ssl/tls)
            $mail->SMTPSecure = "ssl";
            //Port to connect smtp
            $mail->Port = "465";
            //Set gmail username
            $mail->Username = "umargarbasani60@gmail.com";
            //Set gmail password
            $mail->Password = "apkzrrrhftoayscv";
            //Email subject
            $mail->Subject = $subject;
            //Set sender email
            $mail->setFrom('umargarbasani60@gmail.com', "Email Verification");
            //Enable HTML
            $mail->isHTML(true);
            //Attachment
            // $mail->addAttachment('img/attachment.png');
            //Email body
            $mail->Body = $message;
            //Add recipient
            $mail->addAddress($email);
            //Finally send email
            if ( $mail->send() ) {
            // $_SESSION['sent'] = $subject2;
            echo "
                <script>
                    swal('Done', 'Verification Email Sent Successful, Please Check your email to Verify Now.', 'success')
                    .then(function(result){
                        if(result){window.location = './email_verify.php?email=$email'}
                    });
                </script>
            ";
        }else{
            echo "<span style='color:red;'>OTP could not be sent. Mailer Error: ".$mail->ErrorInfo."</span>";
            }
            //Closing smtp connection
            $mail->smtpClose();  
    }

}
}




?>