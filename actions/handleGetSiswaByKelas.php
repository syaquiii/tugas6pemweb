<?php
include('../config/connect.php');

if (isset($_GET['id_kelas']) && !empty($_GET['id_kelas'])) {
    $id_kelas = mysqli_real_escape_string($conn, $_GET['id_kelas']);

    $query = "SELECT id_siswa, nama_siswa FROM siswa WHERE id_kelas = '$id_kelas'";
    $result = mysqli_query($conn, $query);

    $students = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
    }

    // Return JSON response
    echo json_encode($students);
} else {
    echo json_encode([]);
}
?>