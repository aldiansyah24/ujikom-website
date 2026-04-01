<?php
session_start();

// Jika tombol login diklik
if (isset($_POST['submit_login'])) {
    // Apapun yang kamu ketik di form
    $user_input = $_POST['username'];
    
    // JALUR PINTAS: Langsung berikan izin akses (Session)
    $_SESSION['login'] = true;
    $_SESSION['user'] = $user_input; // Nama ini akan muncul di dashboard nanti

    // Langsung pindah ke halaman data
    header("Location: data.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Praktis - Inventaris Mobil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --bg: #f8f9fa;
            --text: #2b2d42;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
        }

        .login-box { 
            background: white; 
            padding: 40px; 
            border-radius: 16px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); 
            width: 100%; 
            max-width: 380px; 
            text-align: center;
        }

        h2 { margin-bottom: 5px; color: var(--text); font-weight: 600; }
        p { color: #94a3b8; font-size: 14px; margin-bottom: 30px; }

        .input-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px; text-transform: uppercase; }
        
        input { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid #e2e8f0; 
            border-radius: 8px; 
            box-sizing: border-box; 
            font-size: 15px;
            transition: 0.3s; 
        }

        input:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1); }

        .btn-login { 
            width: 100%; 
            padding: 13px; 
            background: var(--primary); 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 16px;
            cursor: pointer; 
            margin-top: 10px; 
            transition: 0.3s; 
        }

        .btn-login:hover { background: #3f37c9; transform: translateY(-1px); }
        
        .footer-note { margin-top: 25px; font-size: 12px; color: #cbd5e1; }
    </style>
</head>
<body>

<div class="login-box">
    <i class="fa-solid fa-bolt" style="font-size: 40px; color: #f59e0b; margin-bottom: 15px;"></i>
    <h2>Login</h2>
    <p>Masukkan username dan password</p>

    <form action="" method="POST">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="" required autocomplete="off">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="" required>
        </div>

        <button type="submit" name="submit_login" class="btn-login">
            Login <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
        </button>
    </form>
    
    <div class="footer-note"></div>
</div>

</body>
</html>