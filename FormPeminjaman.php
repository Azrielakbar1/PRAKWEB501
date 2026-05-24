<?php 

require 'Model.php';

$pilihan_member = getAllDatafromMember();
$pilihan_buku = getAllDatafromBuku();

$id_member = '';
$id_buku = '';
$tgl_pinjam = '';
$tgl_kembali = '';

// EDIT
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $peminjaman = getPeminjamanById($id);
    
    $id_member   = $peminjaman['id_member'];
    $id_buku     = $peminjaman['id_buku'];
    $tgl_pinjam  = $peminjaman['tgl_pinjam'];
    $tgl_kembali = $peminjaman['tgl_kembali'];
}

//  SIMPAN 
if (isset($_POST['simpan'])) {
    $id_member   = $_POST['id_member'];
    $id_buku     = $_POST['id_buku'];
    $tgl_pinjam  = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    if (isset($_GET['id'])) {
        updatePeminjaman($_GET['id'], $id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
    } else {
        addPeminjaman($id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
    }
    
    header("Location: /PRAK501/Peminjaman.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-2xl shadow-md">
        <div class="text-xl font-bold text-gray-800 mb-6">Tambah Transaksi Peminjaman</div>
        
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Member</label>
                <select name="id_member" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Member</option>
                    <?php while ($memb = mysqli_fetch_assoc($pilihan_member)) : ?>
                        <option value="<?php echo $memb['id_member']; ?>"><?php echo $memb['nama_member']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Buku</label>
                <select name="id_buku" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Buku</option>
                    <?php while ($buku = mysqli_fetch_assoc($pilihan_buku)) : ?>
                        <option value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul_buku']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" name="simpan" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">
                Simpan Transaksi
            </button>
            
            <a href="Peminjaman.php" class="inline-block text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">Kembali</a>
        </form>
    </div>
</body>
</html>