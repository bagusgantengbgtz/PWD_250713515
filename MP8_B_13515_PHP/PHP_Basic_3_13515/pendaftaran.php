<?php
$error = [];
$nama = "";
$npm = "";
$loker = "";
$jadwalWawancara = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $npm = $_POST['npm'] ?? '';
    $loker = $_POST['loker'] ?? '';

    if (empty($nama)) {
        $error[] = "Nama tidak boleh kosong.";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $error[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if (empty($npm)) {
        $error[] = "NPM tidak boleh kosong.";
    } else if (!preg_match("/^[0-9]+$/", $npm)) {
        $error[] = "NPM hanya boleh mengandung angka.";
    }

    if (empty($loker)) {
        $error[] = "Pilihan staff tidak boleh kosong.";
    }

    if ($loker == "kasir") {
        $jadwalWawancara = "besok pukul 10.00 WIB di market";
    } else if ($loker == "merchandiser") {
        $jadwalWawancara = "lusa pukul 12.00 WIB di market";
    }
} else {
    echo "Silahkan lengkapi formulir di atas.";
}
?>

<h2>Pendaftaran Staff</h2>

<form action="" method="POST">
    <label>Nama:</label><br />
    <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>" /><br /><br />

    <label>NPM:</label><br />
    <input type="text" name="npm" value="<?php echo htmlspecialchars($npm); ?>" /><br /><br />

    <label>Pilihan Staff:</label><br />
    <select name="loker">
        <option value="">Pilih Staff: </option>
        <option value="kasir">Kasir</option>
        <option value="merchandiser">Merchandiser</option>
    </select><br /><br />

    <button type="submit">Daftar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($error)) {
        foreach ($error as $pesan) {
            echo "<p>[!] " . htmlspecialchars($pesan) . " [!]</p>";
        }
    } else {
        echo "<h2>Informasi Pendaftaran</h2>";
        echo "Nama: " . htmlspecialchars($nama) . "<br />";
        echo "NPM: " . htmlspecialchars($npm) . "<br />";
        echo "Pilihan Staff: " . htmlspecialchars($loker) . "<br />";
        echo "Jadwal Wawancara: " . htmlspecialchars($jadwalWawancara) . "<br />";
        echo "<p>Anda mendaftar sebagai " . htmlspecialchars($loker) . ". Selanjutnya, Anda dapat hadir " . htmlspecialchars($jadwalWawancara) . " untuk wawancara.</p>";
    }
}
?>