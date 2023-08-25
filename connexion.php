<?php 
session_start();
//on require le footer pour le pied de page
require_once('footer.php');
//la connection a la base de donnes
require_once('connect.php');
//variables d'erreur
$messageErreur = '';
// condition du bouton d'envoi
if(isset($_POST['envoi'])){
    $CHOIX_TYPE_COMPTE = $_POST['CHOIX_TYPE_COMPTE'];
    $NOM_UTILISATEUR = $_POST['NOM_UTILISATEUR'];
    $MOT_DE_PASSE = $_POST['MOT_DE_PASSE'];


    if($CHOIX_TYPE_COMPTE=='ADMIN'){
        if(($NOM_UTILISATEUR !== "" && $MOT_DE_PASSE !== "") )
        {
            //on excute la requete si les champs ne sont pas vide
            $REQ = 'SELECT ID_COMPTE,ID_TYPE_COMPTE FROM ADMINISTRATEUR WHERE NOM_UTILISATEUR=? AND MOT_DE_PASSE = ?';
            $stn = $db->prepare($REQ);
            $stn->execute(array($NOM_UTILISATEUR,$MOT_DE_PASSE));
            $result = $stn->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $ID){
                $_SESSION['ID_COMPTE']=$ID['ID_COMPTE'];
                $_SESSION['ID_TYPE_COMPTE']=$ID['ID_TYPE_COMPTE'];
                echo $_SESSION['ID_COMPTE'];
                echo $_SESSION['ID_TYPE_COMPTE'];

            }
            //requete de selection dans la base de donnees 
            $requete = 'SELECT * FROM ADMINISTRATEUR WHERE NOM_UTILISATEUR=? AND MOT_DE_PASSE = ?';
            
            //initiation de l'execution de la requete
            $stmt = $db->prepare($requete);
            $stmt->execute(array($NOM_UTILISATEUR,$MOT_DE_PASSE));
            $reponse = $stmt->fetch(PDO::FETCH_OBJ);
            if($reponse>0){  
                // nom d'utilisateur et mot de passe correctes 
                $_SESSION['NOM_UTILISATEUR'] = $NOM_UTILISATEUR;
                header("location:index.php");
            }else{
                $messageErreur = "Nom Utilisateur ou mot de passe incorrecte!!! si vous n'avez pas encore de compte veuillez vous conecter!!!";
            }
        }
    }else{
        if(($NOM_UTILISATEUR !== "" && $MOT_DE_PASSE !== "") )
        {
            //on excute la requete si les champs ne sont pas vide
            $REQ = 'SELECT ID_COMPTE,ID_TYPE_COMPTE FROM secretaire WHERE NOM_UTILISATEUR=? AND MOT_DE_PASSE = ?';
            $stn = $db->prepare($REQ);
            $stn->execute(array($NOM_UTILISATEUR,$MOT_DE_PASSE));
            $result = $stn->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $info){
                $id = $info["ID_COMPTE"];
                $_SESSION['ID_COMPTE']=$id;
                $id_type_compte = $info["ID_TYPE_COMPTE"];
                $_SESSION['ID_TYPE_COMPTE'] = $id_type_compte;
                
            }
                //requete de selection dans la base de donnees 
                $requete = 'SELECT * FROM secretaire WHERE NOM_UTILISATEUR=? AND MOT_DE_PASSE = ?';
                
                //initiation de l'execution de la requete
                $stmt = $db->prepare($requete);
                $stmt->execute(array($NOM_UTILISATEUR,$MOT_DE_PASSE));
                $reponse = $stmt->fetch(PDO::FETCH_OBJ);
                if($reponse>0){  
                    // nom d'utilisateur et mot de passe correctes 
                    $_SESSION['NOM_UTILISATEUR'] = $NOM_UTILISATEUR;   
                    $_SESSION['ID_TYPE_COMPTE'] = $id_type_compte;
                    header("location:indexset.php");
                }else{
                    $messageErreur = "Nom Utilisateur ou mot de passe incorrecte!!! si vous n'avez pas encore de compte veuillez vous conecter!!!";
                }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">

</head>
<body>
    <div class="container">
       <div class="row mt-5 py-5  justify-content-center align-items-center w-100">
            <form action="" method="post" class="w-75 bg-light mt-3 py-4">
                <h1 class="text-center text-info text-uppercase">connexion</h1>
                <h5 class="text-center text-danger mt-4"><?php echo $messageErreur ?></h5>
                <div class="mt-3">
                    <label for="CHOIX_TYPE_COMPTE" class="form-label" aria-label="Default select">TYPE DE COMPTE</label>
                    <select name="CHOIX_TYPE_COMPTE" id="CHOIX_TYPE_COMPTE" class="form-select">
                        <option value="ADMIN">ADMINISTRATEUR</option>
                        <option value="SECRET">SECRETAIRE</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="NOM_UTILISATEUR" class="form-label">NOM UTILISATEUR</label>
                    <input type="text" name="NOM_UTILISATEUR" id="NOM_UTILISTEUR" class="form-control">
                </div>
        
                <div class="mt-3">
                    <label for="MOT_DE_PASSE" class="form-label">MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE" id="MOT_DE_PASSE" class="form-control">
                </div>
                <div class="mt-3 d-flex justify-content-center  justify-content-center align-items-center w-100">
                    <input type="submit" value="valider" class="btn btn-success w-50" name="envoi">
                </div>
            </form>
       </div>
    </div>   
</body>
</html>
