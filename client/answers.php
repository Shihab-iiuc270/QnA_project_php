<div class="container">
    <div class="offset-sm-1">
<h5>Answers:</h5>
<?php 
$query="select * from answers where question_id=$qid";
$result= $conn->query($query);
foreach ($result as $row) {
    $answer= $row['answer'];
    $user_id = $row['user_id'];
    $query = "select username from users where id=$user_id";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();
    $username = $user['username'];
echo "<div class='row'>
<p class='answer-wrapper'>$answer($username)</p>
</div>";
}
?>
</div>
</div>