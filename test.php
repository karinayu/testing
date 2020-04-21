<?php
 session_start();
 include ("bd.php");
 echo "<link rel='stylesheet' type='text/css' href='style2.css'>";
 $step = (isset($_GET['step'])) ? intval($_GET['step']) : 1;
 $query="SELECT * FROM questions WHERE id='".$step."'";
 echo "<form action='test.php?step=".($step + 1)."' name='form' method='POST'>";
$result=mysqli_query($db, $query);
$row=mysqli_fetch_array($result, MYSQLI_BOTH);
echo "<p>Вопрос ".$step."/20</p>";
echo "<div class='quest'><I>$row[value]</I></div><br>";
$query="SELECT * FROM answers WHERE id_quest='".$step."'";
$result=mysqli_query($db, $query);
echo "<div class='ans'>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<input type='radio' name='answer' value='".$row[cost]."' required>$row[value]<br>";
};
$_SESSION['result'][$step] = $_POST['answer'];
echo "</div>";
if ($step>=20) {
    echo "
    <a href='results.php'>Завершить</a>";
} else 
echo "
<button type=submit>Далее</button>
</form>";
?>