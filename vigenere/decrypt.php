<?php
 if(isset($_POST["submit"])) {
    // process form data, send email, output message
 
    // $str = "rasamautau";
    // $key = "blog";

    $str = $_POST["encrypttext"];
    $key = $_POST["keytext"];
    
    // printf("Text: %s\n", $str);
    // printf("key:  %s\n", $key);
    
    // $cod = encipher($str, $key, true); 
    // printf("Code: %s\n", $cod);

    $dec = encipher($str, $key, false); 
    // printf("Back: %s\n", $dec);
    $result = $dec;
    // printf("ord:  %s\n", ord('B'));
    // printf("ord:  %s\n", ord('A'));
    
    

 }

 function encipher($src, $key, $is_encode)
    {
        $key = strtoupper($key);
        $src = strtoupper($src);
        $dest = '';
    
        /* strip out non-letters */
        for($i = 0; $i <= strlen($src); $i++) {
            $char = substr($src, $i, 1);
            if(ctype_upper($char)) {
                $dest .= $char;
            }
        }
    
        for($i = 0; $i <= strlen($dest); $i++) {
            $char = substr($dest, $i, 1);
            if(!ctype_upper($char)) {
                continue;
            }
            $dest = substr_replace($dest,
                chr (
                    ord('A') +
                    ($is_encode
                    ? ord($char) - ord('A') + ord($key[$i % strlen($key)]) - ord('A')
                    : ord($char) - ord($key[$i % strlen($key)]) + 26
                    ) % 26
                )
            , $i, 1);
        }
    
        return $dest;
    }
 
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Algoritme Vigenere Chiper</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Algoritme Vigenere Chiper</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Encrypt </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Decrypt <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <br>
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Encrypted text</label>
                <textarea class="form-control" name="encrypttext" id="exampleFormControlTextarea1" rows="3"
                    placeholder="masukkan encrypted text"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Key</label>
                <input type="text" class="form-control" name="keytext" id="keytext" aria-describedby="emailHelp"
                    placeholder="masukkan key text">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Decrypt" class="btn btn-info">
            </div>
        </form>

        <div class="card text-center">
            <div class="card-header">
                Hasil Decrypt
            </div>
            <div class="card-body">
                <p class="card-text">
                    <?php 
                if(isset($result)) {
                    echo "Encrypted Text: <b>". $str ."</b><br>";
                    echo "Key: <b>". $key . "</b><br>";
                    echo "Decrypted Text: <b>". $result ."</b><br>"; 
                }
                ?>
                </p>
                <!-- <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
            <div class="card-footer text-muted">
                coded with <span style="color: Tomato;"> <i class="fa fa-heart"></i> </span> by Rivaldi Rizalul Akhsan
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>