<?php
header('Content-Type: text/html; charset=utf-8');
include('../config.php');

$error = "";
$msg = "";
$fileElementName = 'fileToUpload';
$pid=$_REQUEST['pid'];
$id=$_REQUEST['id'];
$type=$_REQUEST['type'];

$catalog = '../images/upload';
$to_db='images/upload';
$fname = time();
$path=$catalog.'/'.$fname;
if(!empty($_FILES[$fileElementName]['error']))
{
  switch($_FILES[$fileElementName]['error'])
  {
    case '1':
      $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
      break;
    case '2':
      $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
      break;
    case '3':
      $error = 'The uploaded file was only partially uploaded';
      break;
    case '4':
      $error = 'No file was uploaded.';
      break;

    case '6':
      $error = 'Missing a temporary folder';
      break;
    case '7':
      $error = 'Failed to write file to disk';
      break;
    case '8':
      $error = 'File upload stopped by extension';
      break;
    case '999':
    default:
      $error = 'No error code avaiable';
  }
} elseif (empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none'){
  $error = 'No file was uploaded..';
} else {
//for security reason, we force to remove all uploaded file
  $a=strstr($_FILES['fileToUpload']['name'], '.');
  $cp_path = $path.$a;
  $path2=$to_db.'/'.$fname.$a;
  if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$cp_path)){
    if ($id != 0){
      $dbh->query("UPDATE ve_photos SET path='$path2' WHERE id='$id'");
      $last_id=$id;
    }	else {
      $dbh->query("INSERT INTO ve_photos(pid,title,text,path,link,status,type) values('$pid','Новое ','','$path2','','1','$type')");
      $last_id=$dbh->query("SELECT * FROM ve_photos  ORDER BY id DESC")->fetch(PDO::FETCH_ASSOC)['id'];
    }
  } else {
    @unlink($_FILES['fileToUpload']);
    $error = 'Copy file ERROR! Deleteng temporary file!';
  }
  //
}
echo "{";
	echo				"id: '" . $id . "',\n";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $last_id . "'\n";
	echo "}";
?>
