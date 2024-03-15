<?php 
        require "./connect.php";
        // if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['editButton'])){
        //     $sql = "select expenses.id, expenses.title, expenses.amount, expenses_date from expenses where id={$_POST['editButton']}";
        //     $result = mysqli_query($conn,$sql);
        // }
       

       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./output.css" rel="stylesheet">
    <style>

                table {
                width: 100%;
                border-collapse: collapse;
                }


                thead th {
                background-color: #f2f2f2;
                border: 2px solid #dddddd;
                padding: 8px;
                text-align: left;
                }

                tbody td {
                border: 2px solid #dddddd;
                padding: 8px;
                }


                tbody tr:nth-child(even) {
                background-color: #f9f9f9;
                }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1 class="text-center text-3xl font-serif p-5">Expense Tracker</h1>
     <main class="flex font-serif">
     <div class="w-full px-10">
        <h1 class="mb-5 font-serif text-xl text-center capitalize text-green-600">list of expenses</h1>
        <table> 
            <thead>
                <tr>
                    <th>sno</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Expense Date</th>
                    <th>Entry Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                     $sql = "select expenses.id, expenses.title, expenses.amount, expenses_date , categories.label
                     from  expenses
                     inner join categories on expenses.category_id = categories.id";
                     $result = mysqli_query($conn, $sql);
                     if(mysqli_num_rows($result)>0){
                        $i=0;
                        $totalExpenseAmount = 0;

                        while($row = mysqli_fetch_assoc($result)) {
                            $i++;
                        echo '<tr>';
                     
                           echo "<td>{$i}</td>";
                           echo   "<td>{$row['title']}</td>";
                           echo "<td>{$row['amount']}</td>";
                           echo "<td>{$row['expenses_date']}</td>";
                           echo " <td>{$row['label']}</td>";
                           echo "<td class='text-green-500'><form action='./' method='POST'><button type='submit' value='{$row['id']}' name='editButton'><i class='fa-solid fa-pen-to-square hover:cursor-pointer'></i></button></form></td>";
                           echo "<td class='text-red-500'><form action='deleteExpense.php' method='POST'><button type='submit' value='{$row['id']}' name='deleteButton'><i class='fa-solid fa-trash hover:cursor-pointer'></i></button></form></td>";
                      
                            echo '</tr>';
                            $totalExpenseAmount = $totalExpenseAmount + $row['amount'];
                    }

                     }
                ?>
            </tbody>
        </table>
     </div>
     <div class="w-2/5 ">
     <h1 class="mb-5 font-serif text-xl text-center capitalize text-green-600">Add new expenses</h1>
    <div class="px-5 ">
    <form class="p-10 rounded-lg bg-gray-200 flex flex-col  m-auto space-y-5" action="./addExpense.php" method="POST">
        <div class="flex">
        <label class="mr-2" for="">Entry type :</label>
        <select class="grow border-[1px] border-black outline-1 outline-emerald-300" name="selectoption" id="">
            <?php
    
            $sql = "select id , label from categories";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option class='border-[1px] border-black outline-1'  value='{$row['id']}'>{$row['label']}</option>";
                    }
                } else {
                echo "0 results";
                }
            
           
            ?>
        </select>
        </div>
        <div class="flex">
        <label class="mr-2"  for="">Name:</label>
        <input class="grow border-[1px] border-black outline-1 outline-emerald-300" type="text" palaceholder="Enter the expense" name="expenseName" required>
        </div>
                <div class="flex">
                <label  class="mr-2"  for="">Amount:</label>
        <input class="grow border-[1px] border-black outline-1 outline-emerald-300" type="number" palaceholder="Enter the amount" name="expenseAmount" required>
                </div>
        <div class="flex">
            <label class="mr-2"  for="">Expense Date:</label>
        <input class="grow border-[1px] border-black outline-1 outline-emerald-300" type="date" palaceholder="Enter the amount" name="expenseDate" required>
            
        </div>
        <div class="text-center pt-5">
        <button class="px-20 py-2 bg-green-600 text-white" type="submit" name="addExpenseButton">Add Expenses</button>

        </div>
    </form>
    <div class="mt-5 px-10 py-5 rounded-lg bg-gray-200">
        <h1 class='text-red-500 text-xl text-center'>Total Expenses</h1>
        <p class='mt-5'>Amount : <span class='text-red-500'><?php echo $totalExpenseAmount ?></span></p>
    </div>      
    </div>
   
     </div>
     </main>
    
  
  
</body>
</html>