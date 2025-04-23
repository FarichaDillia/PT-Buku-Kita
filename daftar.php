<?php
include 'koneksi.php'; 

// Ambil data buku beserta pengarang dan kategorinya
$query = "SELECT b.id_buku, b.judul, a.nama_pengarang AS nama_pengarang, b.harga, k.nama_kategori AS nama_kategori
FROM buku b
JOIN pengarang a ON b.id_pengarang = a.id_pengarang
LEFT JOIN kategori_buku kb ON b.id_buku = kb.id_buku
LEFT JOIN kategori k ON kb.id_kategori = k.id_kategori";
$result = mysqli_query($koneksi, $query);

// Menghapus data buku
if (isset($_GET['hapus'])) {
    $id_buku = $_GET['hapus'];

    // Hapus data terkait di kategori_buku terlebih dahulu
    $query_hapus_kategori_buku = "DELETE FROM kategori_buku WHERE id_buku = '$id_buku'";
    mysqli_query($koneksi, $query_hapus_kategori_buku);

    // Hapus data di tabel buku
    $query_hapus_buku = "DELETE FROM buku WHERE id_buku = '$id_buku'";
    if (mysqli_query($koneksi, $query_hapus_buku)) {
        //echo "Data berhasil dihapus!";
    } else {
        //echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
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
    <header>Daftar Buku</header>
    <main>
        <table>
            <tr>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id_buku'] ?></td>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['nama_pengarang'] ?></td>
                        <td><?= $row['nama_kategori'] ? $row['nama_kategori'] : 'Tidak ada kategori' ?></td>
                        <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td>
                            <a href="?hapus=<?= $row['id_buku'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data buku.</td>
                </tr>
            <?php endif; ?>
        </table>
    </main>
    
    <!-- Tombol Kembali -->
    <form action="buku.php">
        <button type="submit">Sebelumnya</button>
    </form>
    <form action="index.php">
        <button type="submit">Selesai</button>
    </form>
</body>
</html>
