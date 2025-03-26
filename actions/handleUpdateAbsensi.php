<?php
include('../config/connect.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate POST data
    if (isset($_POST['id_absensi']) && isset($_POST['tanggal']) && isset($_POST['status'])) {
        $id_absensi = mysqli_real_escape_string($conn, $_POST['id_absensi']);
        $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // Update query
        $updateQuery = "UPDATE absensi SET tanggal = '$tanggal', status = '$status' WHERE id_absensi = '$id_absensi'";
        if (mysqli_query($conn, $updateQuery)) {
            echo json_encode(['success' => true, 'message' => 'Absensi berhasil diperbarui.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Kesalahan pada database: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode permintaan tidak valid.']);
}
exit;