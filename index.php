<?php
session_start();
$conn = new mysqli("localhost", "root", "", "keuangan_masjid");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data total
$total_jamaah = $conn->query("SELECT SUM(jumlah) AS total FROM sholat_berjamaah")->fetch_assoc()['total'] ?? 0;
$total_donasi = $conn->query("SELECT SUM(jumlah) AS total FROM donasi")->fetch_assoc()['total'] ?? 0;
$total_donasi_ramadhan = $conn->query("SELECT SUM(jumlah) AS total FROM transaksi")->fetch_assoc()['total'] ?? 0;
$total_pengeluaran = $conn->query("SELECT SUM(jumlah) AS total FROM transaksi WHERE jenis='pengeluaran'")->fetch_assoc()['total'] ?? 0;
$total_donasi_semua = $total_donasi + $total_donasi_ramadhan;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masjid</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #4ca1af);
            color: white;
        }
        .container {
            max-width: 1000px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }
        .btn-custom {
            border-radius: 25px;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4"><i class="fas fa-mosque"></i> Dashboard Layanan Masjid Agung Al-Istiqomah</h2>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Total Jamaah</h5>
                    <p class="display-5 fw-bold"><?php echo $total_jamaah; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Total Donasi</h5>
                    <p class="display-5 fw-bold">Rp <?php echo number_format($total_donasi_semua, 0, ',', '.'); ?></p>
                    <a href="input_donasi.php" class="btn btn-custom w-100 mt-2">Input Donasi</a>
					<a href="laporan_donasi.php" class="btn btn-custom w-100 mt-2">Laporan Donasi</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Total Ramadhan</h5>
                    <p class="display-5 fw-bold">Rp <?php echo number_format($total_donasi_ramadhan, 0, ',', '.'); ?></p>
                    <a href="input_ramadhan.php" class="btn btn-custom w-100 mt-2">Input Ramadhan</a>
                    <a href="laporan.php" class="btn btn-custom w-100 mt-2">Laporan Ramadhan</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h5>Total Pengeluaran Ramadhan</h5>
                    <p class="display-5 fw-bold">Rp <?php echo number_format($total_pengeluaran, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="row mt-4 text-center">
            <div class="col-md-4">
                <a href="sholat_berjamaah.php" class="btn btn-custom w-100 mb-3">Sholat Berjamaah</a>
            </div>
            <div class="col-md-4">
                <a href="kajian_islam.php" class="btn btn-custom w-100 mb-3">Kajian Islam</a>
            </div>
            <div class="col-md-4">
                <a href="laporan_donasi.php" class="btn btn-custom w-100 mb-3">Laporan Donasi</a>
            </div>
			 <div class="col-md-4">
                <a href="zakat/report_zf.php" class="btn btn-custom w-100 mb-3">Laporan Zakat</a>
            </div>
        </div>
    </div>
</body>
</html>
