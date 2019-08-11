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

require_once('view/user/home.php');

?>