<?php 
require 'Model.php';

$judul = ''; 
$penulis = ''; 
$penerbit = ''; 
$tahun = '';

//EDIT
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $buku = getBukuById($id);
    $judul = $buku['judul_buku'];
    $penulis = $buku['penulis'];
    $penerbit = $buku['penerbit'];
    $tahun = $buku['tahun_terbit'];
}

// SIMPAN
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun_terbit'];

    if (isset($_GET['id'])) {
        updateBuku($_GET['id'], $judul, $penulis, $penerbit, $tahun);
    } else {
        addBuku($judul, $penulis, $penerbit, $tahun);
    }
    header("Location: /PRAK501/Buku.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow-md">
        <div class="text-xl font-bold text-gray-800 mb-6">Tambah / Edit Buku</div>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Buku</label>
                <input type="text" name="judul_buku" value="<?php echo $judul; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Penulis</label>
                <input type="text" name="penulis" value="<?php echo $penulis; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" value="<?php echo $penerbit; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="<?php echo $tahun; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" name="simpan" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">
                Simpan Data
            </button>
            
            <a href="Buku.php" class="inline-block text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">Kembali</a>
        </form>
    </div>
</body>
</html>