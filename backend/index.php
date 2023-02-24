<?php
session_start();
include "./pdo.php";


$sql = "SELECT * FROM joke";
$result = $conn->prepare($sql);
$result->execute();
$result->setFetchMode(PDO::FETCH_ASSOC);
$result= $result->fetchAll();

if ( empty($_SESSION["id"]) || $_SESSION["id"]>count($result)) {
    $k=0;
    $_SESSION["id"]=1;
}
else{
   
    $k=$_SESSION["id"];
    $_SESSION["id"]++;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["user"])) {
      $nameErr = "Name is required";
    } else {
        if($k < count($result)){
            switch ($_POST["user"]){
                
                case "comment":
                    $id = $result[$k]["id"];
                    $a = $result[$k]["comment"]+1;
                    $sql = "UPDATE joke SET comment=".$a." WHERE id=".$id;
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $_POST["user"] =null;
                    break;      
                case "dislike":
                    $id = $result[$k]["id"];
                    $a = $result[$k]["dislike"]+1;
                    $sql = "UPDATE joke SET dislike=".$a." WHERE id=".$id;
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $_POST["user"] =null;
                    break;
             }
        } 
    }
   
}  

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>front end</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
<header>
    <div class="container overflow-hidden">
        <div class="row align-items-start gx-5 p-3">
            <div class="col-md-8"></div>
            <div class="col-md-3 p-3 border bg-light">user nhat haha </div>
        </div>
        
    </div>
</header>
<div class="main container">
<?php
        if ($k== count($result)){
            echo " <div class='main container'><div class='row bg-info p-3 '><div class='col-md-12 d-flex justify-content-center'> <p class= 'd-flex justify-content-center'>day la cau dua cuoi cung hen gap lai ngay moi</p></div></div></div>";
            session_unset();
            session_destroy();
        } else {
        ?>
    <div class="row bg-info p-3">
       
        <div class="col-md-3 p-3 d-flex justify-content-center"></div>
        <div class="col-md-6 d-flex justify-content-center"><?=$result[$k]["joke"]?> </div>
        <div class="col-md-3 d-flex justify-content-center"></div>
        
        
    </div>
   
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <div class="row p-3 ">
        <div class="col-md-6 d-flex justify-content-center"><input type="submit" name="user" value="comment"></div>
        <div class="col-md-6 d-flex justify-content-center"><input type="submit" name="user" value="dislike"></div>
        </div>
    
    </form>
    <?php } ?>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>