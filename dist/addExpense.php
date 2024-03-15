<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addExpenseButton'])){
        require "./connect.php";
        print_r($_POST['selectoption']) ;
        $sql =" insert into expenses (title , amount , expenses_date , category_id)
        values('{$_POST['expenseName']}','{$_POST['expenseAmount']}','{$_POST['expenseDate']}','{$_POST['selectoption']}')";
        $result = mysqli_query($conn , $sql);
        mysqli_close($conn);
        header('Location: ./index.php');
     }

?>