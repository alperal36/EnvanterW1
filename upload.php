<?php
$target_dir = "uploads/"; // Hedef klasörü belirtin
$name = $_FILES["photo"]["name"];
$tmp_name = $_FILES["photo"]["tmp_name"];
$target_path = $target_dir . $name; // Hedef yolu oluşturun

if (move_uploaded_file($tmp_name, $target_path)) {
  echo "Dosya yüklendi!";
} else {
  echo "Hata oluştu: Dosya taşınamadı.";
}
?>

