<?php
$pageTitle = "Pembayaran";
include "cek_koneksi.php";
include "cek_login.php";

$siswa_id =0;
if(isset($_GET['siswa_id'])) {
    $siswa_id = $_GET['siswa_id'];
}

$sql = "SELECT pembayaran.*, siswa.nama AS siswa_nama FROM pembayaran
        LEFT JOIN siswa ON pembayaran.siswa_id = siswa.id
        ORDER BY pembayaran.id DESC";
if ((int)$siswa_id != 0) {
    $sql = "SELECT pembayaran.*, siswa.nama AS siswa_nama FROM pembayaran
        LEFT JOIN siswa ON pembayaran.siswa_id = siswa.id
        WHERE siswa_id ='$siswa_id'
        ORDER BY pembayaran.id DESC";
}
$result = mysqli_query($conn, $sql);

if (!$result){
    die("Gagal". mysqli_connect_error());
}
?>

<?php
$pesan ="";

if (isset($_POST['hapus'])){
    $id = (int)$_POST['id'];

    $stmt = mysqli_prepare($conn,"DELETE FROM siswa WHERE id = ?");
    mysqli_stmt_bind_param($stmt,"i", $id);

    if (mysqli_stmt_execute($stmt)){
        $pesan = "Data berhasil dihapus";
    } else{
        $pesan = "Gagal Hapus : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>
    
    <?php include "header.php";?>
    <?php include "sidebar.php";?>
    <a href="siswa.php"></a>
    <h1 class="text-2xl font-semibold text-gray-900 mb-4">Tabel</h1>

    <div class="bg-white border border-gray-200 rounded-lg shadow overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-xs uppercase bg-gray-50 text-gray-500">
        <tr>
            <th class="px-4 py-3">Bulan</th>
            <th class="px-4 py-3">Tahun</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3 text-right">SPP</th>
            <th class="px-4 py-3 text-right"><span class="sr-only">Hapus</span></th>
            <th class="px-4 py-3 text-right"><span class="sr-only">Edit</span></th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php foreach ($result as $row): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900"><?= htmlspecialchars($row['bulan']) ?></td>
                <td class="px-4 py-3"><?= htmlspecialchars($row['tahun']) ?></td>
                <td class="px-4 py-3 text-left"><?= htmlspecialchars($row['siswa_nama']) ?></td>
                <td class="px-4 py-3 text-right">Rp <?= number_format($row['spp'], 0, ',', '.') ?></td>
                <td class="px-6 py-4 text-right">
                    <form method="POST" action="" onsubmit="return confirm('Yakin hapus produk ini?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="hapus" value="Hapus">
                    </form>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="insertpembayaran.php?id=<?=$row['id']?>" class="font-medium text-fg-brand hover:underline">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
        <?php include "footer.php"; ?>
    <?php
    mysqli_close($conn);
    ?>