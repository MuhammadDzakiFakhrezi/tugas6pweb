<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'koneksi.php';

// Mendapatkan data yang dikirim melalui metode POST

$nomor = isset($_POST['nomorAnggota']) ? $_POST['nomorAnggota'] : '';
$nama = isset($_POST['namaAnggota']) ? $_POST['namaAnggota'] : '';
$jenis_kelamin = isset($_POST['jenis_kelaminAnggota']) ? $_POST['jenis_kelaminAnggota'] : '';
$alamat = isset($_POST['alamatAnggota']) ? $_POST['alamatAnggota'] : '';
$no_hp = isset($_POST['no_hpAnggota']) ? $_POST['no_hpAnggota'] : '';
$tanggal_terdaftar = isset($_POST['tanggal_terdaftarAnggota']) ? $_POST['tanggal_terdaftarAnggota'] : '';

try {
    // Establish database connection
    $conn = getConnection();

    // Query SQL untuk melakukan insert data buku
    $query = "INSERT INTO anggota (nomor, nama, jenis_kelamin, alamat, no_hp, tanggal_terdaftar) 
              VALUES (:nomor, :nama, :jenis_kelamin, :alamat, :no_hp, :tanggal_terdaftar)";
    
    // Mempersiapkan statement PDO untuk eksekusi query
    $statement = $conn->prepare($query);
    
    // Mengikat parameter dengan nilai yang sesuai
    $statement->bindParam(':nomor', $nomor);
    $statement->bindParam(':nama', $nama);
    $statement->bindParam(':jenis_kelamin', $jenis_kelamin);
    $statement->bindParam(':alamat', $alamat);
    $statement->bindParam(':no_hp', $no_hp);
    $statement->bindParam(':tanggal_terdaftar', $tanggal_terdaftar);
    
    // Eksekusi statement
    $statement->execute();
    
    // Mengembalikan response sukses
    $response = [
        'status' => 'success',
        'message' => 'Data anggota berhasil ditambahkan'
    ];
} catch(PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menambahkan data anggota: ' . $e->getMessage()
    ];
}

// Mengirimkan response JSON
echo json_encode($response);

// Menutup koneksi
$conn = null;
?>