<?php
class DB{
private $connect = NULL;


public function __construct()
  {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "charity_donation";
  $this->connect = "";
  try{
  $this->connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $this->connect->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
    }
  catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
        }  
  }
 //insert
 public function tbl_insert($tblquery,$tblvalue = array())
 { 
 try{
  $stmt = $this->connect->prepare($tblquery);
  $results = $stmt->execute($tblvalue);
   return $results; 
} catch(PDOException $e) {
   echo 'Insert Error: ' . $e->getMessage();
  }
    }
	//insert

  
 //Select
 public function tbl_select($tblquery,$tblvalue = array())
 { 
 try{
  $stmt = $this->connect->prepare($tblquery);
  $stmt->execute($tblvalue);  
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $results; 
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
  }
 }

 //update
 public function tbl_update($tblquery,$tblvalue = array())
 { 
 try{
  $stmt = $this->connect->prepare($tblquery);
  $results = $stmt->execute($tblvalue);
   return $results; 
} catch(PDOException $e) {
   echo 'update Error: ' . $e->getMessage();
  }
    }
	//update
  
 //Encoding Password
 public function epass($epass)
 {
   try{
     $epass = crypt($epass, '$5$3$');
     return $epass;
   } catch(PDOException $e){
     echo 'Error:' . $e->getMessage();
   }
 }
 //End $epass = crypt($password, $5$3$);
 //End
	
  }
?>