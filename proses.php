<?php
if (!isset($_POST["proses"])) {
    header("Location: index.php");
    exit;
}

$nama = $_POST["nama"] ?? "";
$email = $_POST["email"] ?? "";
$hargamobil = $_POST["hargamobil"] ?? "";
$tenor = $_POST["tenor"] ?? "";
$dp = $_POST["dp"] ?? "";

if (empty($nama)) {
    header("Location: index.php?pesan=Nama harus diisi");
    exit;
} elseif (empty($email) || strpos($email, "@") === false) {
    header("Location: index.php?pesan=Email tidak valid");
    exit;
} elseif ($hargamobil == "" || !is_numeric($hargamobil) || $hargamobil <= 0) {
    header("Location: index.php?pesan=Harga mobil harus diisi dengan benar");
    exit;
} elseif (!in_array((string)$tenor, ["1", "2", "3", "4", "5"], true)) {
    header("Location: index.php?pesan=Tenor harus dipilih");
    exit;
} elseif (!in_array((string)$dp, ["10", "20", "30", "40", "50", "60"], true)) {
    header("Location: index.php?pesan=DP harus dipilih");
    exit;
}

$hargadpmobil = ($dp / 100) * $hargamobil;
$lamaangsuran = $tenor * 12;
$bunga = 20 / 100 * $hargamobil;
$jumlahangsuran = (($hargamobil + $bunga) - $hargadpmobil) / $lamaangsuran;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Angsuran AutoVista</title>
</head>
<body>

    <h2>Hasil Perhitungan Angsuran AutoVista</h2>
    <?php
    echo "Nama = " . htmlspecialchars($nama) . "<br>";
    echo "Email = " . htmlspecialchars($email) . "<br>";
    echo "Harga mobil = Rp " . number_format($hargamobil, 0, ',', '.') . "<br>";
    echo "DP = " . $dp . "%<br>";
    echo "Harga DP mobil = Rp " . number_format($hargadpmobil, 0, ',', '.') . "<br>";
    echo "Tenor = " . $tenor . " Tahun<br>";
    echo "Lama angsuran = " . $lamaangsuran . " bulan<br>";
    echo "Bunga = Rp " . number_format($bunga, 0, ',', '.') . "<br>";
    echo "Angsuran per bulan = Rp " . number_format($jumlahangsuran, 0, ',', '.') . "<br>";
    ?>

    <br>
    <a href="index.php#kalkulator" style="background-color: blue; color: white; padding: 8px 12px; text-decoration: none;">Kembali ke Form</a>

</body>
</html>