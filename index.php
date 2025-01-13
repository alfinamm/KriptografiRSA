<!DOCTYPE html>
<html>
    <head>
        <title>Kriptografi RSA</title>
        <!-- Materialize CSS -->
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div class="card white z-depth-2">
                        <div class="card-content teal-text">
                            <h4 class="teal-text text-darken-4 center">Kriptografi RSA</h4>
                            <p class="center">Masukkan data berikut untuk melakukan proses enkripsi dan dekripsi menggunakan algoritma RSA.</p>
                            <form action="hasil.php" method="POST">
                                <!-- Input bilangan prima pertama -->
                                <div class="row">
                                    <div class="input-field col s6">
                                        <label for="prima-1">Bilangan Prima Pertama (p)</label>
                                        <input id="prima-1" type="number" name="prima-1" required>
                                    </div>
                                    <div class="input-field col s6">
                                        <label for="prima-2">Bilangan Prima Kedua (q)</label>
                                        <input id="prima-2" type="number" name="prima-2" required>
                                    </div>
                                </div>
                                <!-- Input kunci publik -->
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="public">Kunci Publik (e)</label>
                                        <input id="public" type="number" name="public" required>
                                    </div>
                                </div>
                                <!-- Input plainteks -->
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="plainteks">Plainteks</label>
                                        <textarea id="plainteks" name="plainteks" class="materialize-textarea" required></textarea>
                                    </div>
                                </div>
                                <!-- Tombol submit -->
                                <div class="row center">
                                    <button type="submit" class="btn waves-effect waves-light teal darken-2">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambahkan Materialize JS -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
