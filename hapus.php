<?php
$koneksi = mysqli_connect("localhost", "root", "", "sepedadb");

// Ambil data merk dari URL
if (isset($_GET['merk'])) {
    $merk = $_GET['merk'];

    // Query hapus berdasarkan merk
    $query = "DELETE FROM mobil WHERE merk = '$merk'";
    
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, balik lagi ke halaman utama
        header("Location: data.php");
        exit();
    } else {
        echo "Gagal menghapus: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada data yang dipilih, balik ke data.php
    header("Location: data.php");
    exit();
}
?>