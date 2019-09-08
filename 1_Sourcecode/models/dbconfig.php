<?php
     class Database
     {
        private $hostname='remotemysql.com';
        private $username ='TsMS9mTEM9';
        private $pass ='HUCxrGi2Bl';
        private $dbname='TsMS9mTEM9';

        private $conn=NULL;
        private $result=NULL;

        //Hàm kết nối CSDL
        //THINH-PVP
        public function connect()
        {
            $this->conn = new mysqli($this->hostname, $this->username, $this->pass,$this->dbname);
            if(!$this->conn)
            {
                echo"Kết nối DB thất bại";
                exit();
            }
            else
            {
               // echo"Ket noi DB thanh cong";
                mysqli_set_charset($this->conn,'utf8');
            }
            return $this->conn;
        }
        
        //Hàm thực thi SQL thực thi cho mọi câu SQL
        //THINH-PVP
        public function execute($sql)
        {
            $this->result = $this->conn->query($sql);
            return $this->result;
        }

        //Lấy toàn bộ dữ liệu từ bản $table
        //THINH-PVP
         public  function getAllData($table)
        {
            $sql = "SELECT * FROM $table";
            $this->execute($sql);
            if($this->num_row()==0)
            {
                $data=0;
            }
            else
            {
               while($datas=$this->getData())
               {
                   $data[] = $datas;
               }
            }
            return $data;
        }

        //Hàm lấy dữ liệu (Hàm con - Không cần quan tâm)
        //THINH-PVP
         public  function getData()
        {
            if($this->result)
            {
                $data = mysqli_fetch_array($this->result);
            }
            else
            {
                $data=0;
            }
            return $data;
        }
        
        //Hàm lấy số lượng dòng của bảng ghi select được
        //THINH-PVP
        public function num_row()
        {
            if($this->result)
            {
                $num = mysqli_num_rows($this->result);
            }
            else
            {
                $num=0;
            }
            return $num;
        }
    }
?>