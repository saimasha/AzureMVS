<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);// include_once("include/header.php");
require_once("include/connection.php");
// Create connection 
//('phpmailer/PHPMailerAutoload.php');
require('vendor/autoload.php');
require('phpmailer/PHPMailerAutoload.php');
require('phpmailer/class.phpmailer.php');
require('phpmailer/class.smtp.php');

// include "../verifyEmail.php";
date_default_timezone_set("Asia/Kolkata");
// session_start();
// $userid = $_SESSION["aasp_id"];
// session_start();

// $userid = $_SESSION['ausu_id'];


// for activation link email after register

function sendEmail($conn, $templateId, $receiverEmail)
{

    $selectMail = "SELECT * FROM tbEmalTemplateUser WHERE fdTemplateID = '" . $templateId . "' ";
    $resMail = mysqli_query($conn, $selectMail);
    if (mysqli_num_rows($resMail) > 0) {
        while ($rowMail = mysqli_fetch_assoc($resMail)) {
             $emailSender = $rowMail['fdEmailSender'];
        }
    }

    $selectConfiguration = "SELECT * FROM tbEmailConfiguration WHERE fdfromEmailId = '$emailSender' ";
    $resConfig = mysqli_query($conn, $selectConfiguration);
    if (mysqli_num_rows($resConfig) > 0) {
        while ($rowConfig = mysqli_fetch_assoc($resConfig)) {
             $fdfromEmailId = $rowConfig['fdfromEmailId'];
             $fdEmailPassword = $rowConfig['fdEmailPassword'];
             $fdOutgoingServer = $rowConfig['fdOutgoingServer'];
             $fdOutgoingPort = $rowConfig['fdOutgoingPort'];
             $fdEmailPurpose = $rowConfig['fdEmailPurpose'];
             $fdEmailSenderName = $rowConfig['fdEmailSenderName'];
        }
    }

    $selectTemplate = "SELECT * FROM tbEmailsToSent WHERE fdEmailTemplateID = '" . $templateId . "'  ";
    $resTemplate = mysqli_query($conn, $selectTemplate);
    if (mysqli_num_rows($resTemplate) > 0) {
        while ($row = mysqli_fetch_assoc($resTemplate)) {
             $tempId = $row['fdEmailTemplateID'];
             $emailSender = $row['fdfromEmailId'];
             $fdSubject = $row['fdSubject'];
             $fdGreetings = $row['fdGreetings'];
             $fdFixedMsgContent = $row['fdFixedMsgContent'];
             $fdSignatureLine1 = $row['fdSignatureLine1'];
             $fdSignatureLine2 = $row['fdSignatureLine2'];
             $fdSignatureLine3 = $row['fdSignatureLine3'];
             $fdSignatureLine4 = $row['fdSignatureLine4'];
             $fdEmailTemplatePurpose = $row['fdEmailTemplatePurpose'];
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = TRUE;
            $mail->SMTPDebug = FALSE;
            $mail->Host = $fdOutgoingServer;
            $mail->Port = $fdOutgoingPort;
            $mail->SMTPSecure = 'tls';
            $mail->Username = $fdfromEmailId;
            $mail->Password = $fdEmailPassword;
            $mail->setFrom($fdfromEmailId, 'MVS'); // fixed
            $mail->addAddress($receiverEmail); // enter whome to send
            $mail->isHTML(true);
            $mail->Subject = $fdSubject ;
            // $activationLink = 'https://example.com/';
            $activationLink = "https://schedarcloud.com/medicineverifications_new/active.php?email=$receiverEmail";
            $activationLink;
            $fdFixedMsgContent;
            //$mail->Subject =$fdSubject;
        //  $mail->Body = $fdFixedMsgContent. " Click the following link to activate your account : " . "<a href='active.php'>$activationLink</a>";
        //    $mail->Body = $fdFixedMsgContent . " Click the following link to activate your account: " . $activationLink ;     
           $mail->Body = '
           <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
               <tbody>
                   <tr>
                       <td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
                               <tbody>
                                   <tr>
                                       <td align="center" valign="top">
                                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                                               <tbody>
                                                   <tr>
                                                       <td style="background-color:#1e88e5;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
                                                           <a href="#" style="text-decoration:none" target="_blank">
                                                               <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/hero-img/blue/heroGradient/user-account.png" style="width:60%;max-width:200px;height:auto;display:block;color: #f9f9f9;" width="600">
                                                           </a>
                                                       </td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
                                                           <h2 class="text" style="color:#1e88e5;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Hi User</h2>
                                                       </td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
                                                           <h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0">Verify Your Account</h4>
                                                       </td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
                                                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
                                                               <tbody>
                                                                   <tr>
                                                                       <td style="padding-bottom: 20px;" align="center" valign="top" class="description">
                                                                           <p class="text" style="color:#666;font-family: Open Sans,Helvetica,Arial,sans-serif; font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                           '.$fdFixedMsgContent.'Please click the Activate button to activate your account.</p>
                                                                       </td>
                                                                   </tr>
                                                               </tbody>
                                                           </table>
                                                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
                                                               <tbody>
                                                                   <tr>
                                                                       <td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
                                                                           <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                                               <tbody>
                                                                                   <tr>
                                                                                       <td style="background-color: #1e88e5; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> 
                                                 <a href="'.$activationLink.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Activate Account</a>
                                                                                       </td>
                                                                                   </tr>
                                                                               </tbody>
                                                                           </table>
                                                                       </td>
                                                                   </tr>
                                                               </tbody>
                                                           </table>
                                                       </td>
                                                   </tr>
                                   </tbody>
                               </table>
                           </td>
                       </tr>
                   </tbody>
               </table>
           ';
           
            // $mail->send();            
            if (!$mail->send()) {
              error_log("Error while sending Email: " . $mail->ErrorInfo);
              var_dump($mail);
            } else {
                echo "";
            }

        }
    }
}
 
