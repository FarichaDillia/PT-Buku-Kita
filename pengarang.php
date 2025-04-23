<?php
include 'koneksi.php';

// Menambah pengarang
if (isset($_POST['submit'])) {
    $nama_pengarang = $_POST['nama_pengarang'];

    $query = "INSERT INTO pengarang (nama_pengarang) VALUES ('$nama_pengarang')";
    
    if (mysqli_query($koneksi, $query)) {
        //echo "Data berhasil disimpan";
    } else {
        //echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}

// Menghapus pengarang
if (isset($_GET['hapus'])) {
    $id_pengarang = $_GET['hapus']; 
    $query = "DELETE FROM pengarang WHERE id_pengarang = '$id_pengarang'";

    if (mysqli_query($koneksi, $query)) {
        //echo "Data berhasil dihapus!";
    } else {
        //echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}

// Mendapatkan data pengarang
$query = "SELECT * FROM pengarang";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengarang</title>
</head>
<style>
         body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }
        header {
            background-color: #5a9bd3;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        main {
            padding: 20px;
            text-align: center;
        }
        form {
            margin: 0 auto;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 300px;
        }
        form button {
            background-color: #5a9bd3;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #4682b4;
        }
        form button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(70, 130, 180, 0.7);
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        table {
            margin: 20px auto;
            width: 90%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table th {
            background-color: #4682b4;
            color: #fff;
            padding: 10px;
        }
        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            color: #4682b4;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
<body>
    <header>Pengarang</header>

        <!-- Form Tambah Pengarang -->
        <form action="" method="POST">
        <div>
            <label for="judul">Masukkan Nama Pengarang:</label>
            <input type="text" id="nama_pengarang" name="nama_pengarang" required>
        </div>
        <button type="submit" name="submit">Tambah Pengarang</button>
    </form>

    <!-- Tabel Pengarang -->
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
            <th>Id Pengarang</th>
            <th>Nama Pengarang</th>
               <th>Hapus</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['id_pengarang'] . "</td>
                    <td>" . $row['nama_pengarang'] . "</td>
                    <td>
                    <a href='?hapus=" . $row['id_pengarang'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data.";
    }
    ?>

    <!-- Tombol Navigasi -->
    <form action="buku.php">
            <button type="submit">Selanjutnya</button>
        </form>
    <form action="kategori.php">
            <button type="submit">Sebelumnya</button>
        </form>
</body>
</html>
