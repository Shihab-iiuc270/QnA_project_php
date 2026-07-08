<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discuss Project</title>
    <?php include ("./client/commonfiles.php")?>
</head>
<body>
 <?php 
 session_start();
 include ("./client/header.php");
 if (isset($_GET['signup']) && !isset($_SESSION['user']['username'])){
    include ("./client/signUp.php");
 }
 elseif(isset($_GET['login']) && !isset($_SESSION['user']['username'])){
    include("./client/login.php");
 }
 elseif(isset($_GET['ask'])){
    //
    include("./client/ask.php");
 }
 elseif(isset($_GET['q-id'])){
   $qid=$_GET['q-id'];
   include("./client/question-details.php");
 }
 elseif(isset($_GET['c-id'])){
   $cid=$_GET['c-id'];
   include("./client/questions.php");
 }
 elseif(isset($_GET['u-id'])){
   $uid=$_GET['u-id'];
   include("./client/questions.php");
 }
 elseif(isset($_GET['latest'])){
   include("./client/questions.php");
 }
 elseif(isset($_GET['search'])){
   $search = $_GET['search'];
   include("./client/questions.php");
 }
 else{
   include("./client/questions.php");
 }
 ?>

</body>
</html>