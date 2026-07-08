<?php
session_start();
include("../common/db.php");
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $address = $_POST['address'];

   $user = $conn->prepare("
    INSERT INTO users (id, username, email, password, address)
    VALUES (NULL, ?, ?, ?, ?)
");

$user->bind_param("ssss", $username, $email, $password, $address);

    $result = $user->execute();
    $user->insert_id;
    if ($result) {

        $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $user->insert_id];
        header("location: ../index.php");
    } else {
$_SESSION["error"] = "Signup failed. Please try again.";
header("location: ../index.php?signup=true");
    }

} else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = "";
    $user_id = 0;

    $stmt = $conn->prepare("select * from users where email= ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row= $result->fetch_assoc();
         if (password_verify($password, $row['password'])) {
            $_SESSION["user"] = ["username" => $row['username'], "email" => $row['email'], "user_id" => $row['id']];
            $_SESSION["success"] = "You are logged in!";
            header("location: ../index.php");
        }
        else{
            $_SESSION["error"] = "Wrong password. Try again.";
            header("location: ../index.php?login=true");
        }

    } else {
$_SESSION["error"] = "No account found with that email.";
header("location: ../index.php?login=true");    }

} else if (isset($_GET['logout'])) {
    session_unset();
    header("location: ../index.php");
} else if (isset($_POST["ask"])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $user_id = $_SESSION['user']['user_id'];

    $question = $conn->prepare("Insert into `questions`
(`id`,`title`,`description`,`category_id`,`user_id`)
values(NULL,'$title','$description','$category_id','$user_id');
");

    $result = $question->execute();
    $question->insert_id;
    if ($result) {
        header("location: ../index.php");
    } else {
        echo "Question is added to website";
    }

}else if (isset($_POST["answer"])) {
    $answer = $_POST['answer'];
    $question_id = $_POST['question_id'];
    $user_id = $_SESSION['user']['user_id'];

    $query = $conn->prepare("Insert into `answers`
(`id`,`answer`,`question_id`,`user_id`)
values(NULL,'$answer','$question_id','$user_id');
");

    $result = $query->execute();
    if ($result) {
        header("location: ../index.php?q-id=$question_id");
    } else {
        echo "Answer is not submitted";
    }

}else if (isset($_GET["delete"])) {
    echo $qid= $_GET["delete"];
     $query= $conn->prepare("delete from questions where id =$qid");
     $result = $query->execute();
     if($result){
        header("location: ../index.php");
     }else {
        echo "Question not deleted";
     }
}
?>