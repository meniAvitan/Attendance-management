<?php
    session_start();
    
    $msg=isset($_SESSION['MSG']) ? $_SESSION['MSG'] : "";
$page = 0;
if(isset($_GET['p'])){
    $page = 10*(int)$_GET['p'];
}
    include 'db_func.php';
    $mysqli= openDb();
    $q = "SELECT * FROM `courses` LIMIT $page,100";
    $result = mysqli_query($mysqli,$q);
    $allData=array();
    while($row=mysqli_fetch_assoc($result)){
        $allData[$row['id']]=$row;
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title >נוכחות עובדים</title>
        <style>
            #title{
                grid-column: 1/ span 12;
            }
            body{
                display: grid;
                grid-template-columns: repeat(12, 1fr);
                
                margin: 0%;
                padding: 0%;
                }
           
            table{
                width: 100%;
                grid-column: 1/ span 12;
                border-color:  rgb(161, 109, 40);
                border-collapse: collapse;
                font-family: Arial, Helvetica, sans-serif;

            }
            #msg{
                grid-column: 1/ span 3; 
            } 
            td{
                width: 10%;
                height: 30px;
               
            }

            th{
               
            }
            a{
                text-decoration: none; 
            }
           
            #sum,#add{
                grid-column: 11/ span 2;
                    width: 30%;
                    height: 10%; 
                    margin: 2%;
                    padding: 2%;
                    background-color: white;
                    color: rgb(161, 109, 40);
                    border: solid 1px rgb(161, 109, 40);
                    font-size: 120%;
                    border-radius: 10px;
                    text-decoration: none;
            }
        </style>
    </head>
    <body>
        
    <h1 id="title" style = "text-align: center;">נוכחות עובד </h1>
   
        <h1 id="msg"><?php echo $msg; ?></h1>
        <table border= 1 style="text-align: center;" >
            <tr>

                <td colspan="1000">
                <a id="add" href="crsAdd.php">הוסף שעות עבודה</a>
                <a id="sum" href="sum.php">סיכום חודשי   </a>
                <br/><br/><br/><br/>
                </td>
            </tr>
            <tr>
                <th></th>
                <th>שם עובד</th>
                <th>טלפון</th>
                <th>אימייל</th>
                <th>עבודה</th>
                <th>שעת הגעה</th>
                <th>שעת יציאה</th>
                <th>סה"כ</th>
            </tr>
            <?php  foreach ($allData as $course_id => $value) { 
//                ?>
            <tr>
                <td>
                    <form action="deleteCrs.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $course_id?>" />
                        <button style="background-color: red;color: white;">מחק</button>
                    </form>
                </td>
                <td> <?php echo $value['name'] ?></td>
                <td> <?php echo $value['phone'] ?></td>
                <td> <?php echo $value['email'] ?></td>
                <td> <?php echo $value['work_place'] ?></td>
                <td> <?php echo $value['start_time'] ?></td>
                <td> <?php echo $value['end_time'] ?></td>
                <td> <?php echo round($value['total'],2) ?></td>

                <td> <a href="crsAdd.php?id=<?php echo $value['id'] ?>">עדכן</a></td>
            </tr>
            <?php } ?>
        </table>
        
    </body>
</html>