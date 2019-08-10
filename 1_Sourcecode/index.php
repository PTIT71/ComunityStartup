<?php
//Connect database
include_once 'models/dbconfig.php';
$db = new Database;
$db->connect();



//Default: HOME
$tblMemberProject  = "memberProjects";
$dataMembers = $db->getAllData($tblMemberProject);
require_once('view/user/home.php');
?>