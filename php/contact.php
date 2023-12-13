<?php
   $array = array("firstname" => "", "name" => "", "email" => "", "numero" => "", "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "","numeroError" => "", "messageError" => "", "isSuccess" => false); 
   $emailTo = "arcelnjapa.9@gmail.com";
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
    $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["name"] = verifyInput($_POST["name"]) ;
    $array["email"] = verifyInput($_POST["email"]);
    $array["numero"] = verifyInput($_POST["numero"]);
    $array["message"] = verifyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";

    if(empty($array["firstname"]))
   {
     $array["firstnameError"] = "veuilllez entrer votre prénom s'il vous plait";
     $array["isSuccess"] = false;
   }
   else
   {
     $emailText .= "fisrtname: {$array["firstname"]}\n";
   }
   if(empty($array["name"]))
   {
     $array["nameError"] = "vous n'avez pas entrer votre nom";
     $array["isSuccess"] = false;
   }
   else
   {
     $emailText .= "name: {$array["name"]}\n";
   }
   if(!unemail($array["email"]))
   {
     $array["emailError"] = "adresse email invalide !";
     $array["isSuccess"] = false;
   }
   else
   {
     $emailText .= "Email: {$array["email"]}\n";
   }
   if(!unnumero($array["numero"]))
   {
     $array["numeroError"] = "numéro invalide que des chiffres et des espaces !";
     $array["isSuccess"] = false;
   }
   else
   {
     $emailText .= "numero: {$array["numero"]}\n";
   }
   if(empty($array["message"]))
   {
     $array["messageError"] = "veuillez laisser un message s'il vous plait";
     $array["isSuccess"] = false;
   }
   else
   {
     $emailText .= "message: {$array["message"]}\n";
   }
   if($array["isSuccess"])
   {
     $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
     mail($emailTo, "un message de votre site", $emailText, $headers);
   }
    echo json_encode($array);
   }
   
   function unemail($var)
   {
     return filter_var($var, FILTER_VALIDATE_EMAIL);
   }
   function unnumero($var)
   {
     return preg_match("/^[0-9 ]*$/", $var);
   }

   function verifyInput($var)
   {
     $var = trim($var);
     $var = stripslashes($var);
     $var = htmlspecialchars($var);
     return $var;
   }
?>