<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ürün Listesi</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      font-family: sans-serif;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: greenyellow;
    }
  </style>
</head>
<body>

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

// Arama sorgusu için kullanıcının girdiği değeri alalım
$sorgu = $_GET['sorgu'];

// Verileri veritabanından çekelim
$sql = "SELECT * FROM urunler WHERE demirbas_adi LIKE '%$sorgu%' OR marka LIKE '%$sorgu%' OR model LIKE '%$sorgu%' OR alim_tarihi LIKE '%$sorgu%' OR teslim_eden LIKE '%$sorgu%' OR durum LIKE '%$sorgu%' OR aciklama LIKE '%$sorgu%' OR seri_no LIKE '%$sorgu%'";
$result = mysqli_query($conn, $sql);

// Sonuçları tablo şeklinde yazdıralım
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Demirbaş Adı</th>";
    echo "<th>Marka</th>";
    echo "<th>Model</th>";
    echo "<th>Alım Tarihi</th>";
    echo "<th>Teslim Eden</th>";
    echo "<th>Teslim Alan</th>";
    echo "<th>Durum</th>";
    echo "<th>Açıklama</th>";
    echo "<th>Seri No</th>";
    echo "<th>İşlemler</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['demirbas_adi'] . "</td>";
        echo "<td>" . $row['marka'] . "</td>";
        echo "<td>" . $row['model'] . "</td>";
        echo "<td>" . $row['alim_tarihi'] . "</td>";
        echo "<td>" . $row['teslim_eden'] . "</td>";
        echo "<td>" . $row['teslim_alan'] . "</td>";
        echo "<td>" . $row['durum'] . "</td>";
        echo "<td>" . $row['aciklama'] . "</td>";
        echo "<td>" . $row['seri_no'] . "</td>";
        echo "<td><a href='duzenle.php?id=" . $row['id'] . "'>Düzenle</a> | <a href='sil.php?id=" . $row['id'] . "'>Sil</a></td>";
        echo "</tr>";

        // Düzenleme formunu kontrol edelim
        if (isset($_GET['id']) && $_GET['id'] == $row['id']) {
            echo "<tr>";
            echo "<form action='kaydet.php' method='POST'>";
            echo "<td><input type='text' name='demirbas_adi' value='" . $row['demirbas_adi'] . "' required></td>";
            echo "<td><input type='text' name='marka' value='" . $row['marka'] . "' required></td>";
            echo "<td><input type='text' name='model' value='" . $row['model'] . "' required></td>";
            echo "<td><input type='date' name='alim_tarihi' value='" . $row['alim_tarihi'] . "' required></td>";
            echo "<td><input type='text' name='teslim_eden' value='" . $row['teslim_eden'] . "' required></td>";
            echo "<td><input type='text' name='teslim_alan' value='" . $row['teslim_alan'] . "' required></td>";
            echo "<td><input type='text' name='durum' value='" . $row['durum'] . "' required></td>";
            echo "<td><input type='text' name='seri_no' value='" . $row['seri_no'] . "' required></td>";
            echo "<td><textarea name='aciklama' required>" . $row['aciklama'] . "</textarea></td>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<td><button type='submit'>Kaydet</button></td>";
            echo "</form>";
            echo "</tr>";
        }
    }

    echo "</table>";
} else {
    echo "Arama sonucunda eşleşen kayıt bulunamadı.";
}

// Veritabanı bağlantısını kapatalım
mysqli_close($conn);
?>

</body>
</html>


