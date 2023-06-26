<?php

include 'koneksi.php';

$conn = getConnection();

$nomor = isset($_POST['nomor']) ? $_POST['nomor'] : '';

try {
    
    $query = "DELETE FROM anggota WHERE nomor = :nomor";

    
    $statement = $conn->prepare($query);

   
    $statement->bindParam(':nomor', $nomor);

  
    $statement->execute();

 
    $response = [
        'status' => 'success',
        'message' => 'Data anggota berhasil dihapus'
    ];
} catch(PDOException $e) {
    
    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menghapus data anggota: ' . $e->getMessage()
    ];
}


echo json_encode($response);


$conn = null;
?>