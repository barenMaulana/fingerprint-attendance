<?php
require 'connectDB.php';
date_default_timezone_set('Asia/Jakarta');
$d = date("Y-m-d");
$t = date("H:i:sa");

$TOKEN = "1569053999:AAGHDZmMTcSiKeJPsMBDnCWSS0Gw-U8944M";
$apiURL = "https://api.telegram.org/bot$TOKEN";
$update = json_decode(file_get_contents("php://input"), TRUE);

$chatID = $update["message"]["chat"]["id"];
$message = strtolower($update["message"]["text"]);

$pesan = "Hai, perkenalkan saya adalah <strong>SIBOT</strong> absensi bot dapat membantu anda dalam mengetahui informasi absensi putra/putri anda di sekolah. Beberapa perintah yang dapat digunakan : <pre><b>kelas 7A</b></pre> <pre><b>kelas 7B</b></pre> <pre><b>kelas 7C</b></pre> <pre><b>kelas 8A</b></pre> <b>cara menggunakannya dengan mengirim salah satu kelas yang tersedia kepada sibot, maka sibot akan memberi informasi tentang kehadiran setiap kelas</b>";
$pesanbiasa = "halo";

if (strpos($message, "/start") === 0) {
    file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=" . $pesan . "&parse_mode=html");
} else {
    $kelas = "";
    switch ($message) {
        case 'kelas 7a':
            $kelas = "7A";
            break;
        case 'kelas 7b':
            $kelas = "7B";
            break;
        case 'kelas 7c':
            $kelas = "7C";
            break;
        case 'kelas 8a':
            $kelas = "8A";
            break;
        case 'kelas 8b':
            $kelas = "8B";
            break;
        case 'kelas 8c':
            $kelas = "8C";
            break;
        case 'kelas 9a':
            $kelas = "9A";
            break;
        case 'kelas 9b':
            $kelas = "9B";
            break;
        case 'kelas 9c':
            $kelas = "9C";
            break;
        default:
            $kelas = "undefined";
            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Kelas tidak ditemukan");
            break;
    }
    if ($kelas != "undefined") {
        $query = mysqli_query($conn, "SELECT * FROM users_logs WHERE checkindate='$d' AND student_class='$kelas'");
        $isRow =  mysqli_num_rows($query);
        $result = [];
        if ($isRow != 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $result[] = $row;
            }
            $informasi = "NAMA       KELAS       MASUK       PULANG  ";
            $report = "";
            for ($i = 0; $i < count($result); $i++) {
                $report .= $result[$i]["username"] . "         " . $result[$i]["student_class"] . "            " . $result[$i]["timein"] . "         " . $result[$i]["timeout"] . "          ";
            }
            $informasi .= $report;
            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=" . $informasi);
        } else {
            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Belum ada yang absen");
        }
    }
}
