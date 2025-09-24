<?php
require 'database.php';

$tipeOptions = [];
$result = $conn->query("SELECT id_tipe, nama_tipe FROM tipe_kamar");
while ($row = $result->fetch_assoc()) {
    $tipeOptions[$row['id_tipe']] = $row['nama_tipe'];
}

$nama_tamu = $_POST['nama_tamu'] ?? '';
$id_tipe   = $_POST['id_tipe'] ?? '';
$checkin   = $_POST['checkin'] ?? '';
$checkout  = $_POST['checkout'] ?? '';

$layanan = [];
if (isset($_POST['layanan1'])) $layanan[] = $_POST['layanan1'];
if (isset($_POST['layanan2'])) $layanan[] = $_POST['layanan2'];
if (isset($_POST['layanan3'])) $layanan[] = $_POST['layanan3'];

$nama_tipe = $tipeOptions[$id_tipe] ?? 'Tidak Diketahui';
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Hasil Booking</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4">Detail Booking</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nama Tamu:</strong> <?= htmlspecialchars($nama_tamu) ?></li>
            <li class="list-group-item"><strong>Tipe Kamar:</strong> <?= htmlspecialchars($nama_tipe) ?></li>
            <li class="list-group-item"><strong>Check-In:</strong> <?= htmlspecialchars($checkin) ?></li>
            <li class="list-group-item"><strong>Check-Out:</strong> <?= htmlspecialchars($checkout) ?></li>
            <li class="list-group-item"><strong>Layanan Tambahan:</strong> 
                <?= !empty($layanan) ? implode(", ", array_map("htmlspecialchars", $layanan)) : "Tidak ada" ?>
            </li>
        </ul>
        <div class="mt-4">
            <a href="AksiBooking.php" class="btn btn-secondary">Kembali ke Form</a>
        </div>
    </div>
</div>
</body>
</html>
