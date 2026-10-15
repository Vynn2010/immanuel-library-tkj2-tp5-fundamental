<?php
include "cek_koneksi.php";
include "cek_login.php";

$pesan = "";

if (isset($_POST["simpan"])) {
    
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];
    $siswa = $_POST["siswa_id"];
    $spp = $_POST["spp"];

    if ($bulan == "" && $tahun == ""){
        $pesan = "Bulan dan Tahun tidak boleh kosong";
        
    }   else {
            $sql = mysqli_prepare($conn,"INSERT INTO pembayaran (bulan,tahun,siswa_id,spp) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($sql,"iiii", $bulan, $tahun, $siswa, $spp);

            if (mysqli_stmt_execute($sql)) {
                $pesan = "Data berhasil disimpan.";
            }   else {
                $pesan = "Gagal simpan: " . mysqli_error($conn);
            }

            mysqli_stmt_close($sql);
    }
}
?>
        <?php include "sidebar.php";?>
        <?php include "header.php";?>
        <?php echo $pesan ?>
            <form method="post" class="bg-white border border-gray-300 rounded-lg shadow p-6 max-w-lg space-y-4">
                <div>
                    <label for="bulan" class="block mb-1 text-sm font-medium text-gray-900">Bulan</label>
                    <input type="number" name="bulan" required class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="tahun" class="block mb-1 text-sm font-medium text-gray-900">Tahun</label>
                    <input type="number" name="tahun"  required class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                    <label for="SPP" class="block mb-1 text-sm font-medium text-gray-900">SPP</label>
                    <input type="number" name="spp" min="0"  required class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label for="siswa" class="block mb-2.5 text-sm font-medium text-heading">Siswa: </label>
                    <select name="siswa_id" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php
                        $stmt = $conn->prepare("SELECT id, nama FROM siswa ORDER BY nama ASC");
                        $stmt->execute();
                        $hasil = $stmt->get_result();

                        while ($s = $hasil->fetch_assoc()) {
                            echo "<option value='" . $s["id"] ."'>". $s['nama'] ."</option>";
                        }
                        $stmt->close();
                        ?>
                    </select><br><br>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit" name="simpan" value="Simpan" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Simpan</button>
                    <a href="table.php" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">Batal</a>
                </div>
            </form> 
       <?php include "footer.php"; ?>   
<?php
mysqli_close($conn);
?>