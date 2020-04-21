<?php 
session_start();
if(isset($_GET['exit']))
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }
echo "<link rel='stylesheet' type='text/css' href='style2.css'>";
include("bd.php");
for ($step=1;$step<=20;$step++) {
    $result += $_SESSION['result'][$step];
}
$query=mysqli_query($db,"INSERT INTO results (id_user, result) VALUES (".$_SESSION['id'].",".$result.")");
$res=mysqli_query($db, "SELECT * FROM results");
$row=mysqli_fetch_array($res, MYSQLI_BOTH);
$i = 0;
while ($row=mysqli_fetch_assoc($res)) {
    $sr += $row[result];
    $i++;
}
$sr = ($sr/$i/20)*100;
echo "<div class='quest'><i>Ваш результат: ".$result." из 20</i><br>";
$result = ($result/20)*100;
echo "<i>".$result."%</i><br>
<p>Средний результат среди прошедших: ".$sr."% из 100%</p></div>
<a href='test.php'>Пройти тест еще раз</a><br>
<a href='?exit'>Выйти из аккаунта</a>";
?>