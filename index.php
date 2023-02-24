<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arr= array($_POST["1"],$_POST["2"],$_POST["3"],$_POST["4"], $_POST["5"]);
    
    for ($k = 0; $k <5; $k++) {
        $p=$arr[$k];
        unset($arr[$k]);
        echo "<p>if we sum everything except ".$k+1 .",  our sum is:".implode('+',$arr).":  ".array_sum($arr)."</p>";
        $arr[$k]=$p;
    }
    sort($arr);
    
    $min= $arr[0]+$arr[1]+$arr[2]+$arr[3];
    $max= $arr[1]+$arr[2]+$arr[3]+$arr[4];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ha minh nhat algorithm</title>
</head>
<body>
    
    
    <p> nhap 5 so cua dayx</p>
<form action="./index.php" method="post">
    <?php 
    for ($i = 0; $i < 6; $i++) {
        echo"<label for='" . $i . "'>số thứ" . $i . "</h2></br>" ;
        echo "<input type='number' id='" . $i . "'name=" . $i . " value=" . $i . "><br><br>";
    }
    ?>
  <input type="submit" value="Submit">
</form>
<p>array max: <?= $max= $max ?? ""; ?></p>
    <p>array min: <?=$min= $min ?? ""; ?></p>
</body>
</html>

