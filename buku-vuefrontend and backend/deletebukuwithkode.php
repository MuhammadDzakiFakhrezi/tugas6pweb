<?php

include 'koneksi.php';

$conn = getConnection();


$kode = isset($_POST['kode']) ? $_POST['kode'] : '';

try {
   
    $query = "DELETE FROM buku WHERE kode = :kode";

    
    $statement = $conn->prepare($query);

  
    $statement->bindParam(':kode', $kode);


    $statement->execute();

    
    $response = [
        'status' => 'success',
        'message' => 'Data buku berhasil dihapus'
    ];
} catch(PDOException $e) {
   
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menghapus data buku: ' . $e->getMessage()
    ];
}


echo json_encode($response);


$conn = null;
?>