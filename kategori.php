<?php
include 'koneksi.php';

// Menambah kategori
if (isset($_POST['submit'])) {
    $nama_kategori = $_POST['nama_kategori'];

    $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
    
   if (mysqli_query($koneksi, $query)) {
        //echo "Data berhasil disimpan";
    } else {
        //echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}

//Hapus data kategori
if (isset($_GET['hapus'])) {
    $id_kategori = $_GET['hapus']; // Ambil id_kategori dari URL

    // Hapus data di tabel kategori_buku terlebih dahulu
    $query = "DELETE FROM kategori_buku WHERE id_kategori = '$id_kategori'";
    mysqli_query($koneksi, $query);

    // Kemudian hapus data di tabel kategori
    $query = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
    mysqli_query($koneksi, $query);

if (mysqli_query($koneksi, $query)) {
    //echo "Data berhasil dihapus!";
} else {
    //echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
}

// Mendapatkan data kategori
$query = "SELECT * FROM kategori";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
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
</head>
<body>
    <header>Kategori</header>

    <!-- Form Tambah Kategori -->
    <form action="" method="POST">
        <div>
            <label for="nama_kategori">Masukkan Kategori:</label>
            <input type="text" id="nama_kategori" name="nama_kategori" required>
        </div>
        <button type="submit" name="submit">Tambah Kategori</button>
    </form>

      <!-- Tabel Kategori -->
      <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
               <th>Id Kategori</th>
               <th>Nama Kategori</th>
               <th>Hapus</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['id_kategori'] . "</td>
                    <td>" . $row['nama_kategori'] . "</td>
                    <td>
                    <a href='?hapus=" . $row['id_kategori'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data.";
    }
    ?>

    <!-- Tombol Navigasi -->
        <form action="pengarang.php">
            <button type="submit">Selanjutnya</button>
        </form>
        <form action="index.php">
            <button type="submit">Sebelumnya</button>
        </form>
</body>
</html>
