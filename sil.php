<?php
// Veritabanı bağlantısı yapalım
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veritabani";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Bağlantıyı kontrol edelim
if (!$conn) {
    die("Veritabanına bağlanırken hata oluştu: " . mysqli_connect_error());
}

// Silinecek satırın ID'sini alalım
$id = $_GET['id'];

// Veritabanından satırı sil
$sql = "DELETE FROM urunler WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    // Silme işlemi başarılı, kullanıcıyı yönlendir
    header("Location: bilgileri_goruntule.php");
    exit();
} else {
    echo "Kayıt silinirken hata oluştu: " . mysqli_error($conn);
}

// Veritabanı bağlantısını kapatalım
mysqli_close($conn);
?>
