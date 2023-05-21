<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ürün Düzenleme</title>
  <style>
    body {
      background-color: #f1f1f1;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    h1 {
      color: #009688;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
    }

    label {
      display: inline-block;
      width: 150px;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    textarea {
      width: 300px;
      padding: 5px;
      border-radius: 3px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #009688;
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #00796b;
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

// ID'yi alalım
$id = $_GET['id'];

// Veritabanından ilgili ürünü sorgulayalım
$sql = "SELECT * FROM urunler WHERE id = $id";
$result = mysqli_query($conn, $sql);

// Kaydı kontrol edelim
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
?>
    <div class="container">
        <h1>Ürün Düzenleme</h1>
        <form action="kaydet.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="demirbasAdi">Demirbaş Adı:</label>
            <input type="text" name="demirbasAdi" value="<?php echo $row['demirbas_adi']; ?>"><br>
            <label for="marka">Marka:</label>
            <input type="text" name="marka" value="<?php echo $row['marka']; ?>"><br>
            <label for="model">Model:</label>
            <input type="text" name="model" value="<?php echo $row['model']; ?>"><br>
            <label for="alimTarihi">Alım Tarihi:</label>
            <input type="text" name="alimTarihi" value="<?php echo $row['alim_tarihi']; ?>"><br>
            <label for="teslimEden">Teslim Eden:</label>
            <input type="text" name="teslimEden" value="<?php echo $row['teslim_eden']; ?>"><br>
            <label for="teslimEden">Teslim Alan:</label>
            <input type="text" name="teslimAlan" value="<?php echo $row['teslim_alan']; ?>"><br>
            <label for="durum">Durum:</label>
            <input type="text" name="durum" value="<?php echo $row['durum']; ?>"><br>
            <label for="seriNo">Seri No:</label>
            <input type="text" name="seriNo" value="<?php echo $row['seri_no']; ?>"><br>
            <label for="aciklama">Açıklama:</label>
            <textarea name="aciklama"><?php echo $row['aciklama']; ?></textarea><br>
            <input type="submit" value="Kaydet">
        </form>
    </div>
<?php
} else {
    echo "Kayıt bulunamadı.";
}

// Veritabanı bağlantısını kapatalım
mysqli_close($conn);
?>

</body>
</html>
