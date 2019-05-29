<?php
require_once "../class/quantritin.php";
$qt = new quantritin;
$qt-> checkLogin ();

$idTin = $_GET['idTin']; settype($idTin,"int");
$kq = $qt->Tin_Xoa($idTin);
header("location:index.php?p=tin_ds");
