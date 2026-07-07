<div class="container">
    <h1 class="heading">Question</h1>
    <?php
    include("./common/db.php");
    $query= "select * from questions where id=$qid";
    $result = $conn->query($query);
    $row=$result->fetch_assoc();
    echo "<h4>".$row['title']."</h4>
    <p>".$row['desription']"."</php>;
    <
    ?>
</div>