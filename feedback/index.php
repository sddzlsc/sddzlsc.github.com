<?php 
ob_start();
session_start(); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="Copyright" content="www.wozaixianshang.com" />
<title>�������� �������</title>
<style type="text/css">
<!--
body,td,th {
	font-family: ����;
	font-size: 9pt;
	color: #222;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
	line-height:20px;
}
a:link {
	color: #222;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #222;
}
a:hover {
	text-decoration: underline;
	color: #FF0000;
}
a:active {
	text-decoration: none;
	color: #999999;
}
-->
</style>
<script>
    function del(id){
		if(confirm("ȷ��Ҫɾ����")){
			window.location='?id='+id;
			}
		}
</script>
<script language=javascript>
  function CheckPost()
 {

	if (myform.title.value.length<2)
	{
		alert("���ⲻ������2���ַ�");
		myform.title.focus();
		return false;
	}
	if (myform.name.value=="")
	{
		alert("�ǳƲ���Ϊ��");
		myform.name.focus();
		return false;
	}
	if (myform.content.value.length<10)
	{
		alert("���ݲ�������10���ַ�");
		myform.content.focus();
		return false;
	}
 }
</script>
<?php 
if($_POST['submit5']){
if($_POST['pwd']=="123"){
$_SESSION['pwd']=$_POST['pwd'];
echo "<script language=javascript>alert('��½�ɹ���');window.location='index.php'</script>";
}
  }
?>
<?php
	if($_GET['tj'] == 'logout'){
	session_start(); //����session
	session_destroy();  //ע��session
	header("location:index.php"); //��ת����ҳ
	}
?>
<?php
if($_GET["id"]<>''){
$id = $_GET["id"];
$info = file_get_contents("info.txt");
$column = explode("@@@",$info); unset($column[$id]);
$noinfo = implode("@@@",$column);
    file_put_contents("info.txt",$noinfo);
	echo "<script language=javascript>alert('ɾ���ɹ���');window.location='index.php'</script>";
}
?>
</head>
<body>
<form  name="myform" method="post" onsubmit="return CheckPost()" action="" style="margin-bottom:5px;">
<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td height="25" align="center" bgcolor="#EBEBEB"><a href="index.php">�鿴����</a>&nbsp;|&nbsp;<a href="index.php?tj=add">�������</a>&nbsp;|&nbsp;<a href="index.php?tj=login">���Թ���</a>&nbsp;|&nbsp;<?php if($_SESSION['pwd']<>''){
echo "<a href='index.php?tj=logout'>�˳�����</a>"; 
}?></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>

<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
<tr>
<th width="60" bgcolor="#EBEBEB">���Ա���</th>
<th width="76" bgcolor="#EBEBEB">���Ա���</th>
<th width="77" bgcolor="#EBEBEB">�����ǳ�</th>
<th width="133" bgcolor="#EBEBEB">��������</th>
<th width="78" bgcolor="#EBEBEB">����ʱ��</th>
<?php if($_SESSION['pwd']<>''){
echo "<th width='59' bgcolor='#EBEBEB'>����</th>";
}?>
</tr>
<?php
$info = file_get_contents("info.txt");
$info = rtrim($info,"@");
if(strlen($info)>10){
$column = explode("@@@",$info);
foreach($column as $keys=>$values){
$message = explode("%%",$values);
?>
<tr>
<td align="center" bgcolor="#FFFFFF"><img src="face/PIC<?php echo $message[2];?>.GIF" width="20" height="20" /></th>
<td align="center" bgcolor="#FFFFFF"><?php echo $message[0];?>
    </th>
</td>
<td align="center" bgcolor="#FFFFFF"><?php echo $message[1];?></th>
<td align="center" bgcolor="#FFFFFF"><?php echo $message[3];?></th>
<td align="center" bgcolor="#FFFFFF"><?php echo date("m/d H:i",$message[4]);?></th>
<?php if($_SESSION['pwd']<>''){
echo "<td align='center' bgcolor='#FFFFFF'>";
echo "<a href='javascript:del({$keys})'>ɾ��</a>"; 
echo "</th>";
}?>
</tr>
<?php
	}
}
?>
</table>

<?php 
if($_GET["tj"] == add){
?>
<?php
if($_POST[submit]){
$title = $_POST["title"];
$name = $_POST["name"];
$face = $_POST["face"];
$content = $_POST["content"];
$addtime = time();
$insert = "{$title}%%{$name}%%{$face}%%{$content}%%{$addtime}@@@";
$content = file_get_contents("info.txt");
           file_put_contents("info.txt",$content.$insert);
		   echo "<script language=javascript>alert('���Գɹ���');window.location='index.php'</script>";
	}
?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="5"></td>
    </tr>
  </table>
  <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3" brder="1">
<tr>
    <td width="62" align="center" bgcolor="#FFFFFF">���Ա��⣺</td>
    <td width="465" bgcolor="#FFFFFF"><input type="text" name="title"/>
      &nbsp;*</td>
</tr>
<tr>
     <td align="center" bgcolor="#FFFFFF">�����ǳƣ�</td>
     <td bgcolor="#FFFFFF"><input name="name" type="text" id="name"/> 
       &nbsp;*</td>    
</tr>
<tr>
  <td align="center" bgcolor="#FFFFFF">���ѱ��飺</td>
  <td bgcolor="#FFFFFF"><input type="radio" value="1" name="face" checked="checked" />
                            <img src="face/PIC1.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="2" name="face" />
                            <img src="face/PIC2.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="3" name="face" />
                            <img src="face/PIC3.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="4" name="face" />
                            <img src="face/PIC4.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="5" name="face" />
                            <img src="face/PIC5.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="6" name="face" />
                            <img src="face/PIC6.GIF" width="20" height="20" border="0" />
                            <input type="radio" value="7" name="face" />
                            <img src="face/PIC7.GIF" width="20" height="20" border="0" /></td>
</tr>
<tr>
     <td align="center" bgcolor="#FFFFFF">�������ݣ�</td>
     <td bgcolor="#FFFFFF"><textarea name="content" rows="5" cols="40"></textarea>
      &nbsp;��������10���ַ�</td>
</tr>
<tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF">
        <input name="submit" type="submit"value="�ύ" />&nbsp;&nbsp; 
        <input name="reset" type="reset"  value="����"/>      </td>
    </tr>
</table>
</form>
<?php 
	}
?>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>
<?php if($_GET['tj'] == 'login'){ ?>
<form  name="form" method="post" action="" style=" margin-top:5px;">
 <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td colspan="3" align="center" bgcolor="#EBEBEB" class="font">��̨����ҳ</td>
    </tr>
  <tr>
    <td width="89" align="center" bgcolor="#FFFFFF" class="font">��������:</td>
    <td colspan="2" bgcolor="#FFFFFF" class="font">
      <input name="pwd" type="text" id="pwd" size="16"/></td>
    </tr>
    <tr>
    <td colspan="3" align="center" valign="top" bgcolor="#FFFFFF" class="font">
    <input type="submit" name="submit5" value="��¼" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="reset"  value="����" /></td>
    </tr>
</table>
</form>
<?php } ?>
<table width="550" height="20" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td align="left" bgcolor="#FFFFFF">&nbsp;Copyright @2013 <a href="http://www.wozaixianshang.com" target="_blank"><!--��Դ����ѿ�Դ��������Ȩ��Ϣ�㽫��ñ�վ��Ѽ���֧�ֺͳ�����������-->��������</a> All Rights Reserved.</td>
  </tr>
</table>
</body>
</html>