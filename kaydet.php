<?php
// Kullanıcı tarafından gönderilen bilgileri alalım
$demirbasAdi = $_POST['demirbasAdi'];
$marka = $_POST['marka'];
$model = $_POST['model'];
$alimTarihi = $_POST['alimTarihi'];
$teslimEden = $_POST['teslimEden'];
$teslimAlan = $_POST['teslimAlan'];
$durum = $_POST['durum'];
$seriNo = $_POST['seriNo'];
$aciklama = $_POST['aciklama'];

// Veritabanı bağlantısı yapalım
$servername = "localhost";
$username = "root"; // veya yeni kullanıcı adı
$password = ""; // veya yeni şifre
$dbname = "veritabani";


$conn = mysqli_connect($servername, $username, $password, $dbname);

// Bağlantıyı kontrol edelim
if (!$conn) {
    die("Veritabanına bağlanırken hata oluştu: " . mysqli_connect_error());
}

// Veriyi veritabanına kaydedelim
$sql = "INSERT INTO urunler (demirbas_adi, marka, model, alim_tarihi, teslim_eden, teslim_alan, durum, seri_no, aciklama)
        VALUES ('$demirbasAdi', '$marka', '$model', '$alimTarihi', '$teslimEden', 'teslimAlan', '$durum', '$seriNo', '$aciklama')";

if (mysqli_query($conn, $sql)) {
    // Kayıt başarıyla eklendi, kullanıcıyı "Bilgileri Görüntüle" sayfasına yönlendir
    header("Location: bilgileri_goruntule.php");
    exit();
} else {
    echo "Kayıt eklenirken hata oluştu: " . mysqli_error($conn);
}

// Veritabanı bağlantısını kapatalım
mysqli_close($conn);
?>


