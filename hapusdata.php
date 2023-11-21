<?php
include "koneksi.php";

if (isset($_GET["del"]))

$del=$_GET["del"];

$sql="DELETE FROM mahasiswa WHERE nim='$del'";
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