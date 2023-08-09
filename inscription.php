<?php
session_start();
//require once le fichier conect pour la connexion a la base de dennees
require_once('connect.php');
$erreur_nom = '';
$erreur_email = '';
$erreur_numero = '';
$erreur_cni = '';
$erreur_adresse = '';
$erreur_date = '';
$MESSAGE_SUCCESS='';
$date_naiss= 0;
$date_actuel= date('Y');
$age = 0;
if(isset($_POST['envoyer'])){
    $CNI = $_POST['CNI'];
    $NUMERO_TEL = $_POST['NUMERO_TEL'];
    $EMAIL = $_POST['EMAIL'];
    $NOM_PRENOMS = $_POST['NOM_PRENOMS'];
    $DATE_NAISSANCE = $_POST['DATE_NAISSANCE'];
    $SEXE = $_POST['SEXE'];
    $ADRESSE = $_POST['ADRESSE'];
    $age = $date_actuel - $date_naiss;
    if(strlen($NOM_PRENOMS)<=8 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $NOM_PRENOMS) && (strlen($EMAIL)<=8) && empty($EMAIL) && (strlen($NUMERO_TEL)<9) && strlen($CNI)<=8
    && $age <= 17 && strlen($NOM_PRENOMS)<=4 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $ADRESSE)){
        // && empty($NUMERO_TEL) && empty($EMAIL) && empty($CNI) && empty($DATE_NAISSANCE) && empty($ADRESSE)
        $erreur_nom= "veillez remplir le champ d'au moins 9 caracteres";
        $erreur_email = "l'email est mal renseigner";
        $erreur_numero = "le numero est incorrect";
        $erreur_date = "l'age est inferieur a la normal";
        $erreur_cni = "le numero  de la cni est incorrect";
        $erreur_adresse = "l'adresse est mal ecrit ";

    }
    else{
        $MESSAGE_SUCCESS = "LE FORMULAIRE  A ETE SOUMIS AVEC SUCCESS";
    }


}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription personnel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
</head>
<body>
    <div class="container">
        
        <div class="row  justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="mt-3 w-75 bg-light">
                <h1 class ="text-center text-uppercase text-info mt-3 py-3">inscription personnel</h1>
                <div class="mt-3">

                    <label for="CNI" class="form-label">NUMERO DE CNI</label>
                    <input type="number" name="CNI" id="CNI" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_cni;?></h5>

                </div>
                <div class="mt-3">
                    <label for="NUMERO_TEL" class="form-label">NUMERO TELEPHONE</label>
                    <input type="number" name="NUMERO_TEL" id="NUMERO_TEL" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>

                </div>

                <div class="mt-3">
                    <label for="EMAIL" class="form-label">EMAIL</label>
                    <input type="email" name="EMAIL" id="EMAIL" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_email;?></h5>

                </div>

                <div class="mt-3">
                    <label for="NOM_PRENOMS" class="form-label">NOM ET PRENOM</label>
                    <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control">
                    <!-- affiche l'erreur si le nom et le prenom sont mal ecrit -->
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_nom;?></h5>
                </div>

                <div class="mt-3">
                    <label for="DATE_NAISSANCE" class="form-label">DATE DE NAISSANCE</label>
                    <input type="date" name="DATE_NAISSANCE" id="DATE_NAISSANCE" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_date;?></h5>

                </div>

                <div class="mt-3">
                    <label for="SEXE" class="form-label">SEXE</label>
                    <div class="form-check-inline ms-4">
                        <input type="radio" name="SEXE" id="SEXEh" class="form-check-input" checked>
                        <label for="SEXEh" class="form-check-label">HOMME</label>
                    </div>
                    <div class="form-check-inline  ms-4">
                        <input type="radio" name="SEXE" id="SEXEf" class="form-check-input">
                        <label for="SEXEf" class="form-check-label">FEMME</label>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="ADRESSE" class="form-label">ADRESSE</label>
                    <input type="text" name="ADRESSE" id="ADRESSE" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_adresse;?></h5>

                    
                </div> 
                <br>
                <h5 class="text-center text-success"><?php echo $MESSAGE_SUCCESS;?></h5> <br>
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <input type="submit" value="Envoyer" class="btn btn-success w-50" name="envoyer">
                </div> 
            </form>
        </div>
    </div>
</body>
</html>