<?php
$title = "Absensi";
ob_start();
include('./config/connect.php');


$queryKelas = "SELECT id_kelas, nama_kelas FROM kelas";
$resultKelas = mysqli_query($conn, $queryKelas);
?>

<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Absensi Page</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            Data absensi berhasil ditambahkan!
        </div>
    <?php endif; ?>

    <form action="./actions/handleAbsensi.php" method="POST" class="bg-[#2d2d2d] p-4 rounded-lg shadow-lg">
        <!-- Class Dropdown -->
        <div class="mb-4">
            <label for="id_kelas" class="block text-sm font-medium">Kelas:</label>
            <select id="id_kelas" name="id_kelas" class="w-full px-3 py-2 bg-[#1d1d1d] rounded text-white" required>
                <option value="">Pilih Kelas</option>
                <?php
                if ($resultKelas && mysqli_num_rows($resultKelas) > 0) {
                    while ($row = mysqli_fetch_assoc($resultKelas)) {
                        echo "<option value='{$row['id_kelas']}'>{$row['nama_kelas']}</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada kelas tersedia</option>";
                }
                ?>
            </select>
        </div>

        <!-- Student Dropdown -->
        <div class="mb-4">
            <label for="id_siswa" class="block text-sm font-medium">Nama:</label>
            <select id="id_siswa" name="id_siswa" class="w-full px-3 py-2 bg-[#1d1d1d] rounded text-white" required>
                <option value="">Pilih Nama Siswa</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" class="w-full px-3 py-2 bg-[#1d1d1d] rounded text-white"
                required>

        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium">Status:</label>
            <select id="status" name="status" class="w-full px-3 py-2 bg-[#1d1d1d] rounded text-white" required>
                <option value="Hadir">Hadir</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-violet-600 rounded hover:bg-violet-800">Submit</button>
    </form>
</div>

<script>
    document.getElementById('id_kelas').addEventListener('change', function () {
        const idKelas = this.value;
        const siswaDropdown = document.getElementById('id_siswa');

        if (idKelas) {
            fetch(`./actions/handleGetSiswaByKelas.php?id_kelas=${idKelas}`)
                .then(response => response.json())
                .then(data => {
                    siswaDropdown.innerHTML = '<option value="">Pilih Nama Siswa</option>';
                    data.forEach(siswa => {
                        const option = document.createElement('option');
                        option.value = siswa.id_siswa;
                        option.textContent = siswa.nama_siswa;
                        siswaDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        } else {
            siswaDropdown.innerHTML = '<option value="">Pilih Nama Siswa</option>';
        }
    });
</script>

<?php
$content = ob_get_clean();
include('./index.php');
?>