// for apporval email

function sendEmail1($conn, $templateId, $receiverEmail)
{
  $selectMail = "SELECT * FROM tbEmalTemplateUser WHERE fdTemplateID = '" . $templateId . "' ";
    $resMail = mysqli_query($conn, $selectMail);
    if (mysqli_num_rows($resMail) > 0) {
        while ($rowMail = mysqli_fetch_assoc($resMail)) {
             $emailSender = $rowMail['fdEmailSender'];
        }
    }

    $selectConfiguration = "SELECT * FROM tbEmailConfiguration WHERE fdfromEmailId = '$emailSender' ";
    $resConfig = mysqli_query($conn, $selectConfiguration);
    if (mysqli_num_rows($resConfig) > 0) {
        while ($rowConfig = mysqli_fetch_assoc($resConfig)) {
             $fdfromEmailId = $rowConfig['fdfromEmailId'];
             $fdEmailPassword = $rowConfig['fdEmailPassword'];
             $fdOutgoingServer = $rowConfig['fdOutgoingServer'];
             $fdOutgoingPort = $rowConfig['fdOutgoingPort'];
             $fdEmailPurpose = $rowConfig['fdEmailPurpose'];
             $fdEmailSenderName = $rowConfig['fdEmailSenderName'];
        }
    }

    $selectTemplate = "SELECT * FROM tbEmailsToSent WHERE fdEmailTemplateID = '" . $templateId . "'  ";
    $resTemplate = mysqli_query($conn, $selectTemplate);
    if (mysqli_num_rows($resTemplate) > 0) {
        while ($row = mysqli_fetch_assoc($resTemplate)) {
             $tempId = $row['fdEmailTemplateID'];
             $emailSender = $row['fdfromEmailId'];
             $fdSubject = $row['fdSubject'];
             $fdGreetings = $row['fdGreetings'];
             $fdFixedMsgContent = $row['fdFixedMsgContent'];
             $fdSignatureLine1 = $row['fdSignatureLine1'];
             $fdSignatureLine2 = $row['fdSignatureLine2'];
             $fdSignatureLine3 = $row['fdSignatureLine3'];
             $fdSignatureLine4 = $row['fdSignatureLine4'];
             $fdEmailTemplatePurpose = $row['fdEmailTemplatePurpose'];
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = TRUE;
            $mail->SMTPDebug = FALSE;
            $mail->Host = $fdOutgoingServer;
            $mail->Port = $fdOutgoingPort;
            $mail->SMTPSecure = 'tls';
            $mail->Username = $fdfromEmailId;
            $mail->Password = $fdEmailPassword;
            $mail->setFrom($fdfromEmailId, 'MVS'); // fixed
            $mail->addAddress($receiverEmail); // enter whome to send
            $mail->isHTML(true);
            $mail->Subject = $fdSubject ;
            $activationLink = "https://schedarcloud.com/medicineverifications_new/active.php?email=$receiverEmail";
            $activationLink;
        // $mail->Body = $fdFixedMsgContent ;
            // $mail->send();
            $mail->Body = '
<!DOCTYPE html>
<html>
<head>
  <title>Email Template</title>
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
  <style>
    /* Your CSS styles here */
    * {
      box-sizing: border-box;
    }

    body {
      background:#e5e5e5;
      background: linear-gradient(to bottom, #e5e5e5 0%, #e1e8ed 100%);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#e5e5e5", endColorstr="#e1e8ed", GradientType=0);
      height: 100%;
      margin: 0;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
    .content {
        display:flex;
        flex-direction: row;
        justify-content: center;
        background-color: #f9f9f9;
        color: #fff;
      
    }
    .wrapper-2 {
      padding: 30px;
      text-align: center;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .wrapper-2 p {
      margin: 0;
      font-size: 1.3em;
      color: #aaa;
      font-family: "Source Sans Pro", sans-serif;
      letter-spacing: 1px;
    }

    .go-home {
      color: #fff;
      background: #5892ff;
      border: none;
      padding: 10px 50px;
      margin: 30px 0;
      border-radius: 30px;
      text-transform: capitalize;
      box-shadow: 0 10px 16px 1px rgba(174, 199, 251, 1);
    }

    .footer-like {
      margin-top: auto;
      background: #d7e6fe;
      padding: 6px;
      text-align: center;
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
    }

    .footer-like p {
      margin: 0;
      padding: 4px;
      color: #5892ff;
      font-family: "Source Sans Pro", sans-serif;
      letter-spacing: 1px;
    }

    .footer-like p a {
      text-decoration: none;
      color: #5892ff;
      font-weight: 600;
    }
  </style>
</head>
<body>
<div class="content">
  <div class="wrapper-2">
    <p>' . $fdFixedMsgContent . '</p>
    <p>You can now login.</p>
    <a href="https://schedarcloud.com/medicineverifications_new/login.php" class="go-home" style="display: inline-block; padding: 10px 20px; background-color: #5892ff; color: #fff; text-decoration: none; border-radius: 5px;">
    Login
  </a>
  </div>
</div>
</body>
</html>
';                               
            if (!$mail->send()) {
              error_log("Error while sending Email: " . $mail->ErrorInfo);
              var_dump($mail);
            } else {
                echo "";
            }

        }
    }
}


// for forgot password email

function generateResetToken()
{
    return bin2hex(random_bytes(32)); // Adjust the length of the token as needed
}

function sendEmailforgot($conn, $templateId, $receiverEmail, $RoleID)
{
    $selectMail = "SELECT * FROM tbEmalTemplateUser WHERE fdTemplateID = '" . $templateId . "' ";
    $resMail = mysqli_query($conn, $selectMail);
    
    if (mysqli_num_rows($resMail) > 0) {
        while ($rowMail = mysqli_fetch_assoc($resMail)) {
             $emailSender = $rowMail['fdEmailSender'];
        }
    }

    $selectConfiguration = "SELECT * FROM tbEmailConfiguration WHERE fdfromEmailId = '$emailSender' ";
    $resConfig = mysqli_query($conn, $selectConfiguration);
    
    if (mysqli_num_rows($resConfig) > 0) {
        while ($rowConfig = mysqli_fetch_assoc($resConfig)) {
             $fdfromEmailId = $rowConfig['fdfromEmailId'];
             $fdEmailPassword = $rowConfig['fdEmailPassword'];
             $fdOutgoingServer = $rowConfig['fdOutgoingServer'];
             $fdOutgoingPort = $rowConfig['fdOutgoingPort'];
             $fdEmailPurpose = $rowConfig['fdEmailPurpose'];
             $fdEmailSenderName = $rowConfig['fdEmailSenderName'];
        }
    }

    $selectTemplate = "SELECT * FROM tbEmailsToSent WHERE fdEmailTemplateID = '" . $templateId . "'  ";
    $resTemplate = mysqli_query($conn, $selectTemplate);
    
    if (mysqli_num_rows($resTemplate) > 0) {
        while ($row = mysqli_fetch_assoc($resTemplate)) {
             $tempId = $row['fdEmailTemplateID'];
             $emailSender = $row['fdfromEmailId'];
             $fdSubject = $row['fdSubject'];
             $fdGreetings = $row['fdGreetings'];
             $fdFixedMsgContent = $row['fdFixedMsgContent'];
             $fdSignatureLine1 = $row['fdSignatureLine1'];
             $fdSignatureLine2 = $row['fdSignatureLine2'];
             $fdSignatureLine3 = $row['fdSignatureLine3'];
             $fdSignatureLine4 = $row['fdSignatureLine4'];
             $fdEmailTemplatePurpose = $row['fdEmailTemplatePurpose'];
             
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = TRUE;
            $mail->SMTPDebug = FALSE;
            $mail->Host = $fdOutgoingServer;
            $mail->Port = $fdOutgoingPort;
            $mail->SMTPSecure = 'tls';
            $mail->Username = $fdfromEmailId;
            $mail->Password = $fdEmailPassword;
            $mail->setFrom($fdfromEmailId, 'MVS');
            $mail->addAddress($receiverEmail);
            $mail->isHTML(true);
            $mail->Subject = $fdSubject;
            
            // Generate reset token and construct activation link
            $resetToken = generateResetToken();
            $activationLink = "https://schedarcloud.com/medicineverifications_new/forgetPassword.php?email=$receiverEmail&reset_token=$resetToken&RoleID=$RoleID";
            
            // Email body using HTML format
            $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
                    <style type="text/css">
                        @media only screen and (max-width: 550px){
                            .responsive_at_550{
                                width: 90% !important;
                                max-width: 90% !important;
                            }
                        }
                    </style>
                </head>
                <body>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">        
                        <tbody>
                            <tr>
                                <td align="center" bgcolor="#e5e5e5">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td width="100%" align="center">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="40">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="padding-left:20px; padding-right:20px;" class="responsive_at_550">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" bgcolor="#fff">
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="100%" height="7" align="center" border="0" bgcolor="#03a9f4"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td height="30">&nbsp;</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="100%" align="center">
                                                                                    <h1 style="font-family:Ubuntu Mono, monospace; font-size:20px; color:#202020; font-weight:bold; padding-left:20px; padding-right:20px;">Reset your password</h1>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="100%" align="center">
                                                                                    <p style="font-family:Ubuntu, sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">You received this E-mail in response to your request to reset your password.</p>
                                                                                    <p style="font-family:Ubuntu, sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">Click the button below to reset your password, the reset password link is only valid for 1 hour.</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td height="30">&nbsp;</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" bgcolor="#1976D2">
                                                                                    <a style="font-family:Ubuntu Mono, monospace; display:block; color:#ffffff; font-size:14px; font-weight:bold; text-decoration:none; padding-left:20px; padding-right:20px; padding-top:20px; padding-bottom:20px;" href="'.$activationLink.'">Reset Password</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td height="30">&nbsp;</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="40">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>
                </html>
            ';
            
            // Send email
            if (!$mail->send()) {
                error_log("Error while sending Email: " . $mail->ErrorInfo);
                var_dump($mail);
            } else {
                echo "";
            }
        }
    }
}

// For Customer  forgot passowrd Email

function sendEmailforgot1($conn, $templateId, $receiverEmail)
{

    $selectMail = "SELECT * FROM tbEmalTemplateUser WHERE fdTemplateID = '" . $templateId . "' ";
    $resMail = mysqli_query($conn, $selectMail);
    if (mysqli_num_rows($resMail) > 0) {
        while ($rowMail = mysqli_fetch_assoc($resMail)) {
             $emailSender = $rowMail['fdEmailSender'];
        }
    }

    $selectConfiguration = "SELECT * FROM tbEmailConfiguration WHERE fdfromEmailId = '$emailSender' ";
    $resConfig = mysqli_query($conn, $selectConfiguration);
    if (mysqli_num_rows($resConfig) > 0) {
        while ($rowConfig = mysqli_fetch_assoc($resConfig)) {
             $fdfromEmailId = $rowConfig['fdfromEmailId'];
             $fdEmailPassword = $rowConfig['fdEmailPassword'];
             $fdOutgoingServer = $rowConfig['fdOutgoingServer'];
             $fdOutgoingPort = $rowConfig['fdOutgoingPort'];
             $fdEmailPurpose = $rowConfig['fdEmailPurpose'];
             $fdEmailSenderName = $rowConfig['fdEmailSenderName'];
        }
    }

    $selectTemplate = "SELECT * FROM tbEmailsToSent WHERE fdEmailTemplateID = '" . $templateId . "'  ";
    $resTemplate = mysqli_query($conn, $selectTemplate);
    if (mysqli_num_rows($resTemplate) > 0) {
        while ($row = mysqli_fetch_assoc($resTemplate)) {
             $tempId = $row['fdEmailTemplateID'];
             $emailSender = $row['fdfromEmailId'];
             $fdSubject = $row['fdSubject'];
             $fdGreetings = $row['fdGreetings'];
             $fdFixedMsgContent = $row['fdFixedMsgContent'];
             $fdSignatureLine1 = $row['fdSignatureLine1'];
             $fdSignatureLine2 = $row['fdSignatureLine2'];
             $fdSignatureLine3 = $row['fdSignatureLine3'];
             $fdSignatureLine4 = $row['fdSignatureLine4'];
             $fdEmailTemplatePurpose = $row['fdEmailTemplatePurpose'];
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = TRUE;
            $mail->SMTPDebug = FALSE;
            $mail->Host = $fdOutgoingServer;
            $mail->Port = $fdOutgoingPort;
            $mail->SMTPSecure = 'tls';
            $mail->Username = $fdfromEmailId;
            $mail->Password = $fdEmailPassword;
            $mail->setFrom($fdfromEmailId, 'MVS'); // fixed
            $mail->addAddress($receiverEmail); // enter whome to send
            $mail->isHTML(true);
            $mail->Subject = $fdSubject ;
            $resetToken = generateResetToken();
            // $activationLink = 'https://example.com/';
            $activationLink = "https://schedarcloud.com/medicineverifications_new/Customer_forgetPass.php?email=$receiverEmail&reset_token=$resetToken";
            //$mail->Subject =$fdSubject;
            // $mail->Body = $fdFixedMsgContent. " Click the following link to activate your account : " . "<a href='active.php'>$activationLink</a>";
            // $mail->Body = $fdFixedMsgContent . ":" . $activationLink ;
            // $mail->send();
            $mail->Body = '
            <!DOCTYPE html>
            <html> 
     <head>
    <!-- CHARSET -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <!-- MOBILE FIRST -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    
    <!-- RESPONSIVE CSS -->
    <style type="text/css">
        @media only screen and (max-width: 550px){
            .responsive_at_550{
                width: 90% !important;
                max-width: 90% !important;
            }
        }
    </style>

</head>
<!-- END HEAD -->

<!-- START BODY -->
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    
    <!-- START EMAIL CONTENT -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">        
        <tbody>
            
            <tr>
                
                <td align="center" bgcolor="#e5e5e5">
                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tbody>
                            <tr>
                                <td width="100%" align="center">
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                   
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                    <!-- START CONTENT -->
                                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="padding-left:20px; padding-right:20px;" class="responsive_at_550">
                                        <tbody>
                                            <tr>
                                                <td align="center" bgcolor="#fff">
                                                    
                                                    <!-- START BORDER COLOR -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" height="7" align="center" border="0" bgcolor="#03a9f4"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END BORDER COLOR -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END SPACING -->
                                                    
                                                    <!-- START HEADING -->
                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" align="center">
                                                                    <h1 style="font-family:Ubuntu Mono, monospace; font-size:20px; color:#202020; font-weight:bold; padding-left:20px; padding-right:20px;">Reset your password</h1>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END HEADING -->
                                                    
                                                    <!-- START PARAGRAPH -->
                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" align="center">
                                                                    <p style="font-family:Ubuntu, sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">You received this E-mail in response to your request to reset your password.</p>
                                                                    <p style="font-family:Ubuntu, sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">Click the button below to reset your password, the reset password link is only valid for 1 hour.</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END PARAGRAPH -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END SPACING -->
                                                    
                                                    <!-- START BUTTON -->
                                                    <table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" bgcolor="#1976D2">
                                                                    <a style="font-family:Ubuntu Mono, monospace; display:block; color:#ffffff; font-size:14px; font-weight:bold; text-decoration:none; padding-left:20px; padding-right:20px; padding-top:20px; padding-bottom:20px;" href="'.$activationLink.'">Reset Password</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END BUTTON -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                                         <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        
                                                    </table>
                                                                             <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                   
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </body>';

            if (!$mail->send()) {
              error_log("Error while sending Email: " . $mail->ErrorInfo);
              var_dump($mail);
            } else {
                echo "";
            }

        }
    }
}


// for customer register email approval

function CustomerEmail($conn, $templateId, $receiverEmail)
{

    $selectMail = "SELECT * FROM tbEmalTemplateUser WHERE fdTemplateID = '" . $templateId . "' ";
    $resMail = mysqli_query($conn, $selectMail);
    if (mysqli_num_rows($resMail) > 0) {
        while ($rowMail = mysqli_fetch_assoc($resMail)) {
             $emailSender = $rowMail['fdEmailSender'];
        }
    }

    $selectConfiguration = "SELECT * FROM tbEmailConfiguration WHERE fdfromEmailId = '$emailSender' ";
    $resConfig = mysqli_query($conn, $selectConfiguration);
    if (mysqli_num_rows($resConfig) > 0) {
        while ($rowConfig = mysqli_fetch_assoc($resConfig)) {
             $fdfromEmailId = $rowConfig['fdfromEmailId'];
             $fdEmailPassword = $rowConfig['fdEmailPassword'];
             $fdOutgoingServer = $rowConfig['fdOutgoingServer'];
             $fdOutgoingPort = $rowConfig['fdOutgoingPort'];
             $fdEmailPurpose = $rowConfig['fdEmailPurpose'];
             $fdEmailSenderName = $rowConfig['fdEmailSenderName'];
        }
    }

    $selectTemplate = "SELECT * FROM tbEmailsToSent WHERE fdEmailTemplateID = '" . $templateId . "'  ";
    $resTemplate = mysqli_query($conn, $selectTemplate);
    if (mysqli_num_rows($resTemplate) > 0) {
        while ($row = mysqli_fetch_assoc($resTemplate)) {
             $tempId = $row['fdEmailTemplateID'];
             $emailSender = $row['fdfromEmailId'];
             $fdSubject = $row['fdSubject'];
             $fdGreetings = $row['fdGreetings'];
             $fdFixedMsgContent = $row['fdFixedMsgContent'];
             $fdSignatureLine1 = $row['fdSignatureLine1'];
             $fdSignatureLine2 = $row['fdSignatureLine2'];
             $fdSignatureLine3 = $row['fdSignatureLine3'];
             $fdSignatureLine4 = $row['fdSignatureLine4'];
             $fdEmailTemplatePurpose = $row['fdEmailTemplatePurpose'];
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = TRUE;
            $mail->SMTPDebug = FALSE;
            $mail->Host = $fdOutgoingServer;
            $mail->Port = $fdOutgoingPort;
            $mail->SMTPSecure = 'tls';
            $mail->Username = $fdfromEmailId;
            $mail->Password = $fdEmailPassword;
            $mail->setFrom($fdfromEmailId, 'MVS'); // fixed
            $mail->addAddress($receiverEmail); // enter whome to send
            $mail->isHTML(true);
            $mail->Subject = $fdSubject ;
            // $activationLink = 'https://example.com/';
            $activationLink = "https://schedarcloud.com/medicineverifications_new/activeCustom.php?email=$receiverEmail";
            $activationLink;
            $fdFixedMsgContent;
            //$mail->Subject =$fdSubject;
        //  $mail->Body = $fdFixedMsgContent. " Click the following link to activate your account : " . "<a href='active.php'>$activationLink</a>";
        //    $mail->Body = $fdFixedMsgContent . " Click the following link to activate your account: " . $activationLink ;     
           $mail->Body = '
           <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
               <tbody>
                   <tr>
                       <td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
                               <tbody>
                                   <tr>
                                       <td align="center" valign="top">
                                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                                               <tbody>
                                                   <tr>
                                                       <td style="background-color:#1e88e5;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-bottom: 20px;" align="center" valign="top" class="imgHero">
                                                           <a href="#" style="text-decoration:none" target="_blank">
                                                               <img alt="" border="0" src="http://email.aumfusion.com/vespro/img/hero-img/blue/heroGradient/user-account.png" style="width:60%;max-width:200px;height:auto;display:block;color: #f9f9f9;" width="600">
                                                           </a>
                                                       </td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
                                                           <h2 class="text" style="color:#1e88e5;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Hi User</h2>
                                                       </td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
                                                           <h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0">Verify Your Account</h4>
                                                       </td>
                                                   </tr>
                                                   <tr>
                                                       <td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
                                                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
                                                               <tbody>
                                                                   <tr>
                                                                       <td style="padding-bottom: 20px;" align="center" valign="top" class="description">
                                                                           <p class="text" style="color:#666;font-family: Open Sans,Helvetica,Arial,sans-serif; font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                           '.$fdFixedMsgContent.'Please click the Activate button to activate your account.</p>
                                                                       </td>
                                                                   </tr>
                                                               </tbody>
                                                           </table>
                                                           <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableButton" style="">
                                                               <tbody>
                                                                   <tr>
                                                                       <td style="padding-top:20px;padding-bottom:20px" align="center" valign="top">
                                                                           <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                                               <tbody>
                                                                                   <tr>
                                                                                       <td style="background-color: #1e88e5; padding: 12px 35px; border-radius: 50px;" align="center" class="ctaButton"> 
                                                 <a href="'.$activationLink.'" style="color:#fff;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:13px;font-weight:600;font-style:normal;line-height:20px;text-transform:uppercase;text-decoration:none;display:block" target="_blank" class="text">Activate Account</a>
                                                                                       </td>
                                                                                   </tr>
                                                                               </tbody>
                                                                           </table>
                                                                       </td>
                                                                   </tr>
                                                               </tbody>
                                                           </table>
                                                       </td>
                                                   </tr>
                                   </tbody>
                               </table>
                           </td>
                       </tr>
                   </tbody>
               </table>
           ';

            if (!$mail->send()) {
              error_log("Error while sending Email: " . $mail->ErrorInfo);
              var_dump($mail);
            } else {
                echo "";
            }

        }
    }
}


// for profile change password email

function sendResetMail($conn, $templateId, $receiverEmail,$roleid)
{

    $selectMail = "SELECT * FROM tbEmalTemplateUser WHERE fdTemplateID = '" . $templateId . "' ";
    $resMail = mysqli_query($conn, $selectMail);
    if (mysqli_num_rows($resMail) > 0) {
        while ($rowMail = mysqli_fetch_assoc($resMail)) {
             $emailSender = $rowMail['fdEmailSender'];
        }
    }

    $selectConfiguration = "SELECT * FROM tbEmailConfiguration WHERE fdfromEmailId = '$emailSender' ";
    $resConfig = mysqli_query($conn, $selectConfiguration);
    if (mysqli_num_rows($resConfig) > 0) {
        while ($rowConfig = mysqli_fetch_assoc($resConfig)) {
             $fdfromEmailId = $rowConfig['fdfromEmailId'];
             $fdEmailPassword = $rowConfig['fdEmailPassword'];
             $fdOutgoingServer = $rowConfig['fdOutgoingServer'];
             $fdOutgoingPort = $rowConfig['fdOutgoingPort'];
             $fdEmailPurpose = $rowConfig['fdEmailPurpose'];
             $fdEmailSenderName = $rowConfig['fdEmailSenderName'];
        }
    }

    $selectTemplate = "SELECT * FROM tbEmailsToSent WHERE fdEmailTemplateID = '" . $templateId . "'  ";
    $resTemplate = mysqli_query($conn, $selectTemplate);
    if (mysqli_num_rows($resTemplate) > 0) {
        while ($row = mysqli_fetch_assoc($resTemplate)) {
             $tempId = $row['fdEmailTemplateID'];
             $emailSender = $row['fdfromEmailId'];
             $fdSubject = $row['fdSubject'];
             $fdGreetings = $row['fdGreetings'];
             $fdFixedMsgContent = $row['fdFixedMsgContent'];
             $fdSignatureLine1 = $row['fdSignatureLine1'];
             $fdSignatureLine2 = $row['fdSignatureLine2'];
             $fdSignatureLine3 = $row['fdSignatureLine3'];
             $fdSignatureLine4 = $row['fdSignatureLine4'];
             $fdEmailTemplatePurpose = $row['fdEmailTemplatePurpose'];
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = TRUE;
            $mail->SMTPDebug = FALSE;
            $mail->Host = $fdOutgoingServer;
            $mail->Port = $fdOutgoingPort;
            $mail->SMTPSecure = 'tls';
            $mail->Username = $fdfromEmailId;
            $mail->Password = $fdEmailPassword;
            $mail->setFrom($fdfromEmailId, 'MVS'); // fixed
            $mail->addAddress($receiverEmail); // enter whome to send
            $mail->isHTML(true);
            $mail->Subject = $fdSubject ;
            $resetToken = generateResetToken();
            // $activationLink = 'https://example.com/';
            $activationLink = "https://schedarcloud.com/medicineverifications_new/Change_pass.php?email=$receiverEmail&roleid=$roleid&reset_token=$resetToken";
            //$mail->Subject =$fdSubject;
            // $mail->Body = $fdFixedMsgContent. " Click the following link to activate your account : " . "<a href='active.php'>$activationLink</a>";
            // $mail->Body = $fdFixedMsgContent . ":" . $activationLink ;
            // $mail->send();
            $mail->Body = '
            <!DOCTYPE html>
            <html> 
     <head>
    <!-- CHARSET -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <!-- MOBILE FIRST -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    
    <!-- RESPONSIVE CSS -->
    <style type="text/css">
        @media only screen and (max-width: 550px){
            .responsive_at_550{
                width: 90% !important;
                max-width: 90% !important;
            }
        }
    </style>

</head>
<!-- END HEAD -->

<!-- START BODY -->
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    
    <!-- START EMAIL CONTENT -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">        
        <tbody>
            
            <tr>
                
                <td align="center" bgcolor="#e5e5e5">
                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tbody>
                            <tr>
                                <td width="100%" align="center">
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                   
                                    
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END SPACING -->
                                    
                                    <!-- START CONTENT -->
                                    <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="padding-left:20px; padding-right:20px;" class="responsive_at_550">
                                        <tbody>
                                            <tr>
                                                <td align="center" bgcolor="#fff">
                                                    
                                                    <!-- START BORDER COLOR -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" height="7" align="center" border="0" bgcolor="#03a9f4"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END BORDER COLOR -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END SPACING -->
                                                    
                                                    <!-- START HEADING -->
                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" align="center">
                                                                    <h1 style="font-family:Ubuntu Mono, monospace; font-size:20px; color:#202020; font-weight:bold; padding-left:20px; padding-right:20px;">Reset your password</h1>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END HEADING -->
                                                    
                                                    <!-- START PARAGRAPH -->
                                                    <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td width="100%" align="center">
                                                                    <p style="font-family:Ubuntu, sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">You received this E-mail in response to your request to reset your password.</p>
                                                                    <p style="font-family:Ubuntu, sans-serif; font-size:14px; color:#202020; padding-left:20px; padding-right:20px; text-align:justify;">Click the button below to reset your password, the reset password link is only valid for 1 hour.</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END PARAGRAPH -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END SPACING -->
                                                    
                                                    <!-- START BUTTON -->
                                                    <table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" bgcolor="#1976D2">
                                                                    <a style="font-family:Ubuntu Mono, monospace; display:block; color:#ffffff; font-size:14px; font-weight:bold; text-decoration:none; padding-left:20px; padding-right:20px; padding-top:20px; padding-bottom:20px;" href="'.$activationLink.'">Reset Password</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- END BUTTON -->
                                                    
                                                    <!-- START SPACING -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                                         <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        
                                                    </table>
                                                                             <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                   
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- START SPACING -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td height="40">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </body>';
            
            if (!$mail->send()) {
              error_log("Error while sending Email: " . $mail->ErrorInfo);
              var_dump($mail);
            } else {
                echo "";
            }

 }
}
}

