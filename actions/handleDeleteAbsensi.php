<?php
include('../config/connect.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize POST data
    $id_absensi = isset($_POST['id_absensi']) ? mysqli_real_escape_string($conn, $_POST['id_absensi']) : null;

    if ($id_absensi) {
        // Delete query
        $query = "DELETE FROM absensi WHERE id_absensi = '$id_absensi'";
        if (mysqli_query($conn, $query)) {
            echo json_encode(['success' => true, 'message' => 'Absensi berhasil dihapus!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Kesalahan pada database: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID absensi tidak valid.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode permintaan tidak valid.']);
}
exit;