<?php
require 'database.php';

$tipeOptions = [];
$result = $conn->query("SELECT id_tipe, nama_tipe FROM tipe_kamar");
while ($row = $result->fetch_assoc()) {
    $tipeOptions[$row['id_tipe']] = $row['nama_tipe'];
}
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Form Booking</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="mt-5 mb-5 d-flex justify-content-between">
        <a href="AksiTipe.php">Form Tambah Tipe Kamar</a>
        <a href="AksiKamar.php">Form Tambah Kamar</a>
    </div>

    <h2 class="mb-4">Form Booking Hotel</h2>
    <form method="POST" action="Booking.php" class="card p-4 shadow-lg">

        <div class="mb-3">
            <label for="nama_tamu" class="form-label">Nama Tamu</label>
            <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="mb-3">
            <label for="id_tipe" class="form-label">Tipe Kamar</label>
            <select class="form-select" id="id_tipe" name="id_tipe" required>
                <option value="">-- Pilih Tipe Kamar --</option>
                <?php foreach ($tipeOptions as $id => $nama): ?>
                    <option value="<?= htmlspecialchars($id) ?>"><?= htmlspecialchars($nama) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="checkin" class="form-label">Tanggal Check-In</label>
            <input type="date" class="form-control" id="checkin" name="checkin" required>
        </div>

        <div class="mb-3">
            <label for="checkout" class="form-label">Tanggal Check-Out</label>
            <input type="date" class="form-control" id="checkout" name="checkout" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Layanan Tambahan</label><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Sarapan Gratis" name="layanan[]">
                <label class="form-check-label">Sarapan Gratis</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Extra Bed" name="layanan[]">
                <label class="form-check-label">Extra Bed</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Antar Jemput Bandara" name="layanan[]">
                <label class="form-check-label">Antar Jemput Bandara</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Booking Sekarang</button>
    </form>
</div>
</body>
</html>
