<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1F4172;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        form {
            background-color: #FDF0F0;
            padding: 20px;
            border-radius: 8px;
            width: 515px;
            margin-top: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        input[type="submit"] {
            background-color: #192655;
            color: #fff;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #176B87;
        }

        .output {
            padding: 5px;
            border: 1px solid gray;
            border-radius: 10px;
            background-color: teal;
        }

        .hapus {
            background-color: #1F4172;
        }

        .hidden {
            display: none;
        }

        .menuu {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 500px;
            margin-top: 15px;
            padding: 30px;
            background-color: #FDF0F0;
            border-radius: 15px;
        }

        button {
            background-color: #9EDDFF;
            border-radius: 100px;
            color: black;
            cursor: pointer;
            display: inline-block;
            font-family: CerebriSans-Regular, -apple-system, system-ui, Roboto, sans-serif;
            padding: 7px 20px;
            text-align: center;
            text-decoration: none;
            transition: all 250ms;
            border: 0;
            font-size: 16px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        button:hover {
            background-color: #6499E9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #F78CA2;
            color: black;
        }

        td {
            background-color: #FDF0F0;
        }

        .tabel {
            width: 70%;
            overflow: auto;
            max-height: 400px; 
            margin: 20px;
            margin-top: 5px;
        }

        .pilprod {
            width: 550px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="menuu">
        <h2 style="margin:0px; margin-bottom:15px;">Data Mahasiswa</h2>
        <div style="display: flex; gap: 20px;">
            <button onclick="formTambah()">Tambah</button>
            <button onclick="formEdit()">Edit</button>
            <button onclick="formHapus()">Hapus</button>
        </div>
    </div>

    <form class="hidden tambah-data" action="tambahdata.php" method="post">
        <h2>Tambah Data</h2>
        <label for="nim">NIM:</label>
        <input type="text" name="nim" required>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <label for="prodi">Program Studi:</label>
        <select name="prodi" id="prodi">
            <option disabled selected>-- prodi --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Perencanaan Wilayah dan Kota">Perencanaan Wilayah dan Kota</option>
            <option value="Teknik Geomatika">Teknik Geomatika</option>
            <option value="Sains Data">Sains Data</option>
        </select>
        <input type="submit" value="Tambahkan">
    </form>

    <form class="hidden edit-data" action="editdata.php" method="post">
        <h2>Edit Data</h2>
        <label for="nim">NIM:</label>
        <input type="text" name="nim" required>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <label for="prodi">Program Studi:</label>
        <select name="prodi" id="prodi">
            <option disabled selected>-- prodi --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Perencanaan Wilayah dan Kota">Perencanaan Wilayah dan Kota</option>
            <option value="Teknik Geomatika">Teknik Geomatika</option>
            <option value="Sains Data">Sains Data</option>
        </select>
        <input type="submit" value="Edit">
    </form>

    <form class="hidden hapus-data" style="margin-bottom:50px;" action="hapusdata.php" method="get">
        <h2>Hapus Data</h2>
        <label for="del">Nim:</label>
        <input type="text" name="del" required>
        <input class="hapus" type="submit" value="Hapus">
    </form>

    <select class="pilprod" onchange="cariData()">
        <option value="">-- prodi --</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Perencanaan Wilayah dan Kota">Perencanaan Wilayah dan Kota</option>
            <option value="Teknik Geomatika">Teknik Geomatika</option>
            <option value="Sains Data">Sains Data</option>
    </select>

    <div class="tabel">
    <table>
        <thead>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
        </thead>
        <tbody class="tabel-body">
        </tbody>
    </table>
    <div>

    <script>
        let formActiveNow;
        cariData();

        function cariData() {
            const pilprod = document.querySelector('.pilprod').value;

            const fetchUrl = pilprod ? `caridata.php?prodi=${encodeURIComponent(pilprod)}` : 'caridata.php';

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    displayData(data);
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }

        function displayData(data) {
            const tabelBody = document.querySelector('.tabel-body');
            tabelBody.innerHTML = '';
            
            if(data.length!=0){
                data.forEach(row => {
                const tr = `<tr><td>${row.nim}</td><td>${row.nama}</td><td>${row.prodi}</td></tr>`
                tabelBody.innerHTML+=tr;
            });
            }else{
                tabelBody.innerHTML+=`<tr><td colspan="3">Data Tidak Ditemukan</td></tr>`
            }
            
        }

        function formTambah() {
            if (!formActiveNow) {
                document.querySelector(".tambah-data").classList.remove("hidden");
                formActiveNow = document.querySelector(".tambah-data");
            }
            else if (formActiveNow != document.querySelector(".tambah-data")) {
                document.querySelector(".tambah-data").classList.remove("hidden");
                formActiveNow.classList.add("hidden");
                formActiveNow = document.querySelector(".tambah-data");
            } else {
                formActiveNow.classList.add("hidden");
                formActiveNow = null;
            }
        }

        function formEdit() {
            if (!formActiveNow) {
                document.querySelector(".edit-data").classList.remove("hidden");
                formActiveNow = document.querySelector(".edit-data");
            }
            else if (formActiveNow != document.querySelector(".edit-data")) {
                document.querySelector(".edit-data").classList.remove("hidden");
                formActiveNow.classList.add("hidden");
                formActiveNow = document.querySelector(".edit-data");
            } else {
                formActiveNow.classList.add("hidden");
                formActiveNow = null;
            }
        }

        function formHapus() {
            if (!formActiveNow) {
                document.querySelector(".hapus-data").classList.remove("hidden");
                formActiveNow = document.querySelector(".hapus-data");
            }
            else if (formActiveNow != document.querySelector(".hapus-data")) {
                document.querySelector(".hapus-data").classList.remove("hidden");
                formActiveNow.classList.add("hidden");
                formActiveNow = document.querySelector(".hapus-data");
            } else {
                formActiveNow.classList.add("hidden");
                formActiveNow = null;
            }
        }
    </script>
</body>

</html>

<?php
if (isset($_SESSION["output1"]) || isset($_SESSION["output2"]) || isset($_SESSION["output3"])) {
    if (basename($_SERVER['PHP_SELF']) != $_SESSION["output1"] || basename($_SERVER['PHP_SELF']) != $_SESSION["output2"] || basename($_SERVER['PHP_SELF']) != $_SESSION["output3"]) {
        session_destroy();
    }
}
?>