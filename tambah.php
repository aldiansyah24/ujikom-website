<?php
session_start();
// Proteksi: Jika belum login, tendang ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "sepedadb";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Logika Insert
if (isset($_POST['submit'])) {
    $merk  = mysqli_real_escape_string($koneksi, $_POST['merk']);
    $cc    = mysqli_real_escape_string($koneksi, $_POST['cc']);
    $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $warna = mysqli_real_escape_string($koneksi, $_POST['warna']);

    $sql = "INSERT INTO mobil (merk, cc, tahun, warna) VALUES ('$merk', '$cc', '$tahun', '$warna')";
    
    if (mysqli_query($koneksi, $sql)) {
        header("Location: data.php");
        exit();
    } else {
        echo "<script>alert('Gagal menambah data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --bg: #f8f9fa;
            --text: #2b2d42;
            --light-text: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            max-width: 450px;
            width: 100%;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .header-tambah {
            margin-bottom: 30px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 15px;
            text-align: center;
        }

        h2 {
            margin: 0;
            font-weight: 600;
            font-size: 22px;
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 13px;
            font-weight: 600;
            color: var(--light-text);
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin-top: 8px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
            font-family: inherit;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        }

        .btn-group {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        button {
            padding: 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            border: none;
            transition: 0.3s;
            background-color: var(--primary);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        button:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .back {
            display: block;
            text-align: center;
            padding: 10px;
            color: var(--light-text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
        }

        .back:hover {
            color: var(--text);
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header-tambah">
        <h2><i class="fa-solid fa-folder-plus" style="color: var(--primary);"></i> Tambah Mobil</h2>
        <p style="color: var(--light-text); font-size: 14px; margin-top: 5px;">Input detail kendaraan ke database</p>
    </div>

    <form action="" method="POST">
        <label>Merk Kendaraan</label>
        <input type="text" name="merk" placeholder="Contoh: Honda Civic" required autocomplete="off">

        <label>Kapasitas Mesin (CC)</label>
        <input type="number" name="cc" placeholder="Contoh: 1500" required>

        <label>Tahun Produksi</label>
        <input type="number" name="tahun" placeholder="Contoh: 2024" required>

        <label>Warna Mobil</label>
        <input type="text" name="warna" placeholder="Contoh: Putih Mutiara" required>

        <div class="btn-group">
            <button type="submit" name="submit">
                <i class="fa-solid fa-save"></i> Simpan ke Database
            </button>
            <a href="data.php" class="back">Batal & Kembali</a>
        </div>
    </form>
</div>

</body>
</html>