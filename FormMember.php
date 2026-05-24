<?php 
require 'Model.php';

#SELECT data untuk EDIT
$nama = '';
$nomor = '';
$alamat = '';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $member = getMemberById($id);

    $nama = $member['nama_member'];
    $nomor = $member['nomor_member'];
    $alamat = $member['alamat'];
}

#CREATE
//cek tombol SIMPAN sudah di klik atau belum
if(isset($_POST['simpan'])){
    $nama = $_POST['nama_member'];
    $nomor = $_POST['nomor_member'];
    $alamat = $_POST['alamat'];

    if(isset($_GET['id'])){
        updateMember($id, $nama, $nomor, $alamat);
    } else {
        addMember($nama, $nomor, $alamat);
    }
    header("Location: /PRAK501/Member.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Form Member</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 font-sans p-8">
        <div class="text-xl font-bold text-gray-800 mb-6">Tambah / Edit Member</div>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Member</label>
                <input type="text" name="nama_member" value="<?php echo $nama; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Member</label>
                <input type="text" name="nomor_member" value="<?php echo $nomor; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                <input type="text" name="alamat" value="<?php echo $alamat; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" name="simpan" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">
                Simpan Data
            </button>
            
            <a href="Member.php" class="inline-block text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-200">Kembali</a>
        </form>
    </body>
</html>