<?php
session_start();
require_once "db.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION['nama_lengkap'];
$role = $_SESSION['role'];

// Proteksi: hanya role pengguna yang boleh mengakses halaman ini
if ($role !== 'pengguna') {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - Parkir</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f6f9;
        }

        header {
            background: #007bff;
            color: white;
            padding: 20px;
        }

        header h2 {
            margin-bottom: 5px;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card h3 {
            margin-bottom: 5px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .box {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            text-decoration: none;
            color: #333;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .box h3 {
            margin-bottom: 10px;
        }

        .box:hover {
            background: #007bff;
            color: white;
            transform: translateY(-5px);
        }

        .action-buttons {
            margin-top: 25px;
        }

        .btn-index {
            display: inline-block;
            padding: 10px 20px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            transition: background 0.3s;
        }

        .btn-index:hover {
            background: #5a6268;
        }

        .logout {
            display: inline-block;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .logout:hover {
            background: #bd2130;
        }
    </style>
</head>
<body>

    <header>
        <h2>Aplikasi Parkir</h2>
        <p>
            Selamat datang, <b><?php echo htmlspecialchars($nama); ?></b> 
            (<?php echo strtoupper(htmlspecialchars($role)); ?>)
        </p>
    </header>

    <div class="container">
        <div class="card">
            <h3>Dashboard Pengguna</h3>
            <p>Silakan pilih menu di bawah ini.</p>
        </div>

        <div class="menu">
            <a href="pengguna\riwayat.php" class="box">
                <h3>🕒 Riwayat Parkir</h3>
                <p>Lihat Riwayat Parkir Anda</p>
            </a>

            <a href="pengguna\kendaraan_saya.php" class="box">
                <h3>🚗 Kendaraan Saya</h3>
                <p>Kelola Data Kendaraan Anda</p>
            </a>

            <a href="pengguna\pesan_tempat.php" class="box">
                <h3>🅿️ Pesan Tempat</h3>
                <p>Pesan Tempat Parkir</p>
            </a>
            <a href="pengguna\help.php" class="box">
                <h3>❓ Bantuan</h3>
                <p>Dapatkan Bantuan</p>
            </a>

            <a href="pengguna\profil.php" class="box">
                <h3>👤 Profil</h3>
                <p>Kelola Profil Akun</p>
            </a>
        </div>

        <div class="action-buttons">
            <a href="index.php" class="btn-index">🏠 Ke Landing Page</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>

</body>
</html>