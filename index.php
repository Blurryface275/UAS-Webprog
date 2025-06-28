<?php
session_start();

// Inisialisasi session dalam array jika belum ada
if (!isset($_SESSION['menu'])) {
    $_SESSION['menu'] = [];
}

// Menyimpan data makanan jika form disubmit
if (isset($_POST['submit'])) {
    $data = [
        'kode' => $_POST['kode-makanan'],
        'nama' => $_POST['nama-makanan'],
        'harga' => $_POST['harga-makanan'],
        'foto' => $_POST['foto-makanan']
    ];

    $_SESSION['menu'][] = $data; // Nambahin ke array session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Makanan</title>
</head>
<body>
    <h2>Tambah Menu Makanan</h2>
    <form action="" method="POST">
        <p>
            <label>Kode makanan: </label>
            <input type="text" name="kode-makanan" required><br><br>

            <label>Nama makanan: </label>
            <input type="text" name="nama-makanan" required><br><br>

            <label>Harga makanan: </label>
            <input type="number" name="harga-makanan" required><br><br>

            <label>URL foto makanan: </label>
            <input type="text" name="foto-makanan" required><br><br>

            <button type="submit" name="submit">Simpan ke Session</button>
        </p>
    </form>

    <br>
    <a href="order.php">Lihat Daftar Order</a>

    <hr>
    <h3>Menu yang Sudah Ditambahkan:</h3>
    <ul>
        <?php
        if (!empty($_SESSION['menu'])) {
            foreach ($_SESSION['menu'] as $makanan) {
                echo "<li>{$makanan['nama']} (Rp {$makanan['harga']})</li>"; // ini ambil dari session array di atas
            }
        } else {
            echo "<li>Belum ada makanan.</li>";
        }
        ?>
    </ul>
</body>
</html>
