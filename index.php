<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Buku Kita</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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
            font-size: 2rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            min-height: calc(100vh - 80px);
        }

        .description {
            max-width: 600px;
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
            line-height: 1.0;
        }

        form {
            margin: 0 auto;
            padding: 10px;
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
            font-size: 1.1rem;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease-in-out;
        }

        form button:hover {
            background-color: #4682b4;
        }

        form button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(70, 130, 180, 0.7);
        }

        footer {
            background-color: #5a9bd3;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>PT Buku Kita</header>
    <main>
        <div class="description">
            Selamat datang di sistem warehouse PT Buku Kita. 
        </div>
        <div class="description">
             Klik tombol di bawah untuk mengelola.
        </div>
        <form action="kategori.php">
            <button type="submit">Manage</button>
        </form>
        <form action="daftar.php">
            <button type="submit">Daftar Buku</button>
        </form>
    </main>
    <footer>
        © 2024 PT Buku Kita. Kelompok PMM.
    </footer>
</body>
</html>
