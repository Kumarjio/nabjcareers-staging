<?php
include_once("fckeditor/fckeditor.php") ;
?>
<html>
<head>
  <title>FCKeditor - Sample</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
  <form action="sampleposteddata.php" method="post" target="_blank">
<?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'http://192.168.0.1/system/ext/fckeditor/' ;
$oFCKeditor->Width = 200;
$oFCKeditor->Height = 200;
$oFCKeditor->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;


$oFCKeditor->Create() ;
?>
    <br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
