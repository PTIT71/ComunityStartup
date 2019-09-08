<?php
//Connect database
include_once 'models/dbconfig.php';
$db = new Database;
$db->connect();

//Default: HOME
$tblMemberProject  = "memberProjects";
$dataMembers = $db->getAllData($tblMemberProject);
$tblText_ABC = "Text_ABC";
$dataName = $db->getAllData($tblText_ABC);

if(isset($_GET['hoctap']))
{
	require_once('view/user/hoctap.php');
	return;
}
if(isset($_GET['admin']))
{
	require_once('view/user/adminTest.php');
	return;
}

require_once('view/user/home.php');

?>