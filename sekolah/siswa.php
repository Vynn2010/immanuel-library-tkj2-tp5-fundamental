<?php
include "cek_koneksi.php";
include "cek_login.php";

$sql = "SELECT id,nama,kelas FROM siswa ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

if (!$result){
    die("Gagal". mysqli_connect_error());
}
?>

<?php
$pesan = "";

if (isset($_POST['hapus'])){
    $id = (int)$_POST['id'];

    $stmt = mysqli_prepare($conn,"DELETE FROM siswa WHERE id = ?");
    mysqli_stmt_bind_param($stmt,"i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $pesan = "Data berhasil dihapus";
    } else {
        $pesan = "Gagal Hapus: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>
    <?php include "header.php";?>
    <?php include "sidebar.php";?>
    <a href="masuksiswa.php"></a>
    <a href="updatesiswa.php"></a>
    
    <?php echo $pesan; ?>
         <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                    <tr>
                        <td scope="col" class="px-6 py-3 font-medium">
                            Nama
                        </td>
                        <td scope="col" class="px-6 py-3 font-medium">
                            Kelas
                        </td>
                        <td scope="col" class="px-6 py-3 font-medium">
                            <span class="sr-only">Edit</span>
                        </td>
                    </tr>
                </thead>
                <tbody> 
                <?php
                $no = 1;
                while ($row = mysqli_fetch_array($result)){
                ?>
                <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                    <td scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        <?php echo $row['nama']?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $row['kelas']?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="updatesiswa.php?id=<?=$row['id']?>" class="font-medium text-fg-brand hover:underline">Edit</a>
                        <a href="masuksiswa.php?id=<?=$row['id']?>" class="font-medium text-fg-brand hover:underline">Tambahkan</a>
                        <form method="POST" action="" onsubmit="return confirm('Yakin hapus siswa ini?');">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="hapus" value="Hapus">
                        </form>
                    </td>
                </tr>
                <?php
                $no++;
                }
                ?>
                </tbody>
            </table>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <?php include "footer.php"; ?>
    <?php
    mysqli_close($conn);
    ?>