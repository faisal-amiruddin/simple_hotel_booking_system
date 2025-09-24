<?php
require 'database.php';
require 'Login.php';
require 'Form.php';

$login = new Login($conn);
$login->requireLogin();

$tipeOptions = [];
$result = $conn->query("SELECT id_tipe, nama_tipe FROM tipe_kamar");
while ($row = $result->fetch_assoc()) {
    $tipeOptions[$row['id_tipe']] = $row['nama_tipe'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_kamar  = trim($_POST['nomor_kamar'] ?? '');
    $status_kamar = $_POST['status_kamar'] ?? 0;
    $id_tipe      = $_POST['id_tipe'] ?? '';

    if ($nomor_kamar && $id_tipe !== '') {
        $stmt = $conn->prepare("INSERT INTO kamar (nomor_kamar, status_kamar, id_tipe) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $nomor_kamar, $status_kamar, $id_tipe);
        $stmt->execute();
    }
}

$formKamar = new Form('AksiKamar.php', 'Tambah Kamar', 'Simpan');
$formKamar->addField("nomor_kamar", "Nomor Kamar", "text", ["placeholder" => "Masukkan nomor kamar"]);
$formKamar->addField("status_kamar", "Status Kamar", "radio", [
    "options" => [
        "0" => "Kosong",
        "1" => "Terisi"
    ]
]);
$formKamar->addField("id_tipe", "Tipe Kamar", "select", [
    "options" => $tipeOptions
]);

$daftarKamar = $conn->query("
    SELECT k.id_kamar, k.nomor_kamar, k.status_kamar, t.nama_tipe, t.harga_tipe, t.kapasitas_tipe
    FROM kamar k
    JOIN tipe_kamar t ON k.id_tipe = t.id_tipe
    ORDER BY k.id_kamar DESC
");
?>

<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Data Kamar</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="mt-5 d-flex justify-content-between">
        <a href="AksiTipe.php">Form Tambah Tipe Kamar</a>
        <a href="AksiBooking.php">Form Booking</a>
    </div>

    <?php $formKamar->displayForm(); ?>

    <h3 class="mt-5 mb-3">Daftar Kamar</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Kamar</th>
                <th>Status</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Kapasitas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = $daftarKamar->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>" . htmlspecialchars($row['nomor_kamar']) . "</td>";
                echo "<td>" . ($row['status_kamar'] ? "Terisi" : "Kosong") . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_tipe']) . "</td>";
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
