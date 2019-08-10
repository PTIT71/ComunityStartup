 <?php
     class Database
     {
       private $hostname='localhost';
        private $username ='ist55735_indruinomember1';
        private $pass ='indruino@2019';
        private $dbname='ist55735_isteam_mvc';


        private $conn=NULL;
        private $result=NULL;


        public function connect()
        {
            $this->conn = new mysqli($this->hostname, $this->username, $this->pass,$this->dbname);
            if(!$this->conn)
            {
                //echo"Kết nối thất bại";
                exit();
            }
            else
            {
              //  echo"Ket noi thanh cong";
                mysqli_set_charset($this->conn,'utf8');
            }
            return $this->conn;
        }

        public function execute($sql)
        {
            $this->result = $this->conn->query($sql);
            return $this->result;
        }

        public  function getDataByColumn($table, $id,$col)
        {
            $sql = "SELECT * FROM $table WHERE $col = '$id'";
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

        public  function getOnlyDataBy2Column($table, $id1,$col1,$id2,$col2)
        {
            $sql = "SELECT * FROM $table WHERE $col1 = '$id1' AND $col2='$id2'";
            $this->execute($sql);
            if($this->num_row()!=0)
            {
                $data = mysqli_fetch_array($this->result);

            }
            else
            {
                $data=0;
            }
            return $data;
        }

         public  function GetRow($colName,$idProduct,$tblTable)
         {
             $sql = "SELECT * FROM $tblTable WHERE $colName = '$idProduct'";
            $this->execute($sql);
            if($this->num_row()!=0)
            {
                $data = mysqli_fetch_array($this->result);

            }
            else
            {
                $data=0;
            }
            return $data;
         }

        public  function getDataBy2Column($table, $id1,$col1,$id2,$col2)
        {
            $sql = "SELECT * FROM $table WHERE $col1 = '$id1' AND $col2='$id2'";
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


        public  function GetHomenew($table)
        {
            $sql = "SELECT * FROM $table WHERE showHome=1 ";
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
         public  function GetImageAcess($id)
        {
            $sql = "SELECT * FROM imageaccessories WHERE idSP='$id' ";
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
         public  function Getnews($table)
        {
            $sql = "SELECT * FROM $table WHERE shownews=1 ORDER BY id DESC";
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
        public function InsertData($code,$name_pro,$price,$summary,$image,$requirement,$descript)
        {
           /* $sql = "INSERT INTO products(id,code_pro,name_pro,price_pro,summary,image,description,requirement)VALUES(null,'$code','$name_pro','$price','$summary','$image','$descript','$requirement')";*/

           $sql = "INSERT INTO test(id,code) VALUES (null,'hello')";
            return $this->execute($sql);
        }

        public function insertgeneration($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable)
        {
            $sql = "INSERT INTO generation(idDM, name, image, title, summary, Id_name_gel, background, Navigation) VALUES ('$idDM','$nameSP','$image1','$title','$summary','$pathname','$image2','$navigation')";
            return $this->execute($sql);
        }

        public function UpdategenerationAll($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable)
        {
            $sql = "UPDATE  generation SET name='$nameSP', image='$image1', title='$title', summary='$summary', Id_name_gel='$pathname', background='$image2', Navigation='$navigation' WHERE idDM='$idDM'";
            return $this->execute($sql);
        }
         public function UpdategenerationAnhNen($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable)
        {
            $sql = "UPDATE  generation SET name='$nameSP', title='$title', summary='$summary', Id_name_gel='$pathname', background='$image2', Navigation='$navigation' WHERE idDM='$idDM'";
            return $this->execute($sql);
        }
         public function UpdategenerationAnhDaiDien($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable)
        {
            $sql = "UPDATE  generation SET name='$nameSP', title='$title', summary='$summary', Id_name_gel='$pathname', image='$image1', Navigation='$navigation' WHERE idDM='$idDM'";
            return $this->execute($sql);
        }
        public function UpdategenerationKhongAnh($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable)
        {
            $sql = "UPDATE  generation SET name='$nameSP', title='$title', summary='$summary', Id_name_gel='$pathname', Navigation='$navigation' WHERE idDM='$idDM'";
            return $this->execute($sql);
        }


        public function inserttest($idDM,$name,$tblTable)
        {
            $sql = "INSERT INTO $tblTable(idDM, name) VALUES ('$idDM','$name')";
            return $this->execute($sql);
        }
        public function deleteRow($colName,$idProduct,$tblTable)
        {
            $sql = "DELETE FROM $tblTable WHERE idDM = '$idProduct'";
            return $this-> execute($sql);
        }
         public function deleteRowInt($idProduct,$tblTable)
        {
            $sql = "DELETE FROM $tblTable WHERE Id = $idProduct";
            return $this-> execute($sql);
        }
          public function deleteLELE($idProduct,$tblTable)
        {
            $sql = "DELETE FROM $tblTable WHERE id = $idProduct";
            return $this-> execute($sql);
        }

        public function deleteDownload($colName,$idProduct,$tblTable)
        {
             $sql = "DELETE FROM $tblTable WHERE id = '$idProduct'";
            return $this-> execute($sql);
        }

        public function insertCoverimage($idDM,$image1)
        {
             $sql = "INSERT INTO coverimage (idDM, image) VALUES ('$idDM','$image1')";
            return $this->execute($sql);
        }

        public function insertVideoGeneral($idDM,$title,$link,$source)
        {
            $sql = "INSERT INTO videogeneral (Id,idDM, link, title,source) VALUES (null,'$idDM','$link','$title','$source')";
            return $this->execute($sql);
        }

         public function UpdateVideoGeneral($id,$idDM,$title,$link,$source)
        {
            if($source != '')
            {
                  $sql = "UPDATE  videogeneral SET idDM='$idDM', link='$link', title='$title',source='$source' WHERE  Id = '$id'";
            }
            else
            {
                 $sql = "UPDATE  videogeneral SET idDM='$idDM', link='$link', title='$title' WHERE  Id = '$id'";
            }
          
            return $this->execute($sql);
        }
		  public function insertProducts($dong,$maSP,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable)
        {
            $sql = "INSERT INTO $tblTable (idDM,idSP, NameSP, Price,Requirement,Description,Idimage,Summary,Image) VALUES ('$dong','$maSP','$tenSP','$giaban','$kythuat','$mota','$maanhthunho','$summary','$anhdaidien')";
            return $this->execute($sql);
        }

        public function Delete2Colunm($colName1,$colname2,$idProduct,$idDong,$tblTable)
        {
              $sql = "DELETE FROM $tblTable WHERE $colname2 = '$idProduct' AND $colName1 = '$idDong'";
            return $this-> execute($sql);
        }

        public function GetRowBy2Col($colName1,$idDong,$colname2,$idProduct,$tblTable)
        {
             $sql = "SELECT * FROM $tblTable WHERE $colname2 = '$idProduct' AND $colName1 = '$idDong'";
            $this->execute($sql);
            if($this->num_row()!=0)
            {
                $data = mysqli_fetch_array($this->result);

            }
            else
            {
                $data=0;
            }
            return $data;
        }

        public function UpdateAllProducts($dong,$maSP,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable)
        {
             $sql = "UPDATE $tblTable SET NameSP='$tenSP', Price='$giaban',Requirement='$kythuat',Description='$mota',Idimage='$maanhthunho',Summary='$summary',Image='$anhdaidien' WHERE idDM='$dong' AND idSP='$maSP'";
            return $this->execute($sql);
        }

        public function UpdateNoImageProducts($dong,$maSP,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable)
        {
             $sql = "UPDATE $tblTable SET NameSP='$tenSP', Price='$giaban',Requirement='$kythuat',Description='$mota',Idimage='$maanhthunho',Summary='$summary' WHERE idDM='$dong'AND idSP='$maSP'";
            return $this->execute($sql);
        }

        public function insertTaiLieu($idDM,$idSP,$title,$tailieu2)
        {
            $sql="INSERT INTO document(id,idDM,idSP,title,file) VALUES (null,'$idDM','$idSP','$title','$tailieu2')";
             return $this->execute($sql);
        }

        public function UpdatetTaiLieu($id,$title,$tailieu2)
        {
            $sql="UPDATE document SET title='$title',file='$tailieu2' WHERE id = '$id'";
            return $this->execute($sql);
        }
        public function UpdatetTaiLieuKhongTaiLieu($id,$title,$tailieu2)
        {
             $sql="UPDATE document SET title='$title' WHERE id = '$id'";
            return $this->execute($sql);
        }

        public function insertAnh($idDM,$idSP,$tailieu2)
        {
               $sql="INSERT INTO imageproduct(id,idDM,idSP,file) VALUES (null,'$idDM','$idSP','$tailieu2')";
             return $this->execute($sql);
        }
        public function insertDownload($title,$image1,$tailieu1,$tailieu2,$tailieu3,$tailieu4,$tailieu5,$tailieu6,$tailieu7,$tailieu8,$tailieu9,$tailieu10,$titlelink1,$titlelink2,$titlelink3,$titlelink4,$titlelink5,$titlelink6,$titlelink7,$titlelink8,$titlelink9,$titlelink10)
        {
             $sql="INSERT INTO download(id,title,image,titlelink1,link1,titlelink2,link2,titlelink3,link3,titlelink4,link4,titlelink5,link5,titlelink6,link6,titlelink7,link7,titlelink8,link8,titlelink9,link9,titlelink10,link10) VALUES (null,'$title','$image1','$titlelink1','$tailieu1','$titlelink2','$tailieu2','$titlelink3','$tailieu3','$titlelink4','$tailieu4','$titlelink5','$tailieu5','$titlelink6','$tailieu6','$titlelink7','$tailieu7','$titlelink8','$tailieu8','$titlelink9','$tailieu9','$titlelink10','$tailieu10')";
             return $this->execute($sql);
        }
        public function UpdateDownload($id,$title,$image1,$tailieu1,$tailieu2,$tailieu3,$tailieu4,$tailieu5,$tailieu6,$tailieu7,$tailieu8,$tailieu9,$tailieu10,$titlelink1,$titlelink2,$titlelink3,$titlelink4,$titlelink5,$titlelink6,$titlelink7,$titlelink8,$titlelink9,$titlelink10)
        {
            if($image1!='')
            {

             $sql="UPDATE download SET image='$image1', title='$title',link1='$tailieu1',link2='$tailieu2',link3='$tailieu3',link4='$tailieu4',link5='$tailieu5',link6='$tailieu6',link7='$tailieu7',link8='$tailieu8',link9='$tailieu9',link10='$tailieu10',titlelink3='$titlelink3', titlelink1='$titlelink1', titlelink2='$titlelink2', titlelink4='$titlelink4', titlelink5='$titlelink5', titlelink6='$titlelink6', titlelink7='$titlelink7', titlelink8='$titlelink8', titlelink9='$titlelink9',titlelink10='$titlelink10' WHERE id = '$id'";
            }
            else
            {
                 $sql="UPDATE download SET  title='$title',link1='$tailieu1',link2='$tailieu2',link3='$tailieu3',link4='$tailieu4',link5='$tailieu5',link6='$tailieu6',link7='$tailieu7',link8='$tailieu8',link9='$tailieu9',link10='$tailieu10',titlelink3='$titlelink3', titlelink1='$titlelink1', titlelink2='$titlelink2', titlelink4='$titlelink4', titlelink5='$titlelink5', titlelink6='$titlelink6', titlelink7='$titlelink7', titlelink8='$titlelink8', titlelink9='$titlelink9',titlelink10='$titlelink10' WHERE id = '$id'";
            }
            return $this->execute($sql);
        }

        public function insertTutorials($title,$link,$source)
        {
             $sql="INSERT INTO tutorials(id,title,link,source) VALUES (null,'$title','$link','$source')";
             return $this->execute($sql);
        }

        public function updateTutorials($id,$title,$link,$source)
        {
              $sql="UPDATE tutorials SET title='$title', link='$link', source='$source' WHERE id = '$id'";
            return $this->execute($sql);
        }
 public function insertContact($name,$pos,$des,$tailieu2)
        {
             $sql="INSERT INTO contact(id,name,postion,description,image) VALUES (null,'$name','$pos','$des','$tailieu2')";
             return $this->execute($sql);
        }

        public function updateContact($id,$name,$pos,$des,$tailieu2)
        {
            if($tailieu2!='')
            {
             $sql="UPDATE contact SET name='$name', description='$des',postion='$pos', image='$tailieu2' WHERE id = '$id'";
            }
            else
            {
                $sql="UPDATE contact SET name='$name',postion='$pos', description='$des' WHERE id = '$id'";
            }
            return $this->execute($sql);
        }

        public function updatevp($vp)
        {
             $sql="UPDATE aboutus SET vp='$vp' WHERE id = '0'";
            return $this->execute($sql);
        }

        public function UpdateAbout($title,$content,$image2)
        {
            if($image2 !='')
            {
                $sql="UPDATE aboutus SET anhbia='$image2',  title = '$title', content='$content' WHERE id = '0'";
            }
            else
            {
                $sql="UPDATE aboutus SET  title = '$title', content='$content' WHERE id = '0'";
            }
            return $this->execute($sql);
        }

        public function UpdateCot1($title,$content,$image2)
        {
             if($image2 !='')
            {
                $sql="UPDATE aboutus SET image1='$image2',  title1 = '$title', content1='$content' WHERE id = '0'";
            }
            else
            {
                $sql="UPDATE aboutus SET  title1 = '$title', content1='$content' WHERE id = '0'";
            }
            return $this->execute($sql);
        }
         public function UpdateCot2($title,$content,$image2)
        {
             if($image2 !='')
            {
                $sql="UPDATE aboutus SET image2='$image2',  title2 = '$title', content2='$content' WHERE id = '0'";
            }
            else
            {
                $sql="UPDATE aboutus SET  title2 = '$title', content2='$content' WHERE id = '0'";
            }
            return $this->execute($sql);
        }
          public function UpdateCot3($title,$content,$image2)
        {
             if($image2 !='')
            {
                $sql="UPDATE aboutus SET image3='$image2',  title3 = '$title', content3='$content' WHERE id = '0'";
            }
            else
            {
                $sql="UPDATE aboutus SET  title3 = '$title', content3='$content' WHERE id = '0'";
            }
            return $this->execute($sql);
        }

        public function insertSlider($image2)
        {
            $sql="INSERT INTO anhabout(id,image) VALUES(null,'$image2')";
             return $this->execute($sql);
        }

        public function insertNews($title,$timenews,$address,$summary,$content,$showhome,$shownews,$image1)
        {
            $sql="INSERT INTO news (id, title, day, address, summary, content, image, showHome, shownews) VALUES (NULL, '$title', '$timenews', '$address', '$summary', '$content', '$image1', '$showhome', '$shownews');";
             return $this->execute($sql);
        }
        public function updateNews($id,$title,$timenews,$address,$summary,$content,$showhome,$shownews,$image1)
        {
            if($image1!='')
            {
                $sql="UPDATE news SET title='$title', day='$timenews', address='$address', summary='$summary', content='$content', image='$image1', showHome='$showhome', shownews='$shownews' WHERE id = '$id';";
            }
            else
            {
                $sql="UPDATE news SET title='$title', day='$timenews', address='$address', summary='$summary', content='$content', showHome='$showhome', shownews='$shownews' WHERE id = '$id';";
            }
              
             return $this->execute($sql);
        }

        public function insertAccessories($dong,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable)
        {
             $sql="INSERT INTO $tblTable(id, idDM, name, image, price, description, requirement, summary, codeimage) VALUES(null,'$dong','$tenSP','$anhdaidien','$giaban','$mota','$kythuat','$summary','$maanhthunho')";
             return $this->execute($sql);
        }
        public function UpdateAccessories($id,$dong,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable)
        {
            if($anhdaidien!='')
            {
            $sql="UPDATE $tblTable SET idDM='$dong', name='$tenSP', image='$anhdaidien', price='$giaban', description='$mota', requirement='$kythuat', summary='$summary', codeimage='$maanhthunho' WHERE id = '$id';";
            }
            else
            {
 $sql="UPDATE $tblTable SET idDM='$dong', name='$tenSP', price='$giaban', description='$mota', requirement='$kythuat', summary='$summary', codeimage='$maanhthunho' WHERE id = '$id';";
            }

            return $this->execute($sql);
        }

        public function insertAnhCon($id,$image2)
        {
            $sql="INSERT INTO imageaccessories(id,idSP,image) VALUES(null,'$id','$image2')";
             return $this->execute($sql);
        }


    }

?>