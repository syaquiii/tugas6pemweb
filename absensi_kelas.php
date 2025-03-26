<?php
include('./config/connect.php');
include('./actions/handleAbsensiKelas.php');

$title = "Absensi Kelas";
ob_start();

$id_kelas = isset($_GET['id_kelas']) ? mysqli_real_escape_string($conn, $_GET['id_kelas']) : null;
$data = getAttendanceByClass($id_kelas);

$namaKelas = $data['kelas'] && mysqli_num_rows($data['kelas']) > 0 ? mysqli_fetch_assoc($data['kelas'])['nama_kelas'] : 'Unknown';
$resultAbsensi = $data['absensi'];
?>

<div class="py-16 px-10 h-full">
    <?php if (isset($_GET['update_success'])): ?>
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            Absensi berhasil diperbarui!
        </div>
    <?php elseif (isset($_GET['update_error'])): ?>
        <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
            Terjadi kesalahan saat memperbarui absensi.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['delete_success'])): ?>
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            Absensi berhasil dihapus!
        </div>
    <?php elseif (isset($_GET['delete_error'])): ?>
        <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
            Terjadi kesalahan saat menghapus absensi.
        </div>
    <?php endif; ?>



    <h1 class="text-3xl font-bold mb-2">Absensi <?= htmlspecialchars($namaKelas); ?></h1>

    <table class="table-auto w-full text-white">
        <thead class="bg-[#2d2d2d]">
            <tr>
                <th class="px-4 py-2 text-left">Nama Siswa</th>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultAbsensi && mysqli_num_rows($resultAbsensi) > 0) {
                while ($row = mysqli_fetch_assoc($resultAbsensi)) {
                    $idAbsensi = htmlspecialchars($row['id_absensi']);
                    echo "
                        <tr class='bg-[#1d1d1d]'>
                            <td class='px-4 py-2'>{$row['nama_siswa']}</td>
                            <td class='px-4 py-2'>{$row['tanggal']}</td>
                            <td class='px-4 py-2'>{$row['status']}</td>
                            <td class='px-4 py-2'>
                                <button 
                                    onclick=\"openModal('{$idAbsensi}', '{$row['tanggal']}', '{$row['status']}')\" 
                                    class='text-blue-500 hover:underline'
                                >
                                    Update
                                </button>
                                <button 
                                    onclick=\"deleteAbsensi('{$idAbsensi}', '{$row['tanggal']}', '{$row['status']}')\" 
                                    class='text-red-500 hover:underline'
                                >
                                    delete
                                </button>
        

                            </td>
                        </tr>
                        ";
                }
            } else {
                echo "
                    <tr>
                        <td colspan='4' class='px-4 py-2 text-center'>Tidak ada data absensi.</td>
                    </tr>
                    ";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="updateModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-[#2d2d2d] p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4 text-white">Update Absensi</h2>
        <form id="updateForm" method="POST" action="./actions/handleUpdateAbsensi.php">
            <input type="hidden" id="modal-id-absensi" name="id_absensi" />

            <div class="mb-4">
                <label for="modal-tanggal" class="block text-sm font-medium text-white">Tanggal:</label>
                <input type="date" id="modal-tanggal" name="tanggal"
                    class="w-full px-3 py-2 bg-gray-200 rounded text-black" required>
            </div>
            <div class="mb-4">
                <label for="modal-status" class="block text-sm font-medium text-white">Status:</label>
                <select id="modal-status" name="status" class="w-full px-3 py-2 bg-gray-200 rounded text-black">
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()"
                    class="mr-3 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-800">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded hover:bg-violet-800">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>





<script>

    function openModal(id, tanggal, status) {
        document.getElementById('modal-id-absensi').value = id;
        document.getElementById('modal-tanggal').value = tanggal;
        document.getElementById('modal-status').value = status;
        document.getElementById('updateModal').classList.remove('hidden');
    }

    function deleteAbsensi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            fetch('./actions/handleDeleteAbsensi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_absensi=${encodeURIComponent(id)}`
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Server response:', data); // Log the response for debugging
                    if (data.success) {
                        alert(data.message); // Notify user of success
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert(data.message); // Notify user of failure
                    }
                })
                .catch(error => {
                    console.error('Error during fetch:', error); // Log server errors
                    alert('Terjadi kesalahan pada server.');
                });
        }
    }

    function closeModal() {
        document.getElementById('updateModal').classList.add('hidden');
    }
    function deleteAbsensi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            fetch('./actions/handleDeleteAbsensi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_absensi=${encodeURIComponent(id)}`
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Server response:', data); // Log the response for debugging
                    if (data.success) {
                        alert(data.message); // Notify user
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert(data.message); // Notify user of failure
                    }
                })
                .catch(error => {
                    console.error('Error during fetch:', error);
                    alert('Terjadi kesalahan pada server.'); // Notify user of server error
                });
        }
    }


    document.getElementById('updateForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        fetch('./actions/handleUpdateAbsensi.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data); // Log the response for debugging
                if (data.success) {
                    alert(data.message); // Notify user of success
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert(data.message); // Notify user of failure
                }
            })
            .catch(error => {
                console.error('Error during fetch:', error); // Log any errors
                alert('Terjadi kesalahan pada server.'); // Notify user of server error
            });
    });

</script>
<?php
$content = ob_get_clean();
include('./index.php');
?>