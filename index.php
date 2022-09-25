<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagrindinis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">


        <?php if(isset($_SESSION["zinute"])) { ?>
            <div class="alert <?php echo $_SESSION["zinutes_stilius"]; ?>">
                <p><?php echo $_SESSION["zinute"]; ?></p>
            </div>
            <?php 
            unset($_SESSION["zinute"]); 
            unset($_SESSION["zinutes_stilius"]);
            ?>
        <?php } ?>
        <!-- if jeigu sausainis egzistuoja - forma paslepta, jei ne - forma matoma -->
        <form method="post" action="index.php">
            <input id="pris_form" class="form-control" name="vardas" type="text" placeholder="Vardas">
            <input id="pris_form" class="form-control" type="password" name="slaptazodis" placeholder="Slaptazodis">
            <button id="pris_form" class="btn btn-primary" type="submit" name="prisijungti">Prisijungti</button>
        </form>    

    </div>
   

    <?php 
    //tikriname, ar jungiamasi 3 karta 
    $i = $_COOKIE["skaitiklis"];
    if(isset($_COOKIE["skaitiklis"]) && ($i>=3) )
    {
        echo '<style>.form-control { display:none;}</style>';
        echo "Palaukite 60 sekundziu";
    }

    //tikriname ar mygtukas paspaustas
    if(isset($_POST["prisijungti"])) {
        setcookie("skaitiklis", 0,time()+3*3600);
        $vardas = $_POST["vardas"];
        $slaptazodis = $_POST["slaptazodis"];

        // geras vardas ir geras slaptazods
        $gVardas = "admin";
        $gSlaptazodis = "123";
    
        if($vardas == $gVardas && $slaptazodis == $gSlaptazodis) {
            $_SESSION["arPrisijunges"] = 1;
            $_SESSION["vardas"] = $vardas;
            setcookie("skaitiklis", 0,time()+3*3600);
            header("Location: manopaskyra.php");
        } else {

    //SKAITIKLIS
        //         if(!isset($_COOKIE["skaitiklis"])) {
        //         $i = $_COOKIE["skaitiklis"];
        //         }
        //             if ($i>3){

        //             }

        // $i = 0;
        //     $i = $_COOKIE["skaitiklis"];
        //     $i++;

        //     if(!isset($_COOKIE["skaitiklis"])) {
        //         setcookie("skaitiklis", 0,time()+3*3600);
        //         $i = 0;
        //     } else {
        //         $i = $_COOKIE["skaitiklis"];
        //         $i++;
        //         setcookie("skaitiklis", $i,time()+3*3600);
        // echo $i;

        //     }
    //SKAITIKLIS
    
            //zinute turi buti raudona
            //ir kitoks tekstas
            //Sesijos skaitiklis
            // Sesijos skaitiklis $_SESSION["skaitiklis"]++
            //$_SESSION["skaitiklis"] == 3
            //susikurti sausainiukas kuris galiotu 60sec
            $_SESSION["zinute"] = "Neteisingi prisijungimo duomenys";
            $_SESSION["zinutes_stilius"] = "alert-danger";
            $i++;
            setcookie("skaitiklis", $i,time()+60);
            header("Location: 404.php");
        }

    }
    
    ?>

</body>
</html>