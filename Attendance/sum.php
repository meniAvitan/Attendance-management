<?php
include 'db_func.php';
$mysqli= openDb();
    $crs_id = -1;
    if(isset($_GET['crs'])){
        $crs_id = (int)$_GET['crs'];
    }
    $i=0;
   $last_month = [];
    $id=(isset($_GET['id']))?(int)$_GET['id']:-1;
    if(isset($_POST["id"])){
        $id =  $_POST["id"];
    
    }
    $query = "SELECT * FROM `courses`  ";
    $result = mysqli_query($mysqli,$query);

    // $query2 = "SELECT SUM(`total`) FROM `courses`";
    // $result2 = mysqli_query($mysqli,$query2);
    // $sql = mysqli_query($mysqli,"SELECT SUM(`total`) FROM `courses`");
    // $row23 = mysqli_fetch_assoc($sql);
    // $sum = $row23['total'];
    
    $qty= 0;
    while($row=mysqli_fetch_assoc($result)){
    $month = strtotime($row["start_time"]);
    $month = date('m',$month);

    $qty += round($row['total'], 2);
    
    if($month == date('m') ){
        $last_month[$i] = $row;
      
    }   
    $i=$i+1;
}


    
    
   
   $crs=array();
    $crs[2]="intel";
    $crs[5]="mobileye";
	$crs[3]="checkpoint";
    $crs[4]="zefat_coleg";
    
// $q = null;
// $count = 0;
//     if(isset($_GET['search'])){
//         $start_day = $_GET['start_day'];
//         $end_day = $_GET['end_day'];
//         $q="SELECT * FROM `courses` WHERE `start_time` BETWEEN '$start_day' AND ' $end_day' ";
//         $res = mysqli_query($mysqli,$q);
//         $count = mysqli_num_rows($res); 
//     }


?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>סיכום חודשי</title>
        <style>
             #title{
                grid-column: 1/ span 12;
                margin: 5%;
            }
            body{
                display: grid;
                grid-template-columns: repeat(12, 1fr);
                font-family: Arial, Helvetica, sans-serif;
                margin: 0%;
                padding: 0%;
                }
              
            #sum,#add,#emp{
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
        
            table{
                width: 100%;
                grid-column: 1/ span 12;
                border-color:  rgb(161, 109, 40);
                border-collapse: collapse;

            }
            td{
                width: 10%;
                height: 30px;
            }
            #sumOfHours{
                grid-column: 10/ span 3;
               border: none;
                width: 115%;
                text-align: center;
                font-size: 150%;
                color: green;
            }
            </style>
    </head>
    <body>
    <h1 id="title" style = "text-align: center;">נוכחות החודש האחרון </h1>
    <!-- <form action="" method="GET">
        <p>תאריך התחלה</p>
        <input type="date" name ="start_day" value="<?php echo date('D-m-y'); ?>" class="date">
        <p>תאריך סיום</p>
        <input type="date" name ="end_day" value="<?php echo date('D-m-y'); ?>" class="date"><br/>
        <input type = "submit" name="search" value="סנן תאריך">
    </form> -->
   
    
    <?php?>
        <table border= 1 style="text-align: center;" >
            <tr>
                <td colspan="100">
                <a id="add" href="crsAdd.php">הוסף שעות עבודה</a>
                <a id="emp" href="displayCrs.php"> נוכחות עובדים </a><br/><br/><br/><br/>

       <form action="" method="get">

            <select name="crs" onchange="this.form.submit();" >
                <option value="-1"
                        <?php if($crs_id == -1){echo "selected";}?> 
                        >all</option>
                <?php foreach ($crs as $c_id => $c_name){ ?>
                <option value="<?php echo $c_id ?>" 
                        <?php if($crs_id == $c_id){echo "selected";}?> 
                         ><?php echo $c_name ?></option>
                <?php } ?>
            </select>
            <input type="submit" name="go" value="סנן" />
        </form><br/>
            </tr>
            <tr>
                <th>שם עובד</th>
                <th>עבודה</th>
                <th>שעת הגעה</th>
                <th>שעת יציאה</th>
                <th>סה"כ</th>
            </tr>
            <?php  //foreach ($allData as $course_id => $value) {
               // while($value=mysqli_fetch_assoc($result)){
                    foreach($last_month as $line)
                    {
             ?>
            
            <tr>
              
                <td><?php echo $line['name'] ?></td>
                <td><?php echo $line['work_place'] ?></td>
                <td><?php echo $line['start_time'] ?></td>
                <td><?php echo $line['end_time'] ?></td>
                <td><?php echo round($line['total'], 2) ?></td>
              
            </tr>
            <?php } ?>
    <!-- <?php 
      if($count == '0'){
          echo '<h2> No data found! </h2>';
      }
      else{
        foreach($last_month as $line)
                    {
      }
    ?>
      <tr>
              
        <td><?php echo $line['name'] ?></td>
        <td><?php echo $line['work_place'] ?></td>
        <td><?php echo $line['start_time'] ?></td>
        <td><?php echo $line['end_time'] ?></td>
        <td><?php echo $line['total'] ?></td>
              
        </tr>
    <?php } ?> -->
   
        </table>
       
       
        <input type = "text" id="sumOfHours" name="sumOfHours" value= <?php  echo $qty; ?> >
        <?php
       
            // $query = "SELECT * FROM tableName";
            // $query_run = mysql_query($query);
          


            // $result2 = mysqli_query($mysqli, "SELECT SUM(`total`) FROM `courses`"); 
            // $row = mysqli_fetch_assoc($result2); 
            // $sum = $row['sumOfHours'];
            // echo $sum;
           
        ?>
        
    </body>
</html>