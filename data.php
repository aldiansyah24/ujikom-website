<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "sepedadb");
$result = mysqli_query($koneksi, "SELECT * FROM mobil");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventaris Mobil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: rgb(255, 167, 35);
            --bg: #f8f9fa;
            --text: #2b2d42;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* Container Header agar judul di kiri, tombol di kanan */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Bungkus tombol agar berjajar di kanan */
        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        h2 { margin: 0; font-weight: 600; color: var(--text); font-size: 24px; }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-tambah { background-color: var(--primary); color: white; }
        .btn-tambah:hover { background-color: var(--secondary); transform: translateY(-2px); }

        /* Style Tombol Logout */
        .btn-logout { 
            background-color: #fff1f2; 
            color: var(--danger); 
            border: 1px solid #ffe4e6; 
        }
        .btn-logout:hover { 
            background-color: var(--danger); 
            color: white; 
            box-shadow: 0 5px 15px rgba(247, 37, 133, 0.2);
        }

        .btn-edit { background-color: #fffbeb; color: var(--warning); border: 1px solid #fef3c7; margin-right: 5px; }
        .btn-edit:hover { background-color: var(--warning); color: white; }

        .btn-hapus { background-color: #fff1f2; color: var(--danger); border: 1px solid #ffe4e6; }
        .btn-hapus:hover { background-color: var(--danger); color: white; }

        table { width: 100%; border-collapse: collapse; border-radius: 12px; overflow: hidden; }
        thead { background-color: #f1f5f9; }
        th { text-align: left; padding: 16px; color: #64748b; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; }
        td { padding: 16px; border-bottom: 1px solid #f1f5f9; font-size: 15px; }
        tr:hover { background-color: #fcfcfd; }

        .badge-warna { background: #e0e7ff; color: #4338ca; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: capitalize; }
        .cc-text { color: #64748b; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2><i class="fa-solid fa-car-side" style="color: var(--primary);"></i> Inventaris Mobil</h2>
        
        <div class="header-actions">
            <a href="tambah.php" class="btn btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Mobil
            </a>
            <a href="logout.php" class="btn btn-logout" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Merk Kendaraan</th>
                <th>Kapasitas Mesin</th>
                <th>Tahun</th>
                <th>Warna</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td style="font-weight: 600;"><?php echo ucwords($row['merk']); ?></td>
                    <td><span class="cc-text"><?php echo number_format($row['cc']); ?></span> <small>CC</small></td>
                    <td><?php echo $row['tahun']; ?></td>
                    <td><span class="badge-warna"><?php echo $row['warna']; ?></span></td>
                    <td style="text-align: center;">
                        <a href="edit.php?merk=<?php echo urlencode($row['merk']); ?>" 
                           class="btn btn-edit" title="Edit Data">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <a href="hapus.php?merk=<?php echo urlencode($row['merk']); ?>" 
                           class="btn btn-hapus" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus Data">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <i class="fa-solid fa-folder-open" style="font-size: 40px; display: block; margin-bottom: 10px;"></i>
                        Belum ada data tersedia.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>