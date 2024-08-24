<?php
  require_once '../Stripe/init.php';

  sendReservation(nouvelleReservation($_GET["q"], $_GET["i"], $_GET["p"], $_GET["email"],$_GET["date"], $_GET["heure"]));
      


  function novelleReservation($quantity, $idstripe, $unitprice, $email, $date, $heure): int //int =  retourne un int
  {
    $sdbh = connectionBdd();
    $query = $sdbh->prepare("SELECT count(rowid) as total FROM orders");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $rowid = $result["total"] + 1;
    $attraction = getAttractionIdByStripeId($idstripe);
    $total = $unitPrce * $quantity;
    $query = $dbh -> prepare("INSERT INTO reservations (id, attractionid, montant, nombrepersones, date, heure, emailachteur) VALUES(:id, :attraction,:montant, :quantity, :date, :heure, :email)");
    $query -> bindParam(':id', $rowid);
    $query -> bindParam(':attraction',$attrction);
    $query -> bindParam(':montant', $total);
    $query -> bindParam(':quantity', $quantity);
    $query -> bindParam(':date', $date);
    $query -> bindParam(':heure', $heure);
    $query -> bindParam(':email', $email);
    $query -> execute();

  return $rowid;
  }

  function getAttractionIdByStripeId($stripeid): int 
  {
    $query = $dbh -> prepare("SELECT id FROM attraction where idstripe = :idstripe");
    $query -> bindParam(':idstripe', $stripeid);
    $query -> execute();
    $result = $query -> fetch();
    return $result['id'];
  }

  function sendreservation($id)
  {
    //construire le pdf avec fpdf ou un truc du genre 
    //envoiyer par mail
    //ou telecharger
    //ou les deux
  }
?>