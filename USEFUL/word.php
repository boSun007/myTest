<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ļ��ϴ�</title>
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="filename" />
  <input type="submit" name ="submit" value="submit"/>
  </form>
</body>
</html>

<?php
if(isset($_POST['submit']) && $_POST['submit']!=""){
$abc = new ADODB.Connection();
  $conn = @new COM($abc);
  $connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath("person.mdb");
  $conn->Open($connstr);
  $uploaddir = 'uploads/';
  if(!is_dir($uploaddir)){
    mkdir($uploaddir);
  }
  $filename =$_FILES['filename']['name'];
  $filename =substr($_FILES['filename']["name"],0,strpos($_FILES['filename']["name"],"."));
  echo $filename;
  echo "<br>";
  $uploadfile = $uploaddir.$filename.substr($_FILES['filename']["name"],strpos($_FILES['filename']["name"],"."));
  //Ŀ¼��.�ļ���.��׺��
  echo $uploadfile;
  echo "<br>";
  $temploadfile = $_FILES['filename']['tmp_name'];
  echo $temploadfile;
  echo "<br>";
  move_uploaded_file($temploadfile , $uploadfile); //�ƶ��ļ�
  $path = $_SERVER['SCRIPT_FILENAME'];
  $filepath = $_SERVER["PHP_SELF"];
  $path = substr($path,0,strpos($path,$filepath));
  echo $path;
  echo "<br>";
  echo $filepath;
  $htmlpath = $path."/shiyan4/".$uploadfile;
  echo "<br>";
  echo $htmlpath;
  word2html($htmlpath);
  //$query =@mysql_query( "Insert into $username(fname,file)values('$filename','$uploadfile')")or die("error");
   print( "Wordתhtml���!" );

}
 //http://tieba.baidu.com/f?kz=13975389
 function word2html($wfilepath)
 {
   $word=new COM("Word.Application") or die("�޷��� MS Word");
   $word->visible = 1 ; 
   $word->Documents->Open($wfilepath)or die("�޷�������ļ�");
   $htmlpath=substr($wfilepath,0,-4);
   $word->ActiveDocument->SaveAs($htmlpath,8);
   $word->quit(0);
 }
?>