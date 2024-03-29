<?php
require 'data/conn.php';

function getAllFiche(){
    $sql = 'SELECT f.ID, et.libelle, f.moisAnnee, f.nbJustificatifs, f.montantValide, f.dateModif
            FROM fichefrais AS f
            LEFT JOIN etat AS et ON f.etat_id = et.id
            LEFT JOIN employer AS em ON f.employer_id = em.matricule';

    $conn = connDB();
    $req = $conn->prepare($sql);
    $req->execute();
    return $req->fetchAll($conn::FETCH_ASSOC);
}

function getFicheBy($idUser){
    $sql = 'SELECT f.ID, et.libelle, f.moisAnnee, f.nbJustificatifs, f.montantValide, f.dateModif
            FROM fichefrais AS f
            LEFT JOIN etat AS et ON f.etat_id = et.id
            LEFT JOIN employer AS em ON f.employer_id = em.matricule
            WHERE f.employer_id = :matricule';
    
    $conn = connDB();
    $req = $conn->prepare($sql);
    $req->bindParam('matricule', $idUser);
    $req->execute();
    return $req->fetchAll($conn::FETCH_ASSOC);
}

function getAllHForfait($idfichefrais){
    $sql = 'SELECT *
        FROM lignefraishorsforfait
        WHERE fichefrais_id = :idfichefrais';
    
    $conn = connDB();
    $req = $conn->prepare($sql);
    $req->bindParam('idfichefrais', $idfichefrais);
    $req->execute();
    return $req->fetchAll($conn::FETCH_ASSOC);
}

function getAllFraisForfait($idfichefrais){
    $sql = 'SELECT * FROM fraisforfait f WHERE fichefrais_id=:idfichefrais';
    
    $conn = connDB();
    $req = $conn->prepare($sql);
    $req->bindParam('idfichefrais', $idfichefrais);
    $req->execute();
    return $req->fetchAll($conn::FETCH_ASSOC);
}


function createFrais($repasLib,$repasMontant,$repasQuantite,$nuitLib,$nuitMontant,$kilomLib,$kilomMontant,$kilomQuantite,$fraisHF,$total){
    $sql = 'INSERT INTO fichefrais (moisAnnee, nbJustificatifs, montantValide, dateModif, etat_id, employer_id)VALUES(CONCAT(MONTH(NOW()),"-",YEAR(NOW())), 0, 0)';
    $conn = connDB();
    $req = $conn->prepare($sql);
    $req->bindParam(':dateFrais', $dateFrais);
    $req->bindParam(':coutFrais', $coutFrais);
    $req->bindParam(':nomFrais', $nomFrais);
    $req->bindParam(':idFrais', $idFrais);
    $req->execute();
}
?>
