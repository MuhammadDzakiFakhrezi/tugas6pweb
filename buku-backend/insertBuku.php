<?php
// Include file koneksi.php untuk mendapatkan koneksi ke database
include 'koneksi.php';

// Mendapatkan data yang dikirim melalui metode POST
$kode = isset($_POST['kodeBuku']) ? $_POST['kodeBuku'] : '';
$kode_kategori = isset($_POST['kode_kategoriBuku']) ? $_POST['kode_kategoriBuku'] : '';
$judul = isset($_POST['judulBuku']) ? $_POST['judulBuku'] : '';
$pengarang = isset($_POST['pengarangBuku']) ? $_POST['pengarangBuku'] : '';
$penerbit = isset($_POST['penerbitBuku']) ? $_POST['penerbitBuku'] : '';
$tahun = isset($_POST['tahunBuku']) ? $_POST['tahunBuku'] : '';
$tanggal_input = isset($_POST['tanggal_inputBuku']) ? $_POST['tanggal_inputBuku'] : '';
$harga = isset($_POST['hargaBuku']) ? $_POST['hargaBuku'] : '';
$file_cover = isset($_POST['file_coverBuku']) ? $_POST['file_coverBuku'] : '';

try {
    // Establish database connection
    $conn = getConnection();

    // Query SQL untuk melakukan insert data buku
    $query = "INSERT INTO buku (kode, kode_kategori, judul, pengarang, penerbit, tahun, tanggal_input, harga, file_cover) 
              VALUES (:kode, :kode_kategori, :judul, :pengarang, :penerbit, :tahun, :tanggal_input, :harga, :file_cover)";
    
    // Mempersiapkan statement PDO untuk eksekusi query
    $statement = $conn->prepare($query);
    
    // Mengikat parameter dengan nilai yang sesuai
    $statement->bindParam(':kode', $kode);
    $statement->bindParam(':kode_kategori', $kode_kategori);
    $statement->bindParam(':judul', $judul);
    $statement->bindParam(':pengarang', $pengarang);
    $statement->bindParam(':penerbit', $penerbit);
    $statement->bindParam(':tahun', $tahun);
    $statement->bindParam(':tanggal_input', $tanggal_input);
    $statement->bindParam(':harga', $harga);
    $statement->bindParam(':file_cover', $file_cover);
    
    // Eksekusi statement
    $statement->execute();
    
    // Mengembalikan response sukses
    $response = [
        'status' => 'success',
        'message' => 'Data buku berhasil ditambahkan'
    ];
} catch(PDOException $e) {
    // Jika terjadi error, tampilkan pesan error
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menambahkan data buku: ' . $e->getMessage()
    ];
}

// Mengirimkan response JSON
echo json_encode($response);

// Menutup koneksi
$conn = null;
?>