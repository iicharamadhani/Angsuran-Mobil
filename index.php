<?php
$pesan_error = "";
$nama = "";
$email = "";
$hargamobil = "";
$dp = "";
$tenor = "";

if (isset($_POST["hitung"])) {
    $nama = $_POST["nama"] ?? "";
    $email = $_POST["email"] ?? "";
    $hargamobil = $_POST["hargamobil"] ?? "";
    $dp = $_POST["dp"] ?? "";
    $tenor = $_POST["tenor"] ?? "";
    if (empty($nama)) {
        $pesan_error .= "Nama harus diisi.<br>";
    }
    if (empty($email)) {
        $pesan_error .= "Email harus diisi.<br>";
    } elseif (strpos($email, "@") === false) {
        $pesan_error .= "Format email tidak valid.<br>";
    }
    if ($hargamobil == "" || !is_numeric($hargamobil) || $hargamobil <= 0) {
        $pesan_error .= "Harga mobil harus diisi dengan benar.<br>";
    }
    if (!in_array((string)$dp, ["10", "20", "30", "40", "50", "60"], true)) {
        $pesan_error .= "DP harus dipilih.<br>";
    }
    if (!in_array((string)$tenor, ["1", "2", "3", "4", "5"], true)) {
        $pesan_error .= "Tenor harus dipilih.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        section {
            padding: 60px 20px;
        }
        .hasil {
            background: #f5f5f5;
        }
        .carousel img {
            height: 400px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">AUTOVISTA</a>
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kalkulator">Kalkulator</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="home" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="asset/car1.jpeg" class="d-block w-100" alt="Mobil AutoVista">
            <div class="carousel-caption">
                <h1>AUTOVISTA CAR FINANCE</h1>
                <p>Drive Your Dream.</p>
                <a href="#kalkulator" class="btn btn-light">Hitung Angsuran</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="asset/car2.jpeg" class="d-block w-100" alt="Pilihan mobil">
            <div class="carousel-caption">
                <h1>EASY FINANCING</h1>
                <p>Pilih Mobil, Atur Rencana.</p>
                <a href="#kalkulator" class="btn btn-light">Mulai Simulasi</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="asset/car3.jpeg" class="d-block w-100" alt="Perencanaan mobil">
            <div class="carousel-caption">
                <h1>SMART CAR PLANNING</h1>
                <p>Rencana Lebih Terarah.</p>
                <a href="#tentang" class="btn btn-light">Tentang Kami</a>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button"
        data-bs-target="#home" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button"
        data-bs-target="#home" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<section id="tentang">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3">
                <img src="asset/car4.jpeg" class="img-fluid rounded" alt="Mobil AutoVista">
            </div>
            <div class="col-md-6">
                <h2>Tentang AutoVista</h2>
                <p>
                    AutoVista membantu merencanakan kendaraan impian
                    dengan perhitungan angsuran yang mudah dan sederhana.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="kalkulator" class="hasil">
    <div class="container">
        <h2 class="text-center mb-4">Kalkulator Angsuran Mobil</h2>
        <?php
        if (!empty($pesan_error)) {
            echo "<div class='alert alert-danger mx-auto' role='alert' style='max-width:600px'>";
            echo $pesan_error;
            echo "</div>";
        }
        ?>

        <form action="index.php#kalkulator" method="post"
            class="mx-auto" style="max-width:600px">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control mb-3"
                value="<?php echo htmlspecialchars($nama); ?>">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control mb-3"
                value="<?php echo htmlspecialchars($email); ?>">
            <label class="form-label">Harga Mobil (Rp)</label>
            <input type="number" name="hargamobil" class="form-control mb-3"
                value="<?php echo htmlspecialchars($hargamobil); ?>">
            <label class="form-label">DP</label>
            <select name="dp" class="form-select mb-3">
                <option value="">Pilih DP</option>

                <?php
                for ($i = 10; $i <= 60; $i += 10) {
                    $selected = ((string)$dp === (string)$i) ? "selected" : "";
                    echo "<option value='$i' $selected>$i%</option>";
                }
                ?>
            </select>
            <label class="form-label d-block">Tenor</label>

            <?php
            for ($i = 1; $i <= 5; $i++) {
                $checked = ((string)$tenor === (string)$i) ? "checked" : "";

                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='tenor' value='$i' $checked>";
                echo "<label class='form-check-label'>$i Tahun</label>";
                echo "</div>";
            }
            ?>

            <br><br>
            <button type="submit" name="hitung" class="btn btn-dark">
                Hitung Angsuran
            </button>
        </form>

        <?php
        if (isset($_POST["hitung"]) && empty($pesan_error)) {
        ?>
            <form action="proses.php" method="post" id="formProses">
                <input type="hidden" name="nama"
                    value="<?php echo htmlspecialchars($nama); ?>">
                <input type="hidden" name="email"
                    value="<?php echo htmlspecialchars($email); ?>">
                <input type="hidden" name="hargamobil"
                    value="<?php echo htmlspecialchars($hargamobil); ?>">
                <input type="hidden" name="dp"
                    value="<?php echo htmlspecialchars($dp); ?>">
                <input type="hidden" name="tenor"
                    value="<?php echo htmlspecialchars($tenor); ?>">
                <input type="hidden" name="proses" value="1">
            </form>

            <script>
                document.getElementById("formProses").submit();
            </script>

        <?php
        }
        ?>

    </div>
</section>

<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; 2026 AutoVista. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>