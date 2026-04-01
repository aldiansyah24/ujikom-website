<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "sepedadb");

// 1. Ambil merk dari URL (Parameter GET)
if (!isset($_GET['merk'])) {
    header("Location: data.php");
    exit;
}

$merk_id = mysqli_real_escape_string($koneksi, $_GET['merk']);

// 2. Cari data mobil berdasarkan merk tersebut
$query = mysqli_query($koneksi, "SELECT * FROM mobil WHERE merk = '$merk_id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='data.php';</script>";
    exit;
}

// 3. Proses Update saat tombol 'Simpan Perubahan' diklik
if (isset($_POST['update'])) {
    $merk_baru = mysqli_real_escape_string($koneksi, $_POST['merk']);
    $cc        = mysqli_real_escape_string($koneksi, $_POST['cc']);
    $tahun     = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $warna     = mysqli_real_escape_string($koneksi, $_POST['warna']);

    // Query Update
    $sql = "UPDATE mobil SET 
            merk = '$merk_baru', 
            cc = '$cc', 
            tahun = '$tahun', 
            warna = '$warna' 
            WHERE merk = '$merk_id'";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diubah!'); window.location='data.php';</script>";
        exit;
    } else {
        echo "Gagal mengupdate: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mobil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .edit-box { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 100%; max-width: 400px; }
        h3 { margin-top: 0; color: #2b2d42; display: flex; align-items: center; gap: 10px; }
        label { display: block; margin-top: 15px; font-size: 13px; font-weight: 600; color: #64748b; }
        input { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; transition: 0.3s; }
        input:focus { border-color: #4361ee; outline: none; box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1); }
        .btn-update { width: 100%; padding: 13px; background: #f72585; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; margin-top: 25px; transition: 0.3s; }
        .btn-update:hover { background: #d97706; transform: translateY(-1px); }
        .btn-batal { display: block; text-align: center; margin-top: 15px; color: #94a3b8; text-decoration: none; font-size: 14px; }
        .btn-batal:hover { color: #64748b; }
    </style>
</head>
<body>

<div class="edit-box">
    <h3><i class="fa-solid fa-pen-to-square" style="color: #f59e0b;"></i> Edit Mobil</h3>
    <form action="" method="POST">
        <label>Merk Kendaraan</label>
        <input type="text" name="merk" value="<?php echo $data['merk']; ?>" required>

        <label>Kapasitas (CC)</label>
        <input type="number" name="cc" value="<?php echo $data['cc']; ?>" required>

        <label>Tahun Produksi</label>
        <input type="number" name="tahun" value="<?php echo $data['tahun']; ?>" required>

        <label>Warna Mobil</label>
        <input type="text" name="warna" value="<?php echo $data['warna']; ?>" required>

        <button type="submit" name="update" class="btn-update">Simpan Perubahan</button>
    </form>
    <a href="data.php" class="btn-batal">Batal dan Kembali</a>
</div>

</body>
</html>