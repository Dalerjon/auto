<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
 
 <meta name="author" content="Muhamedov Daler" />
 <meta name="robots" content="all" />
 <LINK rel="stylesheet" media="screen" type="text/css" title="Style" href="css/style.css">
 

<?php
        
          if    (empty($_SESSION[login])) 
          {
          exit ("������ �� ���    �������� �������� ������ ������������������ �������������. ���� ��    ����������������, �� ������� �� ���� ��� ����� ������� � �������<br><a    href='index.php'>�������    ��������</a>");
          }
          
unset($_SESSION['password']);
            unset($_SESSION['login']); 
            unset($_SESSION['id']);//    ���������� ���������� � �������
        exit("<meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
            // ���������� ������������ �� ������� ��������.
?>

