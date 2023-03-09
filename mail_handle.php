<!doctype html>
<html lang="en">
  <head>
    <title>Thank You</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <div class="container-fluid">
    <div class="row">
        <div class="card-columns">
            <div class="card">
                <div class="card-body">
                    
                

  <?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['mobile'],FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    require 'class.phpmailer.php';
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'server149.web-hosting.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'mailer@bookmetrocabs.com';                     // SMTP username
        $mail->Password   = 'Alpha1not2$$';                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('weblead@bookmetrocabs.com', 'Book Metro Cabs');
        $mail->addAddress('info@bookmetrocabs.com', 'Info Book Metro Cabs');     // Add a recipient
        $mail->addAddress('bookmetrocabs@gmail.com');               // Name is optional
        $mail->addReplyTo($email,$fullname);
        $mail->addCC('domainsdefault@gmail.com');
    
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'We Got a Web Enquiry From '.$fullname;
        $mail->Body    = '<html>
                            <head>
                            <title>Metro Cabs Enquiry</title>
                            </head>
                            <body>
                            <p>We have got a enquiry</p>
                            <table>
                            <tr>
                            <th>Description</th>
                            <th>Details</th>
                            </tr>
                            <tr><td>Full Name</td><td>'.$fullname.'</td></tr>
                            <tr><td>Email</td><td>'.$email.'</td></tr>
                            <tr><td>Phone</td><td>'.$phone.'</td></tr>
                            </table>
                            </body>
                            </html>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo '<span class="btn btn-sccess">Message has been sent</span>';
        
    } catch (Exception $e) {
        $mail->ErrorInfo;
        echo '<span class="btn btn-danger">Unable to Send Message</span>';
}
}
?>

</div>
            </div>
        </div>
    </div>
  </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>



<?php
/*    
    if(isset($_POST['submit']))
    {
        $fullname = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['mobile'],FILTER_SANITIZE_NUMBER_INT);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $type = filter_var($_POST['car-select'],FILTER_SANITIZE_STRING);
        $picklocation = filter_var($_POST['pick-up-location'],FILTER_SANITIZE_STRING);
        $droplocation = filter_var($_POST['drop-off-location'],FILTER_SANITIZE_STRING);
        $pickdate = filter_var($_POST['pick-up-date'],FILTER_SANITIZE_STRING);
        $picktime = filter_var($_POST['pick-up-time'],FILTER_SANITIZE_STRING);
        require 'class.phpmailer.php';
    // Instantiation and passing `true` enables exceptions
            
            
            
            
            try{
                //$mobileNumber = "919090343406,919090343406,919090343406";
            $mobileNumber = '917447344789';
            $senderId = "VPHONY";
            $message = urlencode("Oneway Enquiry, Name ".$fullname." , Phone ".$phone." , Email ".$email);
            $route = 4;
            
            //Prepare you post parameters
            $postData = array(
                'mobiles' => $mobileNumber,
                'message' => $message,
                'sender' => $senderId,
                'route' => $route
            );
            
            $url="http://api.msg91.com/api/v2/sendsms";
            
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array(
                    "authkey: 348875AccodXwV1d5fcf1882P1",
                    "content-type: multipart/form-data"
                ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            
            echo '<h1 style="color:green">Message Sent</h1>';
            
            }
            
            catch (Exception $e) {
            $mail->ErrorInfo;
            echo '<h1 style="color:red">Unable to Send Message</h1>';
            }
            
            
       
            
        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'server149.web-hosting.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'mailer@bookmetrocabs.com';                     // SMTP username
            $mail->Password   = 'Alpha1not2$$';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('weblead@bookmetrocabs.com', 'Metro Cabs');
            $mail->addAddress('onewaymetrocab@gmail.com', 'Oneway Enquiry');  
            $mail->addAddress('bookmetrocabs@gmail.com', 'Oneway Enquiry');// Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($email,$fullname);
            $mail->addBCC('bookmetrocabs@gmail.com');
            $mail->addBCC('domainsdefault@gmail.com');
        
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'We Got a Web Enquiry From '.$fullname;
            $mail->Body    = '<html>
                                <head>
                                <title>Metro Cabs Enquiry</title>
                                <style>
            table {
              width:100%;
              background-color:black;
            }
            table, th, td {
              border: 1px solid green;
              border-collapse: collapse;
            }
            th, td {
              padding: 15px;
              text-align: left;
            }
            tr:nth-child(even) {
              background-color: #eee;
            }
            tr:nth-child(odd) {
             background-color: #fff;
            }
            th {
              background-color: black;
              color: white;
            }
            </style>
                                </head>
                                <body>
                                <p>We have got a enquiry</p>
                                <table>
                                <tr>
                                <th>Description</th>
                                <th>Details</th>
                                </tr>
                                <tr><td>Full Name</td><td>'.$fullname.'</td></tr>
                                <tr><td>Email</td><td>'.$email.'</td></tr>
                                <tr><td>Phone</td><td>'.$phone.'</td></tr>
                                <tr><td>Enquiry Type</td><td>'.$type.'</td></tr>
                                <tr><td>Pickup Location</td><td>'.$picklocation.'</td></tr>
                                <tr><td>Drop Location</td><td>'.$droplocation.'</td></tr>
                                <tr><td>Date</td><td>'.$pickdate.'</td></tr>
                                <tr><td>Time</td><td>'.$picktime.'</td></tr>
                                
                                </table>
                                </body>
                                </html>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            
            echo '<div class="alert alert-success" id="car-select-form-msg">Your Booking has been received</div>';
            
        } catch (Exception $e) {
            $mail->ErrorInfo;
            echo '<div class="alert alert-danger" id="car-select-form-msg">Error in Booking</div>';
        }
        
        
        
    }
*/

?>