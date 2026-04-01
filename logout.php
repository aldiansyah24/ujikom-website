<?php
// 1. Mulai session agar script tahu session mana yang akan dihapus
session_start();

// 2. Hapus semua variabel session
$_SESSION = array();

// 3. Jika ingin benar-benar bersih, hapus cookie session di browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Hancurkan session
session_destroy();

// 5. Tampilkan pesan sukses dan arahkan kembali ke halaman login
echo "<script>
        alert('Anda telah berhasil logout.');
        window.location='login.php';
      </script>";
exit;
?>