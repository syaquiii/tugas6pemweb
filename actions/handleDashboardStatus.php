<?php



function getDashboardStats($selectedDate = null)
{
    global $conn;

    $query = "
        SELECT 
            kelas.id_kelas,
            kelas.nama_kelas,
            COUNT(CASE WHEN absensi.status = 'Hadir' THEN 1 END) AS total_hadir,
            COUNT(siswa.id_siswa) AS total_siswa
        FROM 
            kelas
        LEFT JOIN 
            siswa ON kelas.id_kelas = siswa.id_kelas
        LEFT JOIN 
            absensi ON siswa.id_siswa = absensi.id_siswa
        " . ($selectedDate ? "WHERE absensi.tanggal = '$selectedDate'" : "") . "
        GROUP BY 
            kelas.id_kelas
    ";

    $result = mysqli_query($conn, $query);
    return $result;
}
?>