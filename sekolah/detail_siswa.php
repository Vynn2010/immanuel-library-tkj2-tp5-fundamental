<?php
include "cek_koneksi.php";
include "cek_login.php";

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM siswa WHERE id ='$id'");
$siswa= mysqli_fetch_assoc($query);

if(!$siswa) {
    die("Siswa tidak ditemukan.");
}

?>
<?php include "header.php";?>
<h1>Detail Siswa</h1>
<table border="1" cellpadding="5">
    <tr>
        <td>Nama</td>
        <td><?php echo $siswa['nama']; ?></td>
    </tr>
</table>

<h2>Riwayat Pembayaran</h2>
<?php include "pembayaran.php";?> 