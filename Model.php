<?php 
require 'Koneksi.php';

#============= DISINI FUNCTION MEMBER SEMUA

function getAllDatafromMember(){
    global $connect;  #manggil var koneksi, agar bisa digunakan di funct ini

    $query = "SELECT * FROM member";

    $result = mysqli_query($connect, $query);
    return $result;
}

function getMemberById($id){
    global $connect;
    $query = "SELECT * FROM member WHERE id_member = $id";
    $result = mysqli_query($connect, $query);
    
    return mysqli_fetch_assoc($result);
}

function addMember($nama, $nomor, $alamat){
    global $connect;

    $query = "INSERT INTO member (nama_member, nomor_member, alamat, tgl_mendaftar, tgl_terakhir_bayar) VALUES ('$nama','$nomor', '$alamat', NOW(), CURDATE())";

    $result = mysqli_query($connect, $query);   
    return $result;
}

function deleteMember($id){
    global $connect;

    $query = "DELETE FROM member WHERE id_member = $id";

    $result = mysqli_query($connect, $query);
    return $result;
}

function updateMember($id, $nama, $nomor, $alamat){
    global $connect;
    $query="UPDATE member SET
    nama_member = '$nama',
    nomor_member = '$nomor',
    alamat = '$alamat'
    WHERE id_member = $id";

    $result = mysqli_query($connect, $query);
    return $result;
}

#=========== KALO DISINI FUNCTION CRUD NYA SI BUKU
function getAllDatafromBuku() {
    global $connect;
    return mysqli_query($connect, "SELECT * FROM buku");
}

function addBuku($judul, $penulis, $penerbit, $tahun) {
    global $connect;
    $query = "INSERT INTO buku (judul_buku, penulis, penerbit, tahun_terbit) 
              VALUES ('$judul', '$penulis', '$penerbit', '$tahun')";
    return mysqli_query($connect, $query);
}

function getBukuById($id) {
    global $connect;
    $result = mysqli_query($connect, "SELECT * FROM buku WHERE id_buku = $id");
    return mysqli_fetch_assoc($result);
}

function updateBuku($id, $judul, $penulis, $penerbit, $tahun) {
    global $connect;
    $query = "UPDATE buku SET 
              judul_buku = '$judul', 
              penulis = '$penulis', 
              penerbit = '$penerbit', 
              tahun_terbit = '$tahun' 
              WHERE id_buku = $id";
    return mysqli_query($connect, $query);
}

function deleteBuku($id) {
    global $connect;
    return mysqli_query($connect, "DELETE FROM buku WHERE id_buku = $id");
}

#=============CRUD Untuk PEMINJAMAN
function getAllDatafromPeminjaman(){
    global $connect;
    $query = "SELECT peminjaman.*, member.nama_member, buku.judul_buku 
              FROM peminjaman
              JOIN member ON peminjaman.id_member = member.id_member
              JOIN buku ON peminjaman.id_buku = buku.id_buku";

    $result = mysqli_query($connect, $query);
    return $result;
}

function addPeminjaman($id_member, $id_buku, $tgl_pinjam, $tgl_kembali) {
    global $connect;
    $query = "INSERT INTO peminjaman (id_member, id_buku, tgl_pinjam, tgl_kembali) 
              VALUES ($id_member, $id_buku, '$tgl_pinjam', '$tgl_kembali')";
    echo "Query yang dikirim: <b style='color:red;'> " . $query . " </b><br><br>";
    return mysqli_query($connect, $query);
}

function getPeminjamanById($id) {
    global $connect;
    $result = mysqli_query($connect, "SELECT * FROM peminjaman WHERE id_peminjaman = $id");
    return mysqli_fetch_assoc($result);
}

function updatePeminjaman($id, $id_member, $id_buku, $tgl_pinjam, $tgl_kembali) {
    global $connect;
    $query = "UPDATE peminjaman SET 
              id_member = $id_member, 
              id_buku = $id_buku, 
              tgl_pinjam = '$tgl_pinjam', 
              tgl_kembali = '$tgl_kembali' 
              WHERE id_peminjaman = $id";
    return mysqli_query($connect, $query);
}
?>