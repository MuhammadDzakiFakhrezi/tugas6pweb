<?php

include 'koneksi.php';

$conn = getConnection();


$kode = isset($_GET['kode']) ? $_GET['kode'] : '';

try {

    $query = "SELECT * FROM buku WHERE kode = :kode";
    

    $statement = $conn->prepare($query);
    
 
    $statement->bindParam(':kode', $kode);
    

    $statement->execute();
    

    $buku = $statement->fetch(PDO::FETCH_ASSOC);
    

    if ($buku) {
        $response = [
            'status' => 'success',
            'data' => $buku
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Data buku tidak ditemukan'
        ];
    }
} catch(PDOException $e) {

    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat memilih data buku: ' . $e->getMessage()
    ];
}

echo json_encode($response);


$conn = null;
?>