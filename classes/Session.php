<?php
 
// Lớp session
class Session {
    // Hàm bắt đầu session
    public function start()
    {
        session_start();
    }
 
    // Hàm lưu session 
    public function set($name, $val)
    {
        $_SESSION[$name] = $val;
    }
 
    // Hàm lấy dữ liệu session
    public function get($name) 
    {
        if (isset($_SESSION[$name]))
        {
            $user = $_SESSION[$name];
        }
        else
        {
            $user = '';
        }
        return $user;
    }
 
    // Hàm xoá session
    public function destroy() 
    {
        session_destroy();
    }
}
 
?>