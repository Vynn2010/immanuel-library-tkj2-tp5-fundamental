<?php
include "cek_koneksi.php";
include "cek_login.php";

$id = $_GET['id'];

if (isset($_POST['simpan'])){
    $nama = trim($_POST['nama']);
    $kelas=trim($_POST['kelas']);
    $id = ($_POST['id']);

    $stmt = $conn->prepare("UPDATE siswa SET nama =?, kelas=? WHERE id = ?");
    $stmt->bind_param("ssi", $nama, $kelas, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: siswa.php");
    exit;
}

$stmt = $conn->prepare("SELECT id, nama, kelas FROM siswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$siswa = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$siswa) {
    die("Data tidak ditemukan");
}
?>
<?php include "header.php";?>
<h2>Edit Siswa</h2>
<form method="Post">
    <input type="hidden" name="id" value="<?= $siswa['id']?>">
    <label>Nama Siswa : </label>
    <input type="text" name="nama" value="<?= $siswa['nama']?>" required><br><br>
    <label>Kelas : </label>
    <input type="text" name="kelas" value="<?= $siswa['kelas']?>" required><br><br>
    <button type="submit" name="simpan">Update</button>
</form>
<?php
mysqli_close($conn);
?>