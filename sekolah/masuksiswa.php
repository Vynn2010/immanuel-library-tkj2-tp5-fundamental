<?php
include "cek_koneksi.php";
include "cek_login.php";

$pesan = "";

if (isset($_POST['simpan'])) {
    
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    if ($nama == ""){
        $nama = "Nama tidak boleh kosong";
    }   else {
            $sql = mysqli_prepare($conn,"INSERT INTO siswa (nama,kelas) VALUES (?,?)");
            mysqli_stmt_bind_param($sql,"ss", $nama, $kelas);

            if (mysqli_stmt_execute($sql)) {
                $pesan = "Data berhasil disimpan.";
            } else {
                $pesan = "Gagal simpan: " . mysqli_error($conn);
            }

            mysqli_stmt_close($sql);
    }
}
?>
        <?php include "header.php";?>

        <?php echo $pesan ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        </head>
        <body>
            <form class="max-w-sm mx-auto" method= "POST" action="">
                <div class="mt-20 mb-5">
                    <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nama Murid</label>
                    <input type="text" name="nama" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan nama siswa" required />
                </div>
                <div class="mb-5">
                    <label for="kelas" class="block mb-2.5 text-sm font-medium text-heading">Kelas</label>
                    <input type="text" name="kelas" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Masukkan kelas" required />
                </div>
                <label for="remember" class="flex items-center mb-5">
                    <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft" required />
                    <p class="ms-2 text-sm font-medium text-heading select-none">I agree with the <a href="#" class="text-fg-brand hover:underline">terms and conditions</a>.</p>
                </label>
                <button type="submit" name="simpan" value="Simpan" class="text-black bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Submit</button>
            </form>
        <?php include "footer.php"; ?>
        

            <!-- <label>Nama :</label><br>
            <input type="text" name="nama" required><br><br>
            <label>Kelas :</label><br>
            <input type="text" name="kelas" required><br><br>
            <input type="submit" name="simpan" value="Simpan"> -->
<?php
mysqli_close($conn);
?>

