<?php
session_start();
$menu = $_SESSION['menu'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Makanan</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
        }

        .left {
            width: calc(100% - 250px);
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .right {
            width: 250px;
            background-color: #f0f0f0;
            padding: 20px;
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .card {
            width: 200px;
            border: 2px solid #ccc;
            padding: 5px;
            border-radius: 8px;
            background: #fff;
        }

        .card img {
            max-width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .card button {
            margin-top: 10px;
            width: 100%;
        }

        .pilihan-item {
            margin-bottom: 10px;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="left">
    <?php foreach ($menu as $index => $makanan): ?>
        <div class="card">
            <img src="<?= htmlspecialchars($makanan['foto']) ?>" alt="<?= htmlspecialchars($makanan['nama']) ?>">
            <h4><?= htmlspecialchars($makanan['nama']) ?></h4>
            <p>Rp <?= number_format($makanan['harga'], 0, ',', '.') ?></p>
            <button class="pilih-btn" data-nama="<?= htmlspecialchars($makanan['nama']) ?>" 
                    data-harga="<?= $makanan['harga'] ?>" 
                    data-index="<?= $index ?>">
                Pilih
            </button>
        </div>
    <?php endforeach; ?>
</div>

<div class="right">
    <h3>Pesanan Anda</h3>
    <div id="pilihan"></div>
    <div class="total">Total: Rp <span id="total">0</span></div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    let totalHarga = 0;

    $(document).ready(function () {
        $('.pilih-btn').click(function () {
            const nama = $(this).data('nama');
            const harga = parseInt($(this).data('harga'));

            // Tambahkan ke kolom kanan
            $('#pilihan').append(`
                <div class="pilihan-item">
                    ${nama} - Rp ${harga.toLocaleString('id-ID')}
                </div>
            `);

            // Update total
            totalHarga += harga;
            $('#total').text(totalHarga.toLocaleString('id-ID'));

            // Disable tombol
            $(this).prop('disabled', true);
        });
    });
</script>

</body>
</html>
