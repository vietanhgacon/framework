<?php
/*
 * Cập nhật: 12/04/2017 - 10:16 AM - Anhhv
 * Chứa các hàm hỗ trợ trong quá trình chạy chương trình
 */
namespace framework\libs;

class Helper
{

    public function csrf_token()
    {
        $token = md5(uniqid(mt_rand(), true));

        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    public function setFlash($name, $message = '')
    {
        if (!empty($name)) {
            if (!empty($message)) {
                if (isset($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }
                $_SESSION[$name] = $message;
            }
        }
    }

    public function getFlash($name)
    {
        if (isset($_SESSION[$name])) {
            $message = $_SESSION[$name];

            unset($_SESSION[$name]);

            return $message;
        } else {
            return false;
        }
    }


}