<?php
session_start();
include "koneksi.php";

if (isset($_POST["nim"]) && isset($_POST["nama"]) && isset($_POST["prodi"]))

$nim=$_POST["nim"];
$nama=$_POST["nama"];
$prodi=$_POST["prodi"];

$sql="INSERT INTO mahasiswa (nim, nama, prodi)
VALUES ('$nim','$nama','$prodi');";
$result=mysqli_query($conn, $sql);

if ($result) {
    header("Location: index.php");
    exit();
} else {
    echo "Data Gagal Diinput " . mysqli_error($conn);
    header("Location: index.php");
    exit();
}
?>