<?php

// Function to fetch attendance records for a specific class
function getAttendanceByClass($id_kelas)
{
    global $conn;

    $queryKelas = "SELECT nama_kelas FROM kelas WHERE id_kelas = '$id_kelas'";
    $queryAbsensi = "
        SELECT 
            absensi.id_absensi,
            siswa.nama_siswa,
            absensi.tanggal,
            absensi.status
        FROM 
            absensi
        JOIN 
            siswa ON absensi.id_siswa = siswa.id_siswa
        WHERE 
            siswa.id_kelas = '$id_kelas'
    ";

    $resultKelas = mysqli_query($conn, $queryKelas);
    $resultAbsensi = mysqli_query($conn, $queryAbsensi);

    return [
        'kelas' => $resultKelas,
        'absensi' => $resultAbsensi
    ];
}
?>