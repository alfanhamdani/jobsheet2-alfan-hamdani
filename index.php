<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Usia</title>
</head>
<body>

<?php
// Fungsi untuk menghitung usia berdasarkan tanggal lahir
function hitungUsia($tanggal_lahir) {
    $tgl_lahir = new DateTime($tanggal_lahir);
    $tgl_sekarang = new DateTime();
    $selisih = $tgl_sekarang->diff($tgl_lahir);

    return $selisih->y;
}

// Fungsi untuk menentukan kategori usia
function kategoriUsia($usia) {
    if ($usia < 12) {
        return "Anak-anak";
    } elseif ($usia < 18) {
        return "Remaja";
    } elseif ($usia < 60) {
        return "Dewasa";
    } else {
        return "Lansia";
    }
}

// Mengolah inputan jika form dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan array tanggal lahir dari form
    $tanggal_lahir_array = $_POST["tanggal_lahir"];

    // Menampilkan hasil usia dan kategori untuk setiap tanggal lahir
    echo "<h2>Hasil Perhitungan Usia:</h2>";
    for ($i = 0; $i < count($tanggal_lahir_array); $i++) {
        $tanggal_lahir = $tanggal_lahir_array[$i];

        // Validasi input tanggal lahir
        if (!empty($tanggal_lahir)) {
            $usia = hitungUsia($tanggal_lahir);
            $kategori = kategoriUsia($usia);

            echo "Usia untuk tanggal lahir ke-$i: $usia tahun (Kategori: $kategori)<br>";

            // Menampilkan pesan tambahan berdasarkan kategori usia
            if ($kategori == "Anak-anak") {
                echo "Selamat menikmati masa kecil Anda!<br>";
            } elseif ($kategori == "Remaja") {
                echo "Semangat menjalani masa remaja!<br>";
            } elseif ($kategori == "Dewasa") {
                echo "Selamat meniti jalan kehidupan sebagai dewasa!<br>";
            } else {
                echo "Semoga sehat selalu di masa tua!<br>";
            }
        } else {
            echo "Mohon isi tanggal lahir untuk entri ke-$i.<br>";
        }
    }
}
?>

<!-- Form input tanggal lahir -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Input Tanggal Lahir</h2>
    <?php
    // Menampilkan 3 input tanggal lahir
    for ($i = 0; $i < 3; $i++) {
        echo "<label for='tanggal_lahir[$i]'>Tanggal Lahir ke-$i:</label>";
        echo "<input type='date' id='tanggal_lahir[$i]' name='tanggal_lahir[]'><br>";
    }
    ?>
    <button type="submit">Hitung Usia</button>
</form>

</body>
</html>
