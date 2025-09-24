<?php
require 'database.php';
require 'Form.php';

$tipeOptions = [];
$result = $conn->query("SELECT id_tipe, nama_tipe FROM tipe_kamar");
while ($row = $result->fetch_assoc()) {
    $tipeOptions[$row['id_tipe']] = $row['nama_tipe'];
}

$formBooking = new Form('Booking.php', 'Form Booking Hotel', 'Booking Sekarang');
$formBooking->addField("nama_tamu", "Nama Tamu", "text", ["placeholder" => "Masukkan nama lengkap"]);
$formBooking->addField("id_tipe", "Tipe Kamar", "select", ["options" => $tipeOptions]);
$formBooking->addField("checkin", "Tanggal Check-In", "date");
$formBooking->addField("checkout", "Tanggal Check-Out", "date");

$formBooking->addField("layanan1", "Sarapan Gratis", "checkbox", ["value" => "Sarapan Gratis"]);
$formBooking->addField("layanan2", "Extra Bed", "checkbox", ["value" => "Extra Bed"]);
$formBooking->addField("layanan3", "Antar Jemput Bandara", "checkbox", ["value" => "Antar Jemput Bandara"]);

?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>Form Booking</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5 d-flex justify-content-between">
            <a href="AksiTipe.php">Form Tambah Tipe Kamar</a>
            <a href="AksiBooking.php">Form Tambah Kamar</a>
        </div>
        <?php
        $formBooking->displayForm();
        ?>
    </div>
</body>
</html>
