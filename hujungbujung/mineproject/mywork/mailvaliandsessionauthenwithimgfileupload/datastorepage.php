<?php
        include_once("studentclassoop.php");

        session_start();
        if(!isset($_SESSION["sname"])){
            header("location: demopage.php");
        }

        if(isset($_POST["btn"])){
        $name=$_POST["na"];
        $id=$_POST["id"];
        $batch=$_POST["ba"];

        $obj=new Student($name,$id,$batch);
        $obj->information();
        //echo $name;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data store and upload</title>
</head>
<body>
    
    <form action="#" method="post">
        <h1>thirdpage
            <br>
            store page;
        </h1>
        <div>
            Name:
            <input type="text" name="na" id="">
        </div>
        <div>
            ID:
            <input type="text" name="id" id="">
        </div>
        <div>
            batch:
            <input type="text" name="ba" id="">
        </div>
        <div>
            <button name="btn">Submit</button>
            <a href="logoutpage.php"><button>Log out</button></a>
        </div>
    </form>

    <?php
        Student::showdata();
    ?>
</body>
</html>