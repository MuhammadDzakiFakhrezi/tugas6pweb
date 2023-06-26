<?php

include 'koneksi.php';


$kode = isset($_POST['kode']) ? $_POST['kode'] : '';
$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';


    $conn = getConnection();

try {

    if (!empty($kode) && !empty($kategori)) {
  
        $query = "INSERT INTO kategori (kode, kategori) VALUES (:kode, :kategori)";
        
    
        $statement = $conn->prepare($query);
        
   
        $statement->bindParam(':kode', $kode);
        $statement->bindParam(':kategori', $kategori);
  
        $statement->execute();
        
     
        $response = [
            'status' => 'success',
            'message' => 'Data kategori berhasil ditambahkan'
        ];
    } else {
   
        $response = [
            'status' => 'error',
            'message' => 'Data kategori tidak lengkap'
        ];
    }
} catch(PDOException $e) {

    $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat menambahkan data kategori: ' . $e->getMessage()
    ];
}


echo json_encode($response);


$conn = null;
?>