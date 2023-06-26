<?php

include 'koneksi.php';

$conn = getConnection();


$id = isset($_POST['id']) ? $_POST['id'] : '';
$kode = isset($_POST['kode']) ? $_POST['kode'] : '';
$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';

try {
  
    $query = "UPDATE kategori SET kode = :kode, kategori = :kategori WHERE id = :id";
    

    $statement = $conn->prepare($query);
    

    $statement->bindParam(':id', $id);
    $statement->bindParam(':kode', $kode);
    $statement->bindParam(':kategori', $kategori);
    

    $statement->execute();
    

    $response = [
        'status' => 'success',
        'message' => 'Data kategori berhasil diperbarui'
    ];
} catch(PDOException $e) {

    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat memperbarui data kategori: ' . $e->getMessage()
    ];
}


header('Content-Type: application/json');
echo json_encode($response);


$conn = null;
?>