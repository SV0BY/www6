
 <?php
 session_start();
 require_once ("connect.php");
 if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['id']) && empty($_POST['ne'])){
    try {
 
     $stmt = $conn->prepare("INSERT INTO uzivatel (jmeno, prijmeni, id)
   VALUES (:jmeno, :prijmeni, :id)");
   $stmt->bindParam(':jmeno', $_POST['fname']);
   $stmt->bindParam(':prijmeni', $_POST['lname']);
   $stmt->bindParam(':id', $_POST['id']);
 
   $stmt -> execute();
 
   echo "Registrace probehla uspesne";
   $_SESSION["jmeno"] = $_POST['fname'];
   header("Location: stranka.php");
   
 }catch(PDOException $e){
     $errorInfo = $e->errorInfo; 
     if ($errorInfo[0] == '23000') {
          echo "Špatné ID";
     }else{
         echo "Chybna registrace " . "<br>" . $e -> getMessage();
     }
 } 
 }else{
     echo "Robotus";
 }
 
 
 $conn = null;

