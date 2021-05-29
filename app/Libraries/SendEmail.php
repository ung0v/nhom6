<?php
class SendEmail
{
    public function send($toEmail)
    {
        $email = \Config\Services::email();
        $message = 'Hệ thống vừa ghi nhận bạn đăng nhập vào lúc: ' . date("d-m-Y H:i:s");
        $email->setTo($toEmail);
        $email->setFrom('unimanagement0411@gmail.com', 'Hệ thống quản lý trường học');

        $email->setSubject("Thông tin đăng nhập");
        $email->setMessage($message);
        $email->send();
        // $data = $email->printDebugger(['headers']);
        // echo $data;
    }
}
