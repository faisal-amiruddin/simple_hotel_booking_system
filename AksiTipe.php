<?php
require 'database.php';
require 'Login.php';
require 'Form.php';

$login = new Login($conn);
$login->requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_tipe      = trim($_POST['nama_tipe'] ?? '');
    $deskripsi_tipe = trim($_POST['deskripsi_tipe'] ?? '');
    $harga_tipe     = $_POST['harga_tipe'] ?? 0;
    $kapasitas_tipe = $_POST['kapasitas_tipe'] ?? 0;

    if ($nama_tipe && $deskripsi_tipe && $harga_tipe > 0 && $kapasitas_tipe > 0) {
        $stmt = $conn->prepare("INSERT INTO tipe_kamar (nama_tipe, deskripsi_tipe, harga_tipe, kapasitas_tipe) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $nama_tipe, $deskripsi_tipe, $harga_tipe, $kapasitas_tipe);
        $stmt->execute();
    }
}

$formTipe = new Form('AksiTipe.php', 'Tambah Tipe Kamar', 'Simpan');
$formTipe->addField("nama_tipe", "Nama Tipe", "text", ["placeholder" => "Masukkan nama tipe kamar"]);
$formTipe->addField("deskripsi_tipe", "Deskripsi", "textarea", ["placeholder" => "Masukkan deskripsi tipe kamar"]);
$formTipe->addField("harga_tipe", "Harga", "number", ["placeholder" => "Masukkan harga per malam"]);
$formTipe->addField("kapasitas_tipe", "Kapasitas", "number", ["placeholder" => "Masukkan kapasitas orang"]);

$daftarTipe = $conn->query("SELECT * FROM tipe_kamar ORDER BY id_tipe DESC");
?>

<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Data Tipe Kamar</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="mt-5 d-flex justify-content-between">
        <a href="AksiKamar.php">Form Tambah Kamar</a>
        <a href="AksiBooking.php">Form Booking</a>
    </div>
    <?php $formTipe->displayForm(); ?>

    <h3 class="mt-5 mb-3">Daftar Tipe Kamar</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tipe</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kapasitas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = $daftarTipe->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>" . htmlspecialchars($row['nama_tipe']) . "</td>";
                echo "<td>" . htmlspecialchars($row['deskripsi_tipe']) . "</td>";
                echo "<td>" . number_format($row['harga_tipe'], 0, ',', '.') . "</td>";
                echo "<td>" . htmlspecialchars($row['kapasitas_tipe']) . " orang</td>";
                echo "</tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
