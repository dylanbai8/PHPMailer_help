<?php

/* =======================

https://github.com/PHPMailer/PHPMailer

1.宝塔PHP禁用函数中删除以下两个

putenv
proc_open

2.新建空目录 root执行:

composer require phpmailer/phpmailer

========================= */

// file_get_contents("https://xxx.xxx.com/mailapi.php?p=okduang&e=65198170@qq.com&f=通知&t=订单通知&n=<p>哈哈<br>哈</p>");

$get_tile = $_GET["t"];
$get_note = $_GET["n"];
$to_email = $_GET["e"];

$mailhost = 'smtp.exmail.qq.com';
$fromname = $_GET["f"];
$username = 'xxx@xxx.com';
$password = 'JtU76oyxYREWrvy';

$pass_set = 'okduang';
$pass_get = $_GET["p"];
if ($pass_get != $pass_set) {echo "<p>禁止访问！</p>"; die;}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = $mailhost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $username;
    $mail->Password   = $password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($username, $fromname);
    $mail->addAddress($to_email);

    $mail->isHTML(true);
    $mail->Subject = $get_tile;
    $mail->Body    = $get_note;

    $mail->send();
    echo '通知成功!';
} catch (Exception $e) {
    echo "发送失败! 错误代码: {$mail->ErrorInfo}";
}

?>
