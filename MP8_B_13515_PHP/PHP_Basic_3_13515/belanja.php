<?php
$error = [];
$makanan = "";
$alatTulis = "";
$hargaMakanan = 0;
$hargaAlatTulis = 0;
$totalBayar = 0;
$diskon = 0;

function dapatDiskon($totalBayar) {
    if ($totalBayar >= 10000) {
        return 0.05;
    } else {
        return 0;
    }
}

function totalHarga($diskon, $totalBayar) {
    return $totalBayar - ($totalBayar * $diskon);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $makanan = $_POST['makanan'] ?? '';
    $alatTulis = $_POST['alatTulis'] ?? '';

    if (empty($makanan)) {
        $error[] = "Makanan dan minuman tidak boleh kosong.";
    }

    if (empty($alatTulis)) {
        $error[] = "Alat tulis tidak boleh kosong.";
    }

    if (empty($error)) {
        if ($makanan == "pop mie") {
            $hargaMakanan = 5000;
        } else if ($makanan == "air mineral") {
            $hargaMakanan = 4000;
        }

        if ($alatTulis == "pulpen") {
            $hargaAlatTulis = 2000;
        } else if ($alatTulis == "tipe-x") {
            $hargaAlatTulis = 8000;
        }

        $totalBayar = $hargaMakanan + $hargaAlatTulis;
        $diskon = dapatDiskon($totalBayar);
    }
} else {
    echo "Silahkan pilih produk yang ingin dibeli.";
}
?>

<h2>Belanja</h2>
<p>Daftar Kategori:</p>

<form action="" method="POST">
    <label>Makanan dan Minuman:</label><br />
    <select name="makanan">
        <option value="">Pilih Produk: </option>
        <option value="pop mie">Pop Mie</option>
        <option value="air mineral">Air Mineral</option>
    </select><br /><br />

    <label>Alat Tulis:</label><br />
    <select name="alatTulis">
        <option value="">Pilih Produk: </option>
        <option value="pulpen">Pulpen</option>
        <option value="tipe-x">Tipe-X</option>
    </select><br /><br />

    <button type="submit">Beli</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($error)) {
        foreach ($error as $pesan) {
            echo "<p>[!] " . htmlspecialchars($pesan) . " [!]</p>";
        }
    } else {
        echo "<h2>Informasi Belanja</h2>";
        echo "Makanan dan Minuman: " . htmlspecialchars($makanan) . "<br />";
        echo "Alat Tulis: " . htmlspecialchars($alatTulis) . "<br />";
        echo "Total Harga: Rp" . number_format(totalHarga($diskon, $totalBayar), 0, ',', '.') . "<br />";
        echo "Diskon: " . htmlspecialchars($diskon * 100) . "%<br />";

        if ($diskon == 0) {
            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
        } else {
            echo "<p>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
        }
    }
}
?>