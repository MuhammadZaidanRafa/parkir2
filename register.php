<?php
require_once "db.php";

if(isset($_POST['register'])){

    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "pengguna";

    $cek = $conn->prepare("SELECT id_user FROM tb_user WHERE username=?");
    $cek->bind_param("s",$username);
    $cek->execute();
    $hasil = $cek->get_result();

    if($hasil->num_rows > 0){
        $error = "Username sudah digunakan.";
    }else{
        $sql = "INSERT INTO tb_user
        (nama_lengkap,username,password,role,status_aktif)
        VALUES (?,?,?,?,1)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssss",
            $nama,
            $username,
            $password,
            $role
        );

        if($stmt->execute()){
            header("Location: login_pengguna.php");
            exit;
        }else{
            $error = "Registrasi gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Parkir System</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 40px 32px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .header h2 {
            color: #0f172a;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
            margin-top: 6px;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px 14px;
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            color: #0f172a;
            transition: all 0.2s ease;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2064748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .footer-text {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748b;
        }

        .footer-text a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <h2>Register User</h2>
        <p>Buat akun baru untuk sistem parkir</p>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert-error">
            <span>⚠️ <?= $error; ?></span>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required autocomplete="off">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required autocomplete="off">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" name="register" class="btn-submit">
            Daftar Akun
        </button>
    </form>

    <div class="footer-text">
        Sudah punya akun? <a href="login_pengguna.php">Masuk sekarang</a>
    </div>
</div>

</body>
</html>