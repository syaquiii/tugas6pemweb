<?php
include('./config/connect.php');
include('./actions/handleDashboardStatus.php'); // Include the function for filtering stats

$title = "Dashboard";
ob_start();

$selectedDate = isset($_GET['filter_date']) ? mysqli_real_escape_string($conn, $_GET['filter_date']) : null;
$result = getDashboardStats($selectedDate);
?>

<div class="py-16 px-10 h-full">
    <h1 class="text-3xl font-bold mb-2">Welcome to the Dashboard</h1>
    <h4 class="opacity-70 mb-8">Filter absensi berdasarkan tanggal</h4>

    <!-- Date Filter Form -->
    <form method="GET" action="./dashboard.php" class="mb-6">
        <div class="flex items-center">
            <label for="filter_date" class="mr-4 text-sm font-medium">Pilih Tanggal:</label>
            <div class="relative w-full max-w-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>

                <input type="date" id="filter_date" name="filter_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date" value="<?= htmlspecialchars($selectedDate ?? ''); ?>">
            </div>

            <button type="submit" class="ml-4 px-4 py-2 bg-violet-600 rounded hover:bg-violet-800 text-white">
                Filter
            </button>
        </div>
    </form>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $totalHadir = $row['total_hadir'];
                $totalSiswa = $row['total_siswa'];
                $percentage = $totalSiswa > 0 ? round(($totalHadir / $totalSiswa) * 100) : 0;

                echo "
            <a href='./absensi_kelas.php?id_kelas={$row['id_kelas']}' class='block p-4 bg-[#2d2d2d] rounded-lg shadow-lg hover:bg-violet-700'>
                <h2 class='text-xl font-semibold mb-2'>{$row['nama_kelas']}</h2>
                <p class='text-lg font-medium opacity-75'>Kehadiran: {$totalHadir}/{$totalSiswa} Siswa</p>
                
                <!-- Progress Bar -->
                <div class='w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700'>
                    <div 
                        class='bg-violet-600 h-2.5 rounded-full' 
                        style='width: {$percentage}%;'
                    ></div>
                </div>

                <p class='text-sm mt-2 text-gray-400'>Progress: {$percentage}%</p>
            </a>
            ";
            }
        } else {
            echo "<p class='text-center text-white'>Tidak ada data untuk tanggal yang dipilih.</p>";
        }
        ?>
    </div>

    <?php
    $content = ob_get_clean();
    include('./index.php'); // Include the layout
    ?>