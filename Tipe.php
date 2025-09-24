<?php
require 'database.php';
require 'Login.php';
require 'Form.php';

$login = new Login($conn);
$login->requireLogin();

$formTipe = new Form('AksiTipe.php', 'Tambah Tipe Kamar', 'Simpan');
$formTipe->addField("nama_tipe", "Nama Tipe", "text", ["placeholder" => "Masukkan nama tipe kamar"]);
$formTipe->addField("deskripsi_tipe", "Deskripsi", "textarea", ["placeholder" => "Masukkan deskripsi tipe kamar"]);
$formTipe->addField("harga_tipe", "Harga", "number", ["placeholder" => "Masukkan harga per malam"]);
$formTipe->addField("kapasitas_tipe", "Kapasitas", "number", ["placeholder" => "Masukkan kapasitas orang"]);
?>

<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Tambah Tipe Kamar</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <?php $formTipe->displayForm(); ?>
    </div>
</body>
</html>
