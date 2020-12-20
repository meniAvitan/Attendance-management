<?php

$id=(isset($_GET['id']))?(int)$_GET['id']:-1;

$row=array("name"=>"","start_time"=>"","end_time"=>"");
if($id > 0){
    include 'db_func.php';
    $mysqli= openDb();
    $q = "SELECT * FROM `courses` WHERE id=$id ";
    $result = mysqli_query($mysqli,$q);
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
    }
    if(isset($_GET['Update'])){
        $u=(isset($_GET['name']))? addslashes($_GET['name']):-1;
        $p=(isset($_GET['phone']))? addslashes($_GET['phone']):-1;
        $e=(isset($_GET['email']))? addslashes($_GET['email']):-1;
        $w=(isset($_GET['work_place']))? addslashes($_GET['work_place']):-1;
        $c=(isset($_GET['start_time']))? addslashes($_GET['start_time']):-1;
        $d=(isset($_GET['end_time']))? addslashes($_GET['end_time']):-1;
       
        $date1 = $_GET['start_time'];
        $date2 = $_GET['end_time'];;
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        $diff_1 = abs($timestamp2 - $timestamp1);
        $minut = $diff_1/60;
        $hours = floor($minut/60);
        $mins = floor($minut%60);
        $hour = abs($timestamp2 - $timestamp1)/(60*60);
        $colon = ":";
        $res = $hour. $mins;


        $q="UPDATE  `courses` SET ";
        $q .= "`name`='$u',";
        $q .= "`start_time`='$c',";
        $q .= "`end_time`='$d',";
        $q .= "`total` = '$res'";
        $q.=" WHERE id=$id ";

        // $q="UPDATE  `courses` SET ";
        // $q .= "`name`='$u',";
        // $q .= "`phone`='$p',";
        // $q .= "`email`='$e',";
        // $q .= "`work_place`='$w',";
        // $q .= "`crs_code`='$c',";
        // $q .= "`classroom`='$d'";
        // $q .= "`total`='$t'";
        // $q.=" WHERE id=$id ";
//        echo "$q <br />";
        $result = mysqli_query($mysqli,$q);
        
        header("location:displayCrs.php");
      

    }
}
if(isset($_GET['regMe'])){
    $u=(isset($_GET['name']))? addslashes($_GET['name']):-1;
    $p=(isset($_GET['phone']))? addslashes($_GET['phone']):-1;
    $e=(isset($_GET['email']))? addslashes($_GET['email']):-1;
    $w=(isset($_GET['work_place']))? addslashes($_GET['work_place']):-1;
    $c=(isset($_GET['start_time']))? addslashes($_GET['start_time']):-1;
    $d=(isset($_GET['end_time']))? addslashes($_GET['end_time']):-1;
   
 
    include 'db_func.php';
    $mysqli= openDb();
  
   

    

    $q="INSERT INTO `courses`( `name`,`phone`,`email`,`work_place` ,`start_time`, `end_time`, `total` )";
    $q.=" VALUES ('$u','$p','$e','$w','$c', '$d', '$res')";
    $result = mysqli_query($mysqli,$q);
    
        header("location:displayCrs.php");
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>הוספת עובד/עבודה</title>
        <style>
            body{
                text-align: center;
                display: grid;
                grid-template-columns: repeat(12, 1fr);
                grid-template-rows: 800px;
                margin: 0%;
                padding: 0%;
                font-family: Arial, Helvetica, sans-serif;
                }
                .timePic{
                    grid-column: 1/ span 7;
                    /* grid-row: 1/ span 12; */
                    width: 100%;

                     height: 100%; 
                   
                    
                }
                #add{
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
            #sum{
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
                #form{
                    grid-column: 8/ span 5;
                    /* grid-row: 1/ span 12; */
                    width: 100%;
                    border-left: solid 10px rgba(161, 108, 40, 0.568) ;
                    margin-left: 2%;
                   
                  
                }
                input{
                   
                    border: solid 1px rgb(161, 109, 40);
                    border-radius: 10px;
                    width: 50%;
                    height: 3%; 
                    margin: 2%;
                    padding: 2%;
                    
                }
                .select{
                    border: solid 1px rgb(161, 109, 40);
                    border-radius: 10px;
                    width: 55%;
                    height: 5%; 
                    margin: 2%;
                    padding: 2%;
                }
                .submit{
                    width: 30%;
                    height: 5%; 
                    margin: 2%;
                    padding: 0%;
                    background-color: rgb(161, 109, 40);
                    color: white;
                    font-size: 130%;
                }
                .submit:hover{
                    background-color: white;
                    color: rgb(161, 109, 40);
                }

            p{padding-bottom: 0; margin-bottom:0;}
            select {width: 300px;}
            form {
                display: inline-block;
                direction: rtl; 
                width: 400px; 
              
                padding-bottom: 30px; 
                
                }
            
        </style>
    </head>
    <body>
        
   <div class="timePic">
       <img class="timePic" src="https://images.pexels.com/photos/850358/pexels-photo-850358.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="">
            </div>
  
        <form id="form" action="" method="GET">
           
            <br/><br/>
        <a id="add" href="displayCrs.php">דו"ח נוכחות  </a>
        <a id="sum" href="sum.php">סיכום חודשי   </a>
        <br/><br/>
            <h1>הכנס את הפרטים</h1>
            <input type="hidden" name="id"  value="<?php echo $id ?>" />
          
            <input type="text" name="name" placeholder="שמך" value="<?php echo $row['name']?>" />
            
            <input type="text" placeholder="מס' טלפון" name="phone" value="" />
            
            <input type="email" placeholder="Email..." name="email" value="" />
            
            <p>בחר עבודה</p>
            <select class="select" name ="work_place" id="work_place">
                <option value="intel">אינטל</option>
                <option value="checkpoint">checkpoint</option>
                <option value="mobileye">מובילאי</option>
                <option value=" zefat colleg">מכללת צפת</option>
            </select>
          <?php
          $dt = new DateTime(); // Date object using current date and time
          $dt= $dt->format('Y-m-d\TH:i:s'); 
         
          $date = date("", strtotime($row['start_time']));
          ?>
           <p>שעת התחלה</p>
           <input type="datetime-local" name ="start_time" value="<?php echo date("Y-m-d\TH:i:s", strtotime($row['start_time'])) ?>"/>

          
           <br>
           <p>שעת סיום</p>
           <input type="datetime-local" name ="end_time" value=" "  />

     

           <br>
           <br>
        
           
        

           <?php if($id<0){?>
            <input class="submit" type="submit" value="הוסף" name="regMe" />
           <?php } else { ?>
            <input class="submit" type="submit" value="עדכן" name="Update" />
           <?php } ?>
        </form>
    
    

       
              
    </body>
</html>
