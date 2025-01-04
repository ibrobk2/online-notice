<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	</head>
	<body>
<?php 
// extract($_POST);
// if(isset($add))
// {

// 	if($details=="" || $sub=="" || $user=="")
// 	{
// 	$err="<font color='red'>fill all the fileds first</font>";	
// 	}
// 	else
// 	{
// 		foreach($user as $v)
// 		{
// mysqli_query($conn,"insert into notice values('','$v','$sub','$details',now())");
// 		}
		
// 		$err="<font color='green'>Notice added Successfully</font>";	
// 	}
// }


require './phpMailer/PHPMailer.php';
require './phpMailer/SMTP.php';
require './phpMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';

extract($_POST);
if(isset($add))
{
    if($details=="" || $sub=="" || $user=="")
    {
        $err="<font color='red'>fill all the fields first</font>";    
    }
    else
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;
            $mail->Username   = 'umargarbasani60@gmail.com';  // SMTP username
            $mail->Password   = 'apkzrrrhftoayscv';           // SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = '465';

            //Sender
            $mail->setFrom('umargarbasani60@gmail.com', 'Notice Board Notification');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $sub;
            $mail->Body    = $details;

            foreach($user as $v)
            {
                mysqli_query($conn, "insert into notice values('', '$v', '$sub', '$details', now())");
                $mail->addAddress($v);  // Add a recipient
                $mail->send();
                $mail->clearAddresses();
            }
            
            $err="<font color='green'>Notice added and emailed Successfully</font>";    
        } catch (Exception $e) {
            $err = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


?>
<div class="header">
	<h2>Add New Notice</h2>
	<form id="searchForm">
        <input type="text" id="searchInput" placeholder="Enter user name or email">
        <button type="submit">Search</button>
    </form>
    <div id="results"></div>
</div>
<hr>
<form method="post">
	
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>
	
	
	
	<div class="row">
		<div class="col-sm-4">Enter Subject</div>
		<div class="col-sm-5">
		<input type="text" name="sub" class="form-control"/></div>
	</div>
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
	</div>	
	
	<div class="row">
		<div class="col-sm-4">Enter Details</div>
		<div class="col-sm-5">
		<textarea name="details" class="form-control"></textarea></div>
	</div>
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
	</div>	
	
	<div class="row">
		<div class="col-sm-4">Select User</div>
		<div class="col-sm-5">
		<select name="user[]" multiple="multiple" class="form-control" id="userDropdown">
			<?php 
	$sql=mysqli_query($conn,"select name,email from user");
	while($r=mysqli_fetch_array($sql))
	{
		echo "<option value='".$r['email']."'>".$r['name']."</option>";
	}
			?>
		</select>
		</div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
	</div>	
		
		<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-4">
		<input type="submit" value="Add New Notice" name="add" class="btn btn-success"/>
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
</form>	
<script src="search.js"></script>