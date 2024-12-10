
 <?php
 session_start();
 require_once ("connect.php");
 if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['psw'])){
    try {
 
     $stmt = $conn->prepare("INSERT INTO www6 (jmeno, prijmeni, email, telefon, heslo)
   VALUES (:jmeno, :prijmeni, :email, :telefon, :heslo)");
   $stmt->bindParam(':jmeno', $_POST['fname']);
   $stmt->bindParam(':prijmeni', $_POST['lname']);
   $stmt->bindParam(':email', $_POST['email']);
   $stmt->bindParam(':telefon', $_POST['phone']);
   $stmt->bindParam(':heslo', $_POST['psw']);
 
   $stmt -> execute();
 
   echo "Registrace probehla uspesne";
   $_SESSION["jmeno"] = $_POST['fname'];
   header("Location: index.php");
   
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

