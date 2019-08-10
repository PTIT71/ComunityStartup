<?php
include_once 'model/dbconfig.php';
$db = new Database;
$db->connect();
session_start();
$tblTable  = "aboutus";
$valuesvp=$db->GetRow('id','0',$tblTable);
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_POST["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	str_replace(".","", $_POST["hidden_price"]),
				'item_quantity'		=>	$_POST["quantity"],
				'item_image'		=>	$_POST["image"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
			require_once('view/shoppingcart.php');
		return;
			
		
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_POST["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	str_replace(".","", $_POST["hidden_price"]),
		'item_quantity'		=>	$_POST["quantity"],
				'item_image'		=>	$_POST["image"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
		require_once('view/shoppingcart.php');
		return;
			
	}
	return;
}


if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				require_once('view/shoppingcart.php');
		return;
			}
		}
	}
		
}
if(isset($_GET["action"]))
{
	if(isset($_GET["id"]))
	{
		if (isset($_POST['order'])) {
					$to = "indruino.isteam@gmail.com";
					//$to = "phanvanphuocthinh@gmail.com";
					$from = "phuocthinhit2016@gmail.com";
					$subject = 'ISTEAM CUSTOMER';
					$header .= 'From: '.$from;
					$shipment ="\nTen San Pham 	So Luong 	Don gia 	Thanh Tien";

					if(!empty($_SESSION["shopping_cart"]))
					{
						$total=0;
					      
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							$tongtien = number_format($values["item_quantity"] * $values["item_price"], 0);
							$shipment = $shipment ."\n".$values["item_name"]  ."		" .$values["item_quantity"] ."		" .$values["item_price"] ."		" .$tongtien;
								$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}

						$shipment = $shipment ."\nTong Tien: " .$total;
					}

					$mess = 'Sender: ' .$_POST['nameuser']."\nPhone: " .$_POST['phone'] ."\nEmail: " .$_POST['email'] ."\nContent: " .$shipment;
					//$mess = $shipment;
					include 'view/funtion.php';
					include 'view/PHPMailer.php';
					include 'view/POP3.php';
					include 'view/SMTP.php';
					define('USN', $from);
					define('PASS', 'suynghitichcuclamviechetminh');
					if(smtpmailer($to, $from, $subject, $header, $mess))
					{
					require_once('view/thankyou.php');
					return;
				}
				}
	
	}
		
}
if (isset($_GET['guest'])) {
	$controller = $_GET['guest'];
	switch ($controller) {
		case 'home': {
				$tblTable  = "generation";
				$data = $db->getAllData($tblTable);
				$tblTable  = "videogeneral";
				$datavideo = $db->getAllData($tblTable);
				$tblTable  = "coverimage";
				$datacoverimage = $db->getAllData($tblTable);
				$tblTable  = "news";
                $datanews = $db->GetHomenew($tblTable);
				require_once('view/home.php');
				return;
			}
		case 'login': {
				if (isset($_POST['dangnhap'])) {
					$usn =  $_POST['usn'];
					$pass =  $_POST['pass'];
					if ($usn == "admin" && $pass == "indruino@2019") {
						$tblTable  = "generation";
						$data = $db->getAllData($tblTable);
						$tblTable  = "videogeneral";
						$datavideo = $db->getAllData($tblTable);
						$tblTable  = "coverimage";
						$datacoverimage = $db->getAllData($tblTable);
						require_once('view/home.php');
						return;
					}
					if ($usn == "admin" && $pass == "123456@indruino") {
						$tblTable  = "generation";
						$data = $db->getAllData($tblTable);
						require_once('view/admin/ListGeneral.php');
						return;
						
					}
				}
				require_once('view/login.php');
				return;
				break;
			}
		case 'ditail-nikibot': {
				require_once('view/productditail.php');
				return;
				break;
			}
			return;
	}
}
if(isset($_GET['action']))
{
	if($_GET['action']=='shopping')
	{
		if (isset($_POST['order'])) {
					$to = "indruino.isteam@gmail.com";
					//$to = "phanvanphuocthinh@gmail.com";
					$from = "phuocthinhit2016@gmail.com";
					$subject = 'ISTEAM CUSTOMER';
					$header .= 'From: '.$from;
					$shipment ="\nTen San Pham 	So Luong 	Don gia 	Thanh Tien";

					if(!empty($_SESSION["shopping_cart"]))
					{
						$total=0;
					      
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							$tongtien = number_format($values["item_quantity"] * $values["item_price"], 0);
							$shipment = $shipment ."\n".$values["item_name"]  ."		" .$values["item_quantity"] ."		" .$values["item_price"] ."		" .$tongtien;
								$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}

						$shipment = $shipment ."\nTong Tien: " .$total;
					}

					$mess = 'Sender: ' .$_POST['nameuser']."\nPhone: " .$_POST['phone'] ."\nEmail: " .$_POST['email'] ."\nContent: " .$shipment;
					//$mess = $shipment;
					include 'view/funtion.php';
					include 'view/PHPMailer.php';
					include 'view/POP3.php';
					include 'view/SMTP.php';
					define('USN', $from);
					define('PASS', 'suynghitichcuclamviechetminh');
					if(smtpmailer($to, $from, $subject, $header, $mess))
					{
					require_once('view/thankyou.php');
					return;
				}
				}
		require_once('view/shoppingcart.php');
		return;
	}
}
if (isset($_GET['generation'])) {
	if (isset($_GET['product'])) {
		$idProduct = $_GET['product'];
		$idcol2 = 'idSP';
		$id_nem = $_GET['generation'];
		$tblTable  = "products";
		$col1 = "idDM";
		$dataProduct = $db->getOnlyDataBy2Column($tblTable, $id_nem, $col1, $idProduct, $idcol2);
		$tblTableImage  = "imageproduct";
		$dataImage = $db->getDataBy2Column($tblTableImage, $id_nem, $col1, $idProduct, $idcol2);
		if (isset($_POST['dathang'])) {
			$to = "indruino.isteam@gmail.com";
			$from =  $_POST['emailfrom'];
			$subject =  $_POST['subject'];
			$mess =  $_POST['mess'];
			$header =  $_POST['header'];
			$pass = $_POST['pass'];
			include 'funtion.php';
			include 'PHPMailer.php';
			include 'POP3.php';
			include 'SMTP.php';
			define('USN', $from);
			define('PASS', $pass);
			smtpmailer($to, $from, $subject, $header, $mess);
		}
		if (isset($_POST['order'])) {
					$to = "indruino.isteam@gmail.com";
					//$to = "phanvanphuocthinh@gmail.com";
					$from = "phuocthinhit2016@gmail.com";
					$subject = 'ISTEAM CUSTOMER';
					$header .= 'From: '.$from;
					$shipment ="\nTen San Pham 	So Luong 	Don gia 	Thanh Tien";

					if(!empty($_SESSION["shopping_cart"]))
					{
						$total=0;
					      
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							$tongtien = number_format($values["item_quantity"] * $values["item_price"], 0);
							$shipment = $shipment ."\n".$values["item_name"]  ."		" .$values["item_quantity"] ."		" .$values["item_price"] ."		" .$tongtien;
								$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}

						$shipment = $shipment ."\nTong Tien: " .$total;
					}

					$mess = 'Sender: ' .$_POST['nameuser']."\nPhone: " .$_POST['phone'] ."\nEmail: " .$_POST['email'] ."\nContent: " .$shipment;
					//$mess = $shipment;
					include 'view/funtion.php';
					include 'view/PHPMailer.php';
					include 'view/POP3.php';
					include 'view/SMTP.php';
					define('USN', $from);
					define('PASS', 'suynghitichcuclamviechetminh');
					if(smtpmailer($to, $from, $subject, $header, $mess))
					{
					require_once('view/thankyou.php');
					return;
				}
				}
	
		require_once('view/productditail.php');
		return;
	}
	if (isset($_GET['productAcessories'])) {
		$idProduct = $_GET['productAcessories'];
		$idcol2 = 'id';
		$id_nem = $_GET['generation'];
		$tblTable  = "accessories";
		$col1 = "idDM";
		$dataProduct = $db->getOnlyDataBy2Column($tblTable, $id_nem, $col1, $idProduct, $idcol2);
		$tblTableImage  = "imageproduct";
		$dataImage = $db->getDataBy2Column($tblTableImage, $id_nem, $col1, $idProduct, $idcol2);
		if (isset($_POST['dathang'])) {
			$to = "indruino.isteam@gmail.com";
			$from =  $_POST['emailfrom'];
			$subject =  $_POST['subject'];
			$mess =  $_POST['mess'];
			$header =  $_POST['header'];
			$pass = $_POST['pass'];
			include 'funtion.php';
			include 'PHPMailer.php';
			include 'POP3.php';
			include 'SMTP.php';
			define('USN', $from);
			define('PASS', $pass);
			smtpmailer($to, $from, $subject, $header, $mess);
		}
		if (isset($_POST['order'])) {
					$to = "indruino.isteam@gmail.com";
					//$to = "phanvanphuocthinh@gmail.com";
					$from = "phuocthinhit2016@gmail.com";
					$subject = 'ISTEAM CUSTOMER';
					$header .= 'From: '.$from;
					$shipment ="\nTen San Pham 	So Luong 	Don gia 	Thanh Tien";

					if(!empty($_SESSION["shopping_cart"]))
					{
						$total=0;
					      
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							$tongtien = number_format($values["item_quantity"] * $values["item_price"], 0);
							$shipment = $shipment ."\n".$values["item_name"]  ."		" .$values["item_quantity"] ."		" .$values["item_price"] ."		" .$tongtien;
								$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}

						$shipment = $shipment ."\nTong Tien: " .$total;
					}

					$mess = 'Sender: ' .$_POST['nameuser']."\nPhone: " .$_POST['phone'] ."\nEmail: " .$_POST['email'] ."\nContent: " .$shipment;
					//$mess = $shipment;
					include 'view/funtion.php';
					include 'view/PHPMailer.php';
					include 'view/POP3.php';
					include 'view/SMTP.php';
					define('USN', $from);
					define('PASS', 'suynghitichcuclamviechetminh');
					if(smtpmailer($to, $from, $subject, $header, $mess))
					{
					require_once('view/thankyou.php');
					return;
				}
				}
	    $tblTable = "imageaccessories";
	    $dateimageacc = $db-> GetImageAcess($idProduct);
		require_once('view/productditailAccess.php');
		return;
	}

	//Lay tât cả các mục sản phảm của thế hệ robot này
	$id_nem = $_GET['generation'];
	$tblTable  = "products";
	$col = "idDM";
	$dataProducts = $db->getDataByColumn($tblTable, $id_nem, $col);
	//Lấy thông tin ảnh bìa
	$id_nem = $_GET['generation'];
	$tblTable  = "generation";
	$col = "Id_name_gel";
	$data = $db->getDataByColumn($tblTable, $id_nem, $col);
	//Lấy thông tin ảnh bìa
	$id_nem = $_GET['generation'];
	$tblTable  = "videogeneral";
	$col = "idDM";
	$dataVideo = $db->getDataByColumn($tblTable, $id_nem, $col);
	//Lấy thông tin ảnh bìa
	$id_nem = $_GET['generation'];
	$tblTable  = "document";
	$col = "idDM";
	$dataDocument = $db->getDataByColumn($tblTable, $id_nem, $col);
	$tblTable  = "accessories";
	$col = "idDM";
	$dataAcc = $db->getDataByColumn($tblTable, $id_nem, $col);
	require_once('view/products.php');
	return;
}
if (isset($_GET['customer'])) {
	$controller = $_GET['customer'];
	switch ($controller) {
		case 'products': {
				$tblTable  = "generation";
				$dataProducts = $db->getAllData($tblTable);
				$tblTable  = "videogeneral";
				$datavideo = $db->getAllData($tblTable);
				require_once('view/sanpham.php');
				return;
				break;
			}
		case 'contact': 
		{
				$tblTable  = "contact";
				$data = $db->getAllData($tblTable);
				if (isset($_POST['contact'])) {
					$to = "indruino.isteam@gmail.com";
					//$to = "phanvanphuocthinh@gmail.com";
					$from = "phuocthinhit2016@gmail.com";
					$subject = 'ISTEAM RESPONES';
					$mess = 'Sender: ' .$_POST['nameuer'] ."\n Email: " .$_POST['email'] ."\n Phone: " .$_POST['phone'] ."\nContent: ".$_POST['mass'];
					$header = 'FROM: ' . $_POST['email'];
					include 'view/funtion.php';
					include 'view/PHPMailer.php';
					include 'view/POP3.php';
					include 'view/SMTP.php';
					define('USN', $from);
					define('PASS', 'suynghitichcuclamviechetminh');
					smtpmailer($to, $from, $subject, $header, $mess);
					require_once('view/contact.php');
				}

				$tblTable  = "aboutus";
				$valuesvp=$db->GetRow('id','0',$tblTable);
				require_once('view/contact.php');
				return;
				break;
		}

		case 'download':
		{
		    
		    $tblTable='download';
		    $data=$db->getAllData($tblTable);
			require_once('view/download.php');
			return;
			break;

		}
		case 'tutorials':
		{
		    
		    $tblTable='tutorials';
		    $data=$db->getAllData($tblTable);
			require_once('view/tutorials.php');
			return;
			break;

		}
		case 'about-us':
		{
		    
		    $tblTable  = "aboutus";
			$value = $db-> GetRow('id','0',$tblTable);
			$tblTable ="anhabout";
			$dataImage = $db->getAllData($tblTable);
			require_once('view/aboutus.php');
			return;
			break;

		}
		case 'news':
		{
			  $tblTable  = "news";
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
				$colName = 'id';
				$data = $db->GetRow($colName,$id,$tblTable);
				$dataNews = $db->Getnews($tblTable);
				require_once('view/newsdetails.php');
			    return;
			    break;

			}
		    
		  
			$dataNews = $db->Getnews($tblTable);
			require_once('view/news.php');
			return;
			break;

		}

			
		return;
	}
}
if (isset($_GET['boss'])) {
	$abc = $_GET['boss'];
	if ($abc == 'motngaymoi') {
		if (isset($_GET['view'])) {
			$abcd = $_GET['view'];
			if ($abcd == 'generation') {
				$tblTable  = "coverimage";
				$dataImage = $db->getAllData($tblTable);
				$tblTable  = "generation";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/ListGeneral.php');
				return;
			}
			if ($abcd == 'coverimage') {
				$tblTable  = "coverimage";
				$dataImage = $db->getAllData($tblTable);
				require_once('view/admin/ListCoverImage.php');
				return;
			}
			if ($abcd == 'videogeneral') {
				$tblTable  = "videogeneral";
				$dataImage = $db->getAllData($tblTable);
				require_once('view/admin/ListVideoDemo.php');
				return;
			}
			if ($abcd == 'products') {
				$tblTable  = "products";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/listSanPhamDongRobot.php');
				return;
			}
			if ($abcd == 'document') {
				$tblTable  = "document";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/ListDocument.php');
				return;
			}
			if ($abcd == 'imagesmall') {
				$tblTable  = "imageproduct";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/ListHinhAnhThuNho.php');
				return;
			}
			if ($abcd == 'supportdownload') {
				$tblTable  = "download";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/Listdownload.php');
				return;
			}
			if ($abcd == 'tutorials') {
				$tblTable  = "tutorials";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/ListTutorials.php');
				return;
			}
			if ($abcd == 'contact') {
				$tblTable  = "contact";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/ListContact.php');
				return;
			}
			if ($abcd == 'news') {
				$tblTable  = "news";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/ListNews.php');
				return;
			}
			if ($abcd == 'accessories') {
				$tblTable  = "accessories";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/ListAccessories.php');
				return;
			}
		}
		if (isset($_GET['action'])) {
			$abcd = $_GET['action'];
			switch ($abcd) {
				case 'addGeneration':
					{
						if (isset($_POST['ThemSanPham']))
						{
							$idDM = $_POST['idDM'];
							$nameSP = $_POST['nameDM'];
							$title = $_POST['title'];
							$summary = $_POST['summary'];
							$pathname = $_POST['id_name_gel'];
							$navigation= $_POST['navigation'];
							$target1 = "view/images/idn_images/".basename($_FILES['anhdaidien']['name']);
							$image1 = $_FILES['anhdaidien']['name'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhnen']['name']);
							$image2 = $_FILES['anhnen']['name'];
								
							$tblTable="generation";
										if(	$db->insertgeneration($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable))
							{
								if(move_uploaded_file($_FILES['anhdaidien']['tmp_name'],$target1))
								{
									if(move_uploaded_file($_FILES['anhnen']['tmp_name'],$target2))
									{
										$tblTable  = "generation";
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListGeneral.php');
										return;
									}
								}
								else
								{
									$smg="upload không thành công";
								}
							}
						
						}
						require_once('view/admin/addGeneration.php');
										
					return;
					}
					case 'addCoverImage':
					{
						
						if (isset($_POST['Themanhbia']))
						{
							$idDM = $_POST['idDM'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhbia']['name']);
							$image2 = $_FILES['anhbia']['name'];
							
								
							$tblTable="generation";
										if(	$db->insertCoverimage($idDM,$image2))
							{
								
									if(move_uploaded_file($_FILES['anhbia']['tmp_name'],$target2))
									{
										$tblTable  = "coverimage";
										$dataImage = $db->getAllData($tblTable);
										require_once('view/admin/ListCoverImage.php');
										return;
									}
								
									else
									{
										echo "upload không thành công";
									}
							}
						
						}
						require_once('view/admin/addCoverImage.php');
						return;
					}
					
					case 'addVideoDemo':
					{
						if (isset($_POST['ThemVideoDemo']))
						{
							$idDM = $_POST['idDM'];
							$title = $_POST['title'];
							$link = $_POST['linkYoutube'];
							$source = $_POST['source'];
							
								
							$tblTable="videogeneral";
							$db->insertVideoGeneral($idDM,$title,$link,$source);
						}
						
						$tblTable  = "generation";
						$data = $db->getAllData($tblTable);
						require_once('view/admin/addVideoDemo.php');
						return;
					}
					case 'addAccessories':
					{
						if (isset($_POST['ThemSanPhuKien']))
						{
							$dong = $_POST['dongSP'];
							$tenSP = $_POST['tenSP'];
							$summary = $_POST['summary'];
							$giaban = $_POST['price'];
							$mota=$_POST['noidungmota'];
							$kythuat=$_POST['noidungkythuat'];
							$anhdaidien= $_FILES['anhdaidiensanpham']['name'];
							$maanhthunho=$_POST['maanhthunho'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhdaidiensanpham']['name']);
							$image2 = $_FILES['anhdaidiensanpham']['name'];
							
							$tblTable="accessories";
							if(	$db->insertAccessories($dong,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable))
							{
								if(move_uploaded_file($_FILES['anhdaidiensanpham']['tmp_name'],$target2))
								{
									
									$tblTable  = "accessories";
									$data = $db->getAllData($tblTable);
									require_once('view/admin/ListAccessories.php');
									return;
									
								}
								else
								{
									$smg="upload không thành công";
								}
							}
						}
						
						$tblTable  = "generation";
						$data = $db->getAllData($tblTable);
						require_once('view/admin/addAccessories.php');
						return;
					}
					case 'addDocument':
					{
						if (isset($_POST['ThemTaiLieu']))
						{
							$idDM = $_POST['idDM'];
							$idSP = $_POST['idSP'];
							$title = $_POST['title'];
						//$target2 = "view/document/".basename($_FILES['tailieu']['name']);
							//$tailieu2 = $_FILES['tailieu']['name'];
							$tailieu2 = $_POST['file'];
							
								
							$tblTable="document";
							if($db->insertTaiLieu($idDM,$idSP,$title,$tailieu2))
							{
								/*
									if(move_uploaded_file($_FILES['tailieu']['tmp_name'],$target2))
									{
										$tblTable  = "document";
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListDocument.php');
										return;
									}
									*/
									$tblTable  = "document";
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListDocument.php');
										return;
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
					    $tblTable  = "products";
						$data = $db->getAllData($tblTable);
						require_once('view/admin/addDocument.php');
						return;
					}
					case 'addDownload':
					{
						if (isset($_POST['ThemDownload']))
						{
							$title = $_POST['title'];
							$target1 = "view/images/idn_images/".basename($_FILES['anhmoi']['name']);
							$image1 = $_FILES['anhmoi']['name'];
							$tailieu1 = $_POST['file1'];
							$tailieu2 = $_POST['file2'];
							$tailieu3 = $_POST['file3'];
							$tailieu4 = $_POST['file4'];
							$tailieu5 = $_POST['file5'];
							$tailieu6 = $_POST['file6'];
							$tailieu7 = $_POST['file7'];
							$tailieu8 = $_POST['file8'];
							$tailieu9 = $_POST['file9'];
							$tailieu10 = $_POST['file10'];

							$titlelink1 = $_POST['titlelink1'];
							$titlelink2 = $_POST['titlelink2'];
							$titlelink3 = $_POST['titlelink3'];
							$titlelink4 = $_POST['titlelink4'];
							$titlelink5 = $_POST['titlelink5'];
							$titlelink6 = $_POST['titlelink6'];
							$titlelink7 = $_POST['titlelink7'];
							$titlelink8 = $_POST['titlelink8'];
							$titlelink9 = $_POST['titlelink9'];
							$titlelink10 = $_POST['titlelink10'];
							
								
							$tblTable="download";
							if($db->insertDownload($title,$image1,$tailieu1,$tailieu2,$tailieu3,$tailieu4,$tailieu5,$tailieu6,$tailieu7,$tailieu8,$tailieu9,$tailieu10,$titlelink1,$titlelink2,$titlelink3,$titlelink4,$titlelink5,$titlelink6,$titlelink7,$titlelink8,$titlelink9,$titlelink10))
							{
								if(move_uploaded_file($_FILES['anhmoi']['tmp_name'],$target1))
								{
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListDownload.php');
										return;
									}
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
						require_once('view/admin/addDownload.php');
						return;
					}

					case 'addTutorials':
					{
						if (isset($_POST['ThemTutorials']))
						{
							$title = $_POST['title'];
							$link = $_POST['link'];
							$source = $_POST['source'];
						
							
								
							$tblTable="tutorials";
							if($db->insertTutorials($title,$link,$source))
							{
								
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListTutorials.php');
										return;
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
						require_once('view/admin/addTutorials.php');
						return;
					}
					break;
					case 'addNews':
					{
						if (isset($_POST['ThemNews']))
						{
							$title = $_POST['title'];
							$timenews = $_POST['timenews'];
							$address = $_POST['addressnews'];
							$summary = $_POST['summary'];
							$content = $_POST['content'];
							$showhome = $_POST['showhome'];
							$shownews = $_POST['shownews'];
						     
						    $target1 = "view/images/idn_images/".basename($_FILES['anhdaidien']['name']);
							$image1 = $_FILES['anhdaidien']['name'];
							
								
							$tblTable="news";
							if($db->insertNews($title,$timenews,$address,$summary,$content,$showhome,$shownews,$image1))
							{
								if(move_uploaded_file($_FILES['anhdaidien']['tmp_name'],$target1))
								{
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListNews.php');
										return;
								}
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
						require_once('view/admin/addNews.php');
						return;
					}
					break;
					case 'aboutus':
					{
						if (isset($_POST['CapNhatAnhBia']))
						{
							$title = $_POST['tieudeanhbia'];
							$content = $_POST['noidunganhbia'];

						    $target2 = "view/images/idn_images/".basename($_FILES['anhbia']['name']);
							$image2 = $_FILES['anhbia']['name'];
							
								
							$tblTable="aboutus";
							if($db->UpdateAbout($title,$content,$image2))
							{
								if(move_uploaded_file($_FILES['anhbia']['tmp_name'],$target2))
								{
									$tblTable="aboutus";
									$value = $db-> GetRow('id','0',$tblTable);
									$tblTable="anhabout";
									$dataImage =$db->getAllData($tblTable);
									require_once('view/admin/EditAboutUs.php');
									return;
								}
										
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}

						if (isset($_POST['noidungcot1']))
						{
							$title = $_POST['titlecot1'];
							$content = $_POST['noidungcot1'];

						    $target2 = "view/images/idn_images/".basename($_FILES['anhcot1']['name']);
							$image2 = $_FILES['anhcot1']['name'];
							
								
							$tblTable="aboutus";
							if($db->UpdateCot1($title,$content,$image2))
							{
								if(move_uploaded_file($_FILES['anhcot1']['tmp_name'],$target2))
								{
									$tblTable="aboutus";
									$value = $db-> GetRow('id','0',$tblTable);
									$tblTable="anhabout";
									$dataImage =$db->getAllData($tblTable);
									require_once('view/admin/EditAboutUs.php');
									return;
								}
										
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}

						if (isset($_POST['noidungcot2']))
						{
							$title = $_POST['titlecot2'];
							$content = $_POST['noidungcot2'];

						    $target2 = "view/images/idn_images/".basename($_FILES['anhcot2']['name']);
							$image2 = $_FILES['anhcot2']['name'];
							
								
							$tblTable="aboutus";
							if($db->UpdateCot2($title,$content,$image2))
							{
								if(move_uploaded_file($_FILES['anhcot2']['tmp_name'],$target2))
								{
									$tblTable="aboutus";
									$value = $db-> GetRow('id','0',$tblTable);
									require_once('view/admin/EditAboutUs.php');
									$tblTable="anhabout";
									$dataImage =$db->getAllData($tblTable);
									return;
								}
										
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						if (isset($_POST['noidungcot3']))
						{
							$title = $_POST['titlecot3'];
							$content = $_POST['noidungcot3'];

						    $target2 = "view/images/idn_images/".basename($_FILES['anhcot3']['name']);
							$image2 = $_FILES['anhcot3']['name'];
							
								
							$tblTable="aboutus";
							if($db->UpdateCot3($title,$content,$image2))
							{
								if(move_uploaded_file($_FILES['anhcot3']['tmp_name'],$target2))
								{
									$tblTable="aboutus";
									$value = $db-> GetRow('id','0',$tblTable);
									$tblTable="anhabout";
									$dataImage =$db->getAllData($tblTable);
									require_once('view/admin/EditAboutUs.php');
									return;
								}
										
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						if (isset($_POST['CapNhatSlider']))
						{
							

						    $target2 = "view/images/idn_images/".basename($_FILES['anhbiaSlide']['name']);
							$image2 = $_FILES['anhbiaSlide']['name'];
							
								
							$tblTable="anhabout";
							if($db->insertSlider($image2))
							{
								if(move_uploaded_file($_FILES['anhbiaSlide']['tmp_name'],$target2))
								{
									$tblTable="aboutus";
									$value = $db-> GetRow('id','0',$tblTable);
									$tblTable="anhabout";
									$dataImage =$db->getAllData($tblTable);
									require_once('view/admin/EditAboutUs.php');
									return;
								}
										
							}
							else
							{
								echo 'Khong thanh cong roi';
							}
						}


						$tblTable="aboutus";
						$value = $db-> GetRow('id','0',$tblTable);
						$tblTable="anhabout";
						$dataImage =$db->getAllData($tblTable);
						require_once('view/admin/EditAboutUs.php');
						return;
					}
					break;
					case 'addContact':
					{
						if (isset($_POST['ThemContact']))
						{
							$name = $_POST['name'];
							$des = $_POST['description'];
							$pos = $_POST['chucvu'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhmoi']['name']);
							$tailieu2 = $_FILES['anhmoi']['name'];
						
						
							
								
							$tblTable="contact";
							if($db->insertContact($name,$pos,$des,$tailieu2))
							{
								if(move_uploaded_file($_FILES['anhmoi']['tmp_name'],$target2))
									{
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListContact.php');
										return;
									}
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}

						if (isset($_POST['SuaThongTin']))
						{
							$vp = $_POST['thongtinvanphong'];
							
						
							
								
							$tblTable="aboutus";
							if($db->updatevp($vp))
							{
								$tblTable="contact";
								$data = $db->getAllData($tblTable);
								require_once('view/admin/ListContact.php');
								return;
									
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						$tblTable="aboutus";
						$value = $db-> GetRow('id','0',$tblTable);
						require_once('view/admin/addContact.php');
						return;
					}
					case 'addImage':
					{
						if (isset($_POST['ThemAnhMoi']))
						{
							$idDM = $_POST['idDM'];
							$idSP = $_POST['idSP'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhmoi']['name']);
							$tailieu2 = $_FILES['anhmoi']['name'];
							
								
							$tblTable="document";
							if($db->insertAnh($idDM,$idSP,$tailieu2))
							{
									if(move_uploaded_file($_FILES['anhmoi']['tmp_name'],$target2))
									{
										echo 'luu anh thanh cong';
										$tblTable  = "imageproduct";
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListHinhAnhThuNho.php');
										return;
									}
									else
									{
										echo 'Luu anh Khong thanh cong';
									}
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
					    $tblTable  = "products";
						$data = $db->getAllData($tblTable);
						require_once('view/admin/addimage.php');
						return;
					}
					case 'addProduct':
					{
						
						require_once('view/admin/addProduct.php');
						return;
					}
					case 'addProductDitail':
					{
						if (isset($_POST['ThemSanPhamChiTiet']))
						{
							$dong = $_POST['dongSP'];
							$maSP = $_POST['maSP'];
							$tenSP = $_POST['tenSP'];
							$summary = $_POST['summary'];
							$giaban = $_POST['price'];
							$mota=$_POST['noidungmota'];
							$kythuat=$_POST['noidungkythuat'];
							$anhdaidien= $_FILES['anhdaidiensanpham']['name'];
							$maanhthunho=$_POST['maanhthunho'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhdaidiensanpham']['name']);
							$image2 = $_FILES['anhdaidiensanpham']['name'];
							
							$tblTable="products";
										if(	$db->insertProducts($dong,$maSP,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable))
							{
								if(move_uploaded_file($_FILES['anhdaidiensanpham']['tmp_name'],$target2))
								{
									
									$tblTable  = "products";
				$data = $db->getAllData($tblTable);
				require_once('view/admin/listSanPhamDongRobot.php');
						return;
									
								}
								else
								{
									$smg="upload không thành công";
								}
							}
						}
						$tblTable  = "generation";
						$data = $db->getAllData($tblTable);
						require_once('view/admin/addProductDitail.php');
						return;
					}
				case 'delete':
					if(isset($_GET['id']))
					{
						$idProduct = $_GET['id'];
						$tblTable = 'generation';
						$colName = 'idDM';
						if($db-> deleteRow($colName,$idProduct,$tblTable))
						$tblTable  = "generation";
						$data = $db->getAllData($tblTable);
						require_once('view/admin/ListGeneral.php');
						return;
					}
					break;
				case 'deletecover':
				if(isset($_GET['id']))
				{
					$idProduct = $_GET['id'];
					$tblTable = 'coverimage';
					$colName = 'idDM';
					if($db-> deleteRow($colName,$idProduct,$tblTable))
					$tblTable  = "coverimage";
					$dataImage = $db->getAllData($tblTable);
					require_once('view/admin/ListCoverImage.php');
					return;
				}
				break;
				case 'deletevideo':
				if(isset($_GET['id']))
				{
					$idProduct = $_GET['id'];
					$tblTable = 'videogeneral';
					$colName = 'Id';
					if($db-> deleteRowInt($colName,$idProduct,$tblTable))
					$dataImage = $db->getAllData($tblTable);
					require_once('view/admin/ListVideoDemo.php');
					return;
				}

				break;
				case 'deleteDownload':
				if(isset($_GET['id']))
				{
					$idProduct = $_GET['id'];
					$tblTable = 'download';
					$colName = 'id';
					if($db-> deleteDownload($colName,$idProduct,$tblTable))
					{
						$data = $db->getAllData($tblTable);
						require_once('view/admin/ListDownload.php');
					}
					return;
				}
				case 'deleteAnhCon':
				if(isset($_GET['id']))
				{
					$idProduct = $_GET['id'];
					$tblTable = 'imageaccessories';
					$colName = 'id';
					if($db-> deleteDownload($colName,$idProduct,$tblTable))
					{
						$tblTable = 'accessories';
						$data = $db->getAllData($tblTable);
						require_once('view/admin/ListAccessories.php');
					}
					return;
				}
				case 'deleteAccessories':
				if(isset($_GET['id']))
				{
					$idProduct = $_GET['id'];
					$tblTable = 'accessories';
					$colName = 'id';
					if($db-> deleteDownload($colName,$idProduct,$tblTable))
					{
						$data = $db->getAllData($tblTable);
						require_once('view/admin/ListAccessories.php');
					}
					return;
				}
				case 'deleteTutorials':
				if(isset($_GET['id']))
				{
					$idProduct = $_GET['id'];
					$tblTable = 'tutorials';
					$colName = 'id';
					if($db-> deleteDownload($colName,$idProduct,$tblTable))
					{
						$data = $db->getAllData($tblTable);
						require_once('view/admin/ListTutorials.php');
					}
					return;
				}
				
				break;
				case 'deleteProduct':
				if(isset($_GET['idD']))
				{
					if(isset($_GET['idS']))
					{
						$idDong = $_GET['idD'];
						$idProduct = $_GET['idS'];
						$tblTable = 'products';
						$colName1 = 'idDM';
						$colname2='idSP';
						if($db-> Delete2Colunm($colName1,$colname2,$idProduct,$idDong,$tblTable))
						{
						echo "xoa thanh cong";
					}
					else
					{
						echo 'xoa khong thanh cong';
					}
					$data = $db->getAllData($tblTable);
						require_once('view/admin/listSanPhamDongRobot.php');
						return;
					}
					
				}
				break;
					case 'deletedocument':
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];
						
						$tblTable = 'document';
					
						if($db-> deleteLELE($id,$tblTable))
						{
						echo "xoa thanh cong";
					}
					else
					{
						echo 'xoa khong thanh cong';
					}
					     $data = $db->getAllData($tblTable);
						require_once('view/admin/ListDocument.php');
						return;
				}
				break;

				case 'deleteimage':
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];
						
						$tblTable = 'imageproduct';
					
						if($db-> deleteLELE($id,$tblTable))
						{
						echo "xoa thanh cong";
					}
					else
					{
						echo 'xoa khong thanh cong';
					}
					     $data = $db->getAllData($tblTable);
						require_once('view/admin/ListHinhAnhThuNho.php');
						return;
				}
				break;

				case 'deleteContact':
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];
						
						$tblTable = 'contact';
					
						if($db-> deleteLELE($id,$tblTable))
						{
						echo "xoa thanh cong";
					}
					else
					{
						echo 'xoa khong thanh cong';
					}
					     $data = $db->getAllData($tblTable);
						require_once('view/admin/ListContact.php');
						return;
				}
				break;
				case 'deleteNews':
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];
						
						$tblTable = 'news';
					
						if($db-> deleteLELE($id,$tblTable))
						{
						echo "xoa thanh cong";
					}
					else
					{
						echo 'xoa khong thanh cong';
					}
					     $data = $db->getAllData($tblTable);
						require_once('view/admin/ListNews.php');
						return;
				}
				break;
				case 'deleteSlider':
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];
						
						$tblTable = 'anhabout';
					
						if($db-> deleteLELE($id,$tblTable))
						{
						echo "xoa thanh cong";
					}
					else
					{
						echo 'xoa khong thanh cong';
					}
					    $tblTable="aboutus";
									$value = $db-> GetRow('id','0',$tblTable);
									$tblTable="anhabout";
									$dataImage =$db->getAllData($tblTable);
									require_once('view/admin/EditAboutUs.php');
									return;
				}
				break;



				case 'edit':
				if(isset($_GET['id']))
				{
					$idProduct = $_GET['id'];
					$tblTable = 'generation';
					$colName = 'idDM';
					$dataRow = $db-> GetRow($colName,$idProduct,$tblTable);
					if (isset($_POST['SuaSanPham']))
					{
						$idDM = $_POST['idDM'];
						$nameSP = $_POST['nameDM'];
						$title = $_POST['title'];
						$summary = $_POST['summary'];
						$pathname = $_POST['id_name_gel'];
						$navigation= $_POST['navigation'];
						$anhdaidien_old = $_POST['old_image'];
						$anhnen_old = $_POST['old_background'];
						$target1 = "view/images/idn_images/".basename($_FILES['anhdaidien']['name']);
						$image1 = $_FILES['anhdaidien']['name'];
						$target2 = "view/images/idn_images/".basename($_FILES['anhnen']['name']);
						$image2 = $_FILES['anhnen']['name'];
							
						$tblTable="generation";
						echo '   ','Anh dai dien: ', $image1,'     ','Anh dai dien cu: ' ,$anhdaidien_old,'   ','Anh nen', $image2,'      ','Anh nen cu:', $anhnen_old;
						if($image1 == '' && $image2=='')
						{
							echo 'Avatar 1 back 1';
									if(	$db->UpdategenerationKhongAnh($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable))
							{
								
								$tblTable  = "generation";
								$data = $db->getAllData($tblTable);
								require_once('view/admin/ListGeneral.php');
								return;
									
							}
						}
						else
						{
							if($image1 != '' && $image2!='')
							{
								echo 'Avatar 0 back 0 ';
								
										if(	$db->UpdategenerationAll($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable))
								{
									if(move_uploaded_file($_FILES['anhdaidien']['tmp_name'],$target1))
									{
										if(move_uploaded_file($_FILES['anhnen']['tmp_name'],$target2))
										{
											$tblTable  = "generation";
											$data = $db->getAllData($tblTable);
											require_once('view/admin/ListGeneral.php');
											return;
										}
									}
									else
									{
										$smg="upload không thành công";
									}
								}
							}
							else
							{
								if($image1 == '' && $image2 !='')
								{
									echo 'Avatar 1 back 0 ';
									
											if(	$db->UpdategenerationAnhNen($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable))
									{
										if(move_uploaded_file($_FILES['anhnen']['tmp_name'],$target2))
										{
										
											$tblTable  = "generation";
											$data = $db->getAllData($tblTable);
											require_once('view/admin/ListGeneral.php');
											return;
											
										}
										else
										{
											echo 'upload không thành công';
										}
									}
								}
								else
								{
									if($image1 != '' && $image2 =='')
									{
										echo 'Avatar 0 back 1 ';
										
												if(	$db->UpdategenerationAnhDaiDien($idDM,$nameSP,$title,$summary,$pathname,$navigation,$image1,$image2,$tblTable))
										{
											
												if(move_uploaded_file($_FILES['anhdaidien']['tmp_name'],$target1))
												{
													$tblTable  = "generation";
													$data = $db->getAllData($tblTable);
													require_once('view/admin/ListGeneral.php');
													return;
												}
												else
												{
													echo 'upload không thành công';
												}
										}
									}
								}
							}
						}
					}
					require_once('view/admin/editGeneration.php');
					return;
				}
				case 'editVideo':
				if(isset($_GET['id']))
					{
					$id = $_GET['id'];
					$col = 'Id';
					if (isset($_POST['EditVideoDemo']))
						{
							$idDM = $_POST['idDM'];
							$title = $_POST['title'];
							$link = $_POST['linkYoutube'];
							$source = $_POST['source'];
							
								
							$tblTable="videogeneral";
							if($db->UpdateVideoGeneral($id,$idDM,$title,$link,$source))
							{
								$tblTable  = "videogeneral";
								$dataImage = $db->getAllData($tblTable);
								require_once('view/admin/ListVideoDemo.php');
							}
							return;
						}
					$tblTable  = "videogeneral";
					$dataVideo = $db->GetRow($col,$id,$tblTable);
					require_once('view/admin/editVideoDemo.php');
					return;
				}
				break;
				case 'editNews':
				if(isset($_GET['id']))
					{
					$id = $_GET['id'];
					$col = 'id';
					if (isset($_POST['CapNhatNews']))
						{
							$title = $_POST['title'];
							$timenews = $_POST['timenews'];
							$address = $_POST['addressnews'];
							$summary = $_POST['summary'];
							$content = $_POST['content'];
							$showhome = $_POST['showhome'];
							$shownews = $_POST['shownews'];
						     
						    $target1 = "view/images/idn_images/".basename($_FILES['anhdaidien']['name']);
							$image1 = $_FILES['anhdaidien']['name'];
							
								
							$tblTable="news";
							if($db->updateNews($id,$title,$timenews,$address,$summary,$content,$showhome,$shownews,$image1))
							{
								if($image1!='')
								{
									if(move_uploaded_file($_FILES['anhdaidien']['tmp_name'],$target1))
									{
											$data = $db->getAllData($tblTable);
											require_once('view/admin/ListNews.php');
											return;
									}
								}
								else
								{
									$data = $db->getAllData($tblTable);
									  require_once('view/admin/ListNews.php');
									  return;
								}
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
					$tblTable  = "news";
					$data = $db->GetRow($col,$id,$tblTable);
					require_once('view/admin/editNews.php');
					return;
				}
				break;
					case 'editDocument':
					if(isset($_GET['id']))
					{
					$id = $_GET['id'];
					$col = 'id';
					if (isset($_POST['CapNhatTaiLieu']))
						{
							$idDM = $_POST['idDM'];
							$idSP = $_POST['idSP'];
							$title = $_POST['title'];
						//	$target2 = "view/document/".basename($_FILES['tailieu']['name']);
						//	$tailieu2 = $_FILES['tailieu']['name'];
							$tailieu2 = $_POST['file'];
								
							$tblTable="document";
						//	if($tailieu2 != '')
						//	{
							if($db->UpdatetTaiLieu($id,$title,$tailieu2))
							{
								//	if(move_uploaded_file($_FILES['tailieu']['tmp_name'],$target2))
								//	{
										$tblTable  = "document";
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListDocument.php');
										return;
								//	}
							}
					//	}
						//	else
						//	{
							//	$db->UpdatetTaiLieuKhongTaiLieu($id,$title,$tailieu2);
							//}
						}
						$tblTable  = "document";
					$data = $db->GetRow($col,$id,$tblTable);
					require_once('view/admin/editDocument.php');
					return;
				}
				break;

				case 'editDownload':
				if(isset($_GET['id']))
				{
					 $col = 'id';
					   $id = $_GET['id'];
					if (isset($_POST['CapNhatDownload']))
					{
					      
							$title = $_POST['title'];
							$target1 = "view/images/idn_images/".basename($_FILES['anhmoi']['name']);
							$image1 = $_FILES['anhmoi']['name'];
							$tailieu1 = $_POST['file1'];
							$tailieu2 = $_POST['file2'];
							$tailieu3 = $_POST['file3'];
							$tailieu4 = $_POST['file4'];
							$tailieu5 = $_POST['file5'];
							$tailieu6 = $_POST['file6'];
							$tailieu7 = $_POST['file7'];
							$tailieu8 = $_POST['file8'];
							$tailieu9 = $_POST['file9'];
							$tailieu10 = $_POST['file10'];

							$titlelink1 = $_POST['titlelink1'];
							$titlelink2 = $_POST['titlelink2'];
							$titlelink3 = $_POST['titlelink3'];
							$titlelink4 = $_POST['titlelink4'];
							$titlelink5 = $_POST['titlelink5'];
							$titlelink6 = $_POST['titlelink6'];
							$titlelink7 = $_POST['titlelink7'];
							$titlelink8 = $_POST['titlelink8'];
							$titlelink9 = $_POST['titlelink9'];
							$titlelink10 = $_POST['titlelink10'];
							
								
							$tblTable="download";
							if($db->UpdateDownload($id,$title,$image1,$tailieu1,$tailieu2,$tailieu3,$tailieu4,$tailieu5,$tailieu6,$tailieu7,$tailieu8,$tailieu9,$tailieu10,$titlelink1,$titlelink2,$titlelink3,$titlelink4,$titlelink5,$titlelink6,$titlelink7,$titlelink8,$titlelink9,$titlelink10))
							{
								if($image1!='')
								{
									if(move_uploaded_file($_FILES['anhmoi']['tmp_name'],$target1))
									{
								$data = $db->getAllData($tblTable);
										require_once('view/admin/ListDownload.php');
										return;
									}
								}
								else
								{
								
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListDownload.php');
										return;
									}
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
						$tblTable  = "download";
					$data = $db->GetRow($col,$id,$tblTable);
					require_once('view/admin/editDownload.php');
					return;
				}
				break;
				case 'editTutorials':
				if(isset($_GET['id']))
				{
					 $col = 'id';
					   $id = $_GET['id'];
					if (isset($_POST['CapNhatTurorials']))
						{
							$title = $_POST['title'];
							$link = $_POST['link'];
							$source = $_POST['source'];
						
							
								
							$tblTable="tutorials";
							if($db->updateTutorials($id,$title,$link,$source))
							{
								
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListTutorials.php');
										return;
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
						$tblTable  = "tutorials";
					$data = $db->GetRow($col,$id,$tblTable);
					require_once('view/admin/editTutorials.php');
					return;
				}
				break;
				case 'editContact':
				if(isset($_GET['id']))
				{
					 $col = 'id';
					   $id = $_GET['id'];
					if (isset($_POST['CapNhatContact']))
						{
							
							$name = $_POST['name'];
							$des = $_POST['description'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhmoi']['name']);
							$tailieu2 = $_FILES['anhmoi']['name'];
						    $pos = $_POST['chucvu'];
						
							
								
							$tblTable="contact";
							if($db->updateContact($id,$name,$pos,$des,$tailieu2))
							{
								if($tailieu2 != '')
								{
									move_uploaded_file($_FILES['anhmoi']['tmp_name'],$target2);
								}
								
								$data = $db->getAllData($tblTable);
								require_once('view/admin/ListContact.php');
								return;
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
						
						$tblTable  = "contact";
					$data = $db->GetRow($col,$id,$tblTable);
					require_once('view/admin/editContact.php');
					return;
				}
				break;

				case 'editAccessories':
				if(isset($_GET['id']))
				{
					 $col = 'id';
					   $id = $_GET['id'];
					if (isset($_POST['CapNhatPhuKien']))
						{
							
							$dong = $_POST['dongSP'];
							$tenSP = $_POST['tenSP'];
							$summary = $_POST['summary'];
							$giaban = $_POST['price'];
							$mota=$_POST['noidungmota'];
							$kythuat=$_POST['noidungkythuat'];
							$anhdaidien= $_FILES['anhdaidiensanpham']['name'];
							$maanhthunho=$_POST['maanhthunho'];
							$target2 = "view/images/idn_images/".basename($_FILES['anhdaidiensanpham']['name']);
							$image2 = $_FILES['anhdaidiensanpham']['name'];
							
							$tblTable="accessories";
							if(	$db->UpdateAccessories($id,$dong,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable))
							{
								if($anhdaidien!='')
								{
									if(move_uploaded_file($_FILES['anhdaidiensanpham']['tmp_name'],$target2))
									{
									
										$tblTable  = "accessories";
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListAccessories.php');
										return;
									
									}
									else
									{
										echo "KHong thanh cong";
									}
								}
								else
								{
										$tblTable  = "accessories";
										$data = $db->getAllData($tblTable);
										require_once('view/admin/ListAccessories.php');
										return;
								}
							}
						}
						if (isset($_POST['CapNhatAnhCon']))
						{
							$target2 = "view/images/idn_images/".basename($_FILES['anhcon']['name']);
							$image2 = $_FILES['anhcon']['name'];
						
							
								
							$tblTable="imageaccessories";
							if($db->insertAnhCon($id,$image2))
							{
								if(move_uploaded_file($_FILES['anhcon']['tmp_name'],$target2))
									{
											$tblTable="imageaccessories";
											$dataImage = $db->getDataByColumn($tblTable,$id,'idSP');
											$tblTable  = "accessories";
											$dataAcc = $db->GetRow($col,$id,$tblTable);
											require_once('view/admin/editAccessories.php');
											return;
									}
							}
							else
							{
								echo 'Khong thanh cong';
							}
						}
					$tblTable="imageaccessories";
					$dataImage = $db->getDataByColumn($tblTable,$id,'idSP');
					$tblTable  = "accessories";
					$dataAcc = $db->GetRow($col,$id,$tblTable);
					require_once('view/admin/editAccessories.php');
					return;
				}
				break;

				case 'editProduct':
						if(isset($_GET['idD']))
						{
							if(isset($_GET['idS']))
							{
									$idDong = $_GET['idD'];
									$idProduct = $_GET['idS'];
									$tblTable = 'products';
									$colName1 = 'idDM';
									$colname2='idSP';
									
								if (isset($_POST['UpdateSanPhamChiTiet']))
									{
										$dong = $_POST['dongSP'];
										$maSP = $_POST['maSP'];
										$tenSP = $_POST['tenSP'];
										$summary = $_POST['summary'];
										$giaban = $_POST['price'];
										$mota=$_POST['noidungmota'];
										$kythuat=$_POST['noidungkythuat'];
										$anhdaidien= $_FILES['anhdaidiensanpham']['name'];
										$maanhthunho=$_POST['maanhthunho'];
										$target2 = "view/images/idn_images/".basename($_FILES['anhdaidiensanpham']['name']);
										$image2 = $_FILES['anhdaidiensanpham']['name'];
							
											$tblTable="products";

											if($image2 != '')
											{
												if($db->UpdateAllProducts($dong,$maSP,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable))
												{
													if(move_uploaded_file($_FILES['anhdaidiensanpham']['tmp_name'],$target2))
														{
															   $tblTable="products";
																$data = $db->getAllData($tblTable);
															require_once('view/admin/listSanPhamDongRobot.php');
															return;
											
														}
												}
											}
											else
											{
												$db->UpdateNoImageProducts($dong,$maSP,$tenSP,$summary,$giaban,$mota,$kythuat,$anhdaidien,$maanhthunho,$tblTable);
												  $tblTable="products";
																$data = $db->getAllData($tblTable);
															require_once('view/admin/listSanPhamDongRobot.php');
															return;

											}
								}
			
								$data = $db->GetRowBy2Col($colName1,$idDong,$colname2,$idProduct,$tblTable);
								require_once('view/admin/editProduct.php');
								return;
									
							}
						}
				break;
				default:
					# code...
					break;
			}
			
			
		}
		require_once('view/admin/homeAdmin.php');
		return;
	}
}
//default: home
$tblTable  = "generation";
$data = $db->getAllData($tblTable);
$tblTable  = "videogeneral";
$datavideo = $db->getAllData($tblTable);
$tblTable  = "coverimage";
$datacoverimage = $db->getAllData($tblTable);
$tblTable  = "news";
$datanews = $db->GetHomenew($tblTable);
require_once('view/home.php');