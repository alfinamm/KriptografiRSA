<!DOCTYPE html>
<html>
    <head>
        <title>Hasil Kriptografi RSA</title>
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col s12 m10 offset-m1">
                    <div class="card white z-depth-2">
                        <div class="card-content teal-text">
                            <h4 class="teal-text text-darken-4 center">Hasil Kriptografi RSA</h4>
                            <?php
                                // Fungsi mengecek bilangan prima
                                function isPrime($num) {
                                    if ($num < 2) return false;
                                    for ($i = 2; $i <= sqrt($num); $i++) {
                                        if ($num % $i == 0) return false;
                                    }
                                    return true;
                                }

                                // Fungsi Extended Euclidean untuk menghitung kunci privat
                                function modInverse($e, $phi) {
                                    $m0 = $phi;
                                    $y = 0; $x = 1;

                                    while ($e > 1) {
                                        $q = intdiv($e, $phi); // Hasil bagi
                                        $t = $phi;

                                        // Perbarui phi dan e
                                        $phi = $e % $phi;
                                        $e = $t;
                                        $t = $y;

                                        // Perbarui x dan y
                                        $y = $x - $q * $y;
                                        $x = $t;
                                    }

                                    // Pastikan x positif
                                    if ($x < 0) {
                                        $x += $m0;
                                    }

                                    return $x;
                                }

                                // Fungsi untuk menghitung gcd (greatest common divisor)
                                function gcd($a, $b) {
                                    while ($b != 0) {
                                        $temp = $b;
                                        $b = $a % $b;
                                        $a = $temp;
                                    }
                                    return $a;
                                }

                                // Fungsi untuk menghitung modular exponentiation
                                function modExp($base, $exp, $mod) {
                                    $result = 1;
                                    while ($exp > 0) {
                                        if ($exp % 2 == 1) {
                                            $result = ($result * $base) % $mod;
                                        }
                                        $base = ($base * $base) % $mod;
                                        $exp = intdiv($exp, 2);
                                    }
                                    return $result;
                                }

                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $p = $_POST['prima-1'];
                                    $q = $_POST['prima-2'];
                                    $e = $_POST['public'];
                                    $plainteks = $_POST['plainteks'];

                                    // Validasi bilangan prima
                                    if (!is_numeric($p) || !is_numeric($q) || $p <= 1 || $q <= 1) {
                                        echo "<p style='color:red;'>Bilangan p dan q tidak valid.</p>";
                                        exit;
                                    }

                                    // Validasi jika p atau q bukan bilangan prima
                                    if (!isPrime($p) || !isPrime($q)) {
                                        echo "<p style='color:red;'>Bilangan p dan q harus bilangan prima!</p>";
                                        exit;
                                    }

                                    // Validasi jika p dan q sama
                                    if ($p == $q) {
                                        echo "<p style='color:red;'>Bilangan p dan q tidak boleh sama!</p>";
                                        exit;
                                    }

                                    // Hitung n dan phi(n)
                                    $n = $p * $q;
                                    $phi = ($p - 1) * ($q - 1);

                                    // Validasi kunci publik (e)
                                    if (gcd($e, $phi) != 1) {
                                        echo "<p style='color:red;'>Kunci publik (e) harus relatif prima terhadap phi(n).</p>";
                                        exit;
                                    }

                                    // Hitung kunci privat (d)
                                    $d = modInverse($e, $phi);

                                    // Konversi plainteks ke ASCII
                                    $ascii_values = [];
                                    foreach (str_split($plainteks) as $char) {
                                        $ascii_values[] = ord($char);
                                    }

                                    // Enkripsi plainteks
                                    $encrypted = [];
                                    foreach ($ascii_values as $ascii) {
                                        $encrypted[] = modExp($ascii, $e, $n);
                                    }

                                    // Dekripsi ciphertext
                                    $decrypted = [];
                                    foreach ($encrypted as $cipher) {
                                        $decrypted[] = modExp($cipher, $d, $n);
                                    }

                                    // Konversi kembali hasil dekripsi ke karakter
                                    $decrypted_text = '';
                                    foreach ($decrypted as $ascii) {
                                        $decrypted_text .= chr($ascii);
                                    }

                                    // Tampilkan hasil
                                    echo "
                                    <table class='striped'>
                                        <tbody>
                                            <tr><td><strong>Bilangan Prima Pertama (p):</strong></td><td>$p</td></tr>
                                            <tr><td><strong>Bilangan Prima Kedua (q):</strong></td><td>$q</td></tr>
                                            <tr><td><strong>n (p x q):</strong></td><td>$n</td></tr>
                                            <tr><td><strong>phi(n):</strong></td><td>$phi</td></tr>
                                            <tr><td><strong>Kunci Publik (e):</strong></td><td>$e</td></tr>
                                            <tr><td><strong>Kunci Privat (d):</strong></td><td>$d</td></tr>
                                            <tr><td><strong>Plainteks ASCII:</strong></td><td>" . implode(' ', $ascii_values) . "</td></tr>
                                            <tr><td><strong>Hasil Enkripsi:</strong></td><td>" . implode(' ', $encrypted) . "</td></tr>
                                            <tr><td><strong>Hasil Dekripsi:</strong></td><td>$decrypted_text</td></tr>
                                        </tbody>
                                    </table>
                                    ";
                                }
                            ?>
                            <div class="row center">
                                <a href="index.php" class="btn waves-effect waves-light teal darken-2">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
