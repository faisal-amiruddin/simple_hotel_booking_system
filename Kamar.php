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
?>

<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Tambah Kamar</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <?php $formKamar->displayForm(); ?>
    </div>
</body>
</html>
