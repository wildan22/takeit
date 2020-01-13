<?php
//koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$dbnm = "tugas2";
 
$connect = mysqli_connect($host, $user, $pass,$dbnm);
if ($connect) {

} else {
	die ("Server MySQL tidak terhubung karena ".mysql_error());
}
//akhir koneksi
?>