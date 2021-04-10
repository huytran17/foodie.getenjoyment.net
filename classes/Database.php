<?php
DEFINE('DB', array(
    "HOST" => 'fdb23.awardspace.net',
    "USER" => '3418615_foodie',
    "PASS" => 'mynameiszero0',
    "DBNAME" => '3418615_foodie'
));
// Lớp database
class Database
{
    // Biến lưu trữ kết nối
    public $cn = NULL;
 
    // Hàm kết nối
    public function connect()
    {
        $this->cn = new mysqli(DB['HOST'], DB['USER'], DB['PASS'], DB['DBNAME']);
    }
 
    // Hàm ngắt kết nối
    public function close()
    {
        if ($this->cn)
        {
            $this->cn->close();
        }
    }
 
    // Hàm truy vấn
    public function query($sql = null) 
    {       
        if ($this->cn)
        {
            $this->cn->query($sql);
        }
    }
 
    // Hàm đếm số hàng
    public function num_rows($sql = null) 
    {
        if ($this->cn)
        {
            $query = $this->cn->query($sql);
            if ($query)
            {
                $row = $query->num_rows;
                return $row;
            }   
        }       
    }
 
    // Hàm lấy dữ liệu
    public function fetch_assoc($sql = null, $type)
    {
        if ($this->cn)
        {
            $query = $this->cn->query($sql);
            if ($query)
            {
                if ($type == 0)
                {
                    // Lấy nhiều dữ liệu gán vào mảng
                    while ($row = $query->fetch_assoc())
                    {
                        $data[] = $row;
                    }
                    return $data;
                }
                else if ($type == 1)
                {
                    // Lấy một hàng dữ liệu gán vào biến
                    $data = $query->fetch_assoc();
                    return $data;
                }
            }       
        }
    }
 
    // Hàm lấy ID cao nhất
    public function insert_id()
    {
        if ($this->cn)
        {
            $count = $this->cn->insert_id;
            if ($count == '0')
            {
                $count = '1';
            }
            else
            {
                $count = $count;
            }
            return $count;
        }
    }
 
    // Hàm charset cho database
    public function set_char($uni)
    {
        if ($this->cn)
        {
            $this->cn->set_charset($uni);
        }
    }
}
 
?>