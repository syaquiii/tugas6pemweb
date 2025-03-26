<?php
include('../config/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id_siswa']) && !empty($_POST['tanggal']) && !empty($_POST['status'])) {
        $id_siswa = mysqli_real_escape_string($conn, $_POST['id_siswa']);
        $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);


        $query = "INSERT INTO absensi (id_siswa, tanggal, status) VALUES ('$id_siswa', '$tanggal', '$status')";

        if (mysqli_query($conn, $query)) {
            header('Location: ../absensi.php?success=1');
            exit();
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Semua field harus diisi.";
    }
} else {

    header('Location: ../absensi.php');
    exit();
}
?>