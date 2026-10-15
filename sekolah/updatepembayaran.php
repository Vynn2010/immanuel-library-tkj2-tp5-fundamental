<?php
include "cek_koneksi.php";
include "cek_login.php";

$id = $_GET["id"];

if (isset($_POST['simpan'])) {
    $bulan = trim($_POST['bulan']);
    $tahun = trim($_POST['tahun']);
    $siswa = trim($_POST['siswa_id']);
    $spp = trim($_POST['spp']);

    $stmt = $conn->prepare("UPDATE pembayaran SET bulan=?, tahun=?, siswa_id=?, spp=? WHERE id =?");
    $stmt->bind_param("iiiii", $bulan, $tahun, $siswa ,$spp, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: pembayaran.php");
    exit;
}

$stmt = $conn->prepare("SELECT id, bulan, tahun, siswa_id, spp FROM pembayaran WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$pembayaran = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$pembayaran) {
    die("Data tidak ditemukan");
}
?>
<?php include "header.php";?>
<h2>Edit Pembayaran</h2>
<form method="Post">
    <input type="hidden" name="id" value="<?= $pembayaran['id']?>">
    <label>Bulan: </label>
    <input type="number" name="bulan" value="<?= $pembayaran['bulan']?>" required><br><br>
    <label>Tahun: </label>
    <input type="number" name="tahun" value="<?= $pembayaran['tahun']?>" required><br><br>
    <label>SPP: </label>
    <input type="number" name="spp" value="<?= $pembayaran['spp']?>" required><br><br>
    <label>List Siswa</label>
    <select name="siswa_id" required>
        <option value="">-- Pilih Siswa --</option>
        <?php
        $stmt = $conn->prepare("SELECT id, nama FROM siswa ORDER BY id ASC");
        $stmt->execute();
        $hasil = $stmt->get_result();

        while($s = $hasil->fetch_assoc()) {
        ?>
        <option value="<?= $s['id'];?>" <?= ($s['id'] == $pembayaran ['siswa_id']) ? 'selected' :'';?>> <?=$s['nama']?></option>
        <?php
        }
        $stmt->close();
        ?>
        
    </select><br><br>
    <button type="submit" name="simpan">Update</button>
</form>

<?php
mysqli_close($conn);
?>