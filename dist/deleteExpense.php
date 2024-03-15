<?php

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['deleteButton'])){
        require "./connect.php";
        print_r($_POST['deleteButton']);
        $sql = "delete from expenses where id={$_POST['deleteButton']}";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
        header('Location: ./index.php');
    }

?>