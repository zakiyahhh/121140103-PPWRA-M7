<?php
session_start();
include "koneksi.php";

$filterProdi = isset($_GET['prodi']) ? $_GET['prodi'] : null;

$sql = "SELECT * FROM mahasiswa";

if ($filterProdi !== null) {
    $sql .= " WHERE prodi = '$filterProdi'";
}

$result = mysqli_query($conn, $sql);

$dataArray = [];

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dataObject = [
                'nim' => $row["nim"],
                'nama' => $row["nama"],
                'prodi' => $row["prodi"]
            ];
            $dataArray[] = $dataObject;
        }
        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit();  // Add this line to stop execution
    } else {
        header('Content-Type: application/json');
        echo json_encode($dataArray);
        exit();  // Add this line to stop execution
    }
} else {
    echo "Data Gagal diambil " . mysqli_error($conn);
    header("Location: index.php");
    exit();
}
?>