<?php 
include 'koneksi.php'; 

// Ambil data pengarang dan kategori dari database
$query_pengarang = "SELECT * FROM pengarang";
$result_pengarang = mysqli_query($koneksi, $query_pengarang);

$query_kategori = "SELECT * FROM kategori";
$result_kategori = mysqli_query($koneksi, $query_kategori);

// Variabel untuk menyimpan pesan
$message = "";

// Menambah data buku
if (isset($_POST['submit_buku'])) {
    $judul = $_POST['judul'];
    $id_pengarang = $_POST['id_pengarang'];
    $id_kategori = $_POST['id_kategori'];
    $harga = $_POST['harga'];

    // Simpan data buku ke tabel buku
    $query_buku = "INSERT INTO buku (judul, id_pengarang, harga) VALUES ('$judul', '$id_pengarang', '$harga')";
    
    if (mysqli_query($koneksi, $query_buku)) {
        $id_buku = mysqli_insert_id($koneksi);

        // Simpan data kategori ke tabel kategori_buku
        $query_kategori_buku = "INSERT INTO kategori_buku (id_buku, id_kategori) VALUES ('$id_buku', '$id_kategori')";
        mysqli_query($koneksi, $query_kategori_buku);

        // Set pesan berhasil
        $message = "Data berhasil disimpan!";
    } else {
        $message = "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
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
        .message {
            margin-top: 10px;
            font-size: 1rem;
            color: #28a745; /* Hijau untuk pesan berhasil */
        }
        .message.error {
            color: #dc3545; /* Merah untuk pesan gagal */
        }
    </style>
</head>
<body>
    <header>Tambah Buku</header>

    <main>
        <!-- Form Tambah Buku -->
        <form action="" method="POST">
            <div>
                <label for="judul">Masukkan Judul Buku:</label>
                <input type="text" id="judul" name="judul" required>
            </div>
            <div>
                <label for="id_pengarang">Masukkan Pengarang:</label>
                <select name="id_pengarang" required>
                    <option value="">Pilih Pengarang</option>
                    <?php while ($p = mysqli_fetch_assoc($result_pengarang)): ?>
                        <option value="<?= $p['id_pengarang'] ?>"><?= $p['nama_pengarang'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="id_kategori">Masukan Kategori:</label>
                <select name="id_kategori" required>
                    <option value="">Pilih Kategori</option>
                    <?php while ($k = mysqli_fetch_assoc($result_kategori)): ?>
                        <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="harga">Masukkan Harga Buku:</label>
                <input type="number" id="harga" name="harga" required>
            </div>
            <button type="submit" name="submit_buku">Tambah Buku</button>
        </form>

        <!-- Tampilkan Pesan -->
        <?php if ($message): ?>
            <div class="message <?= strpos($message, 'Gagal') !== false ? 'error' : '' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Tombol Navigasi -->
        <form action="daftar.php">
            <button type="submit">Selanjutnya</button>
        </form>
        <form action="pengarang.php">
            <button type="submit">Sebelumnya</button>
        </form>
    </main>
</body>
</html>
