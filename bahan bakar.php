
<?php
// Fungsi untuk menghitung total pembayaran
function hitungTotalBayar($harga, $jumlah, $ppn) {
    $total = $harga * $jumlah;
    $total += $total * ($ppn / 100); // Menambahkan PPN
    return number_format($total, 2, ",", "."); // Format angka menjadi mata uang
}

// Set harga dan PPN untuk setiap jenis bahan bakar
$harga = [
    "Super" => 15420,
    "V-Power" => 16130,
    "V-Power Diesel" => 18310,
    "V-Power Nitro" => 16510
];
$ppn = 10; // PPN 10%

// Proses form jika data sudah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["jenis"]) && isset($_POST["jumlah"])) {
    $jenis = $_POST["jenis"];
    $jumlah = $_POST["jumlah"];

    if (array_key_exists($jenis, $harga)) {
        $total_bayar = hitungTotalBayar($harga[$jenis], $jumlah, $ppn);
        echo "<div class='sam'><h2>Detail Pembelian</h2>";
        echo "<p>Jenis Bahan Bakar: $jenis</p>";
        echo "<p>Jumlah Liter: $jumlah</p>";
        echo "<p>Total Pembayaran: Rp. $total_bayar</p></div>";
    } else {
        echo "<p>Maaf, jenis bahan bakar tidak valid.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembelian Bahan Bakar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Form Pembelian Bahan Bakar</h2>
<div class="ganteng">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="jenis">Pilih Jenis Bahan Bakar:</label><br>
    <select id="jenis" name="jenis">
        <option value="Super">Shell Super</option>
        <option value="V-Power">Shell V-Power</option>
        <option value="V-Power Diesel">Shell V-Power Diesel</option>
        <option value="V-Power Nitro">Shell V-Power Nitro</option>
    </select><br><br>

    <label for="jumlah">Jumlah Liter:</label><br>
    <input type="number" id="jumlah" name="jumlah" min="1" required><br><br>

    <button type="submit">Submit</button>
</form>
</div>



</body>
</html>
