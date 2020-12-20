<?php
$conn = new mysqli("localhost","root","","coutses");
 $adiel_obj = [];
if(isset($_POST["S_S_N"])){
   $S_S_N =  $_POST["S_S_N"];
 
    $query="SELECT * FROM `working_report` WHERE `S_S_N` = $S_S_N";
    $result=mysqli_query($conn,$query);
    $i=0;
    while ($row = mysqli_fetch_assoc($result))  {
        $month = strtotime($row["Date"]);
        $month = date('m',$month);
        if($month == date('m') ){
            $adiel_obj[$i] = $row;
          
        }   
        $i=$i+1;
    }
}


?>








<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Monthly Employee Report</h2>
<form method="post" action="Last month's report.php">
  <label for="fname">ente ssn:</label>
  <input type="text" id="fname" name="S_S_N"><br><br>
  <input type="submit" value="Submit">
</form>

<table>
  <tr>
    <th>S_S_N</th>
    <th>Date</th>
    <th>Entry_time</th>
    <th>Exit_time</th>
    <th>Business_Name</th>
  </tr>
  <?php
      foreach($adiel_obj as $line)
      {
 ?>
  <tr>
   <t>
  <td><?php echo $line['S_S_N']; ?></td>
  <td><?php echo $line['Date']; ?></td>
  <td><?php echo $line['Entry_time']; ?></td>
  <td><?php echo $line['Exit_time']; ?></td>
  <td><?php echo $line['Business_Name']; ?></td>
  
    </t>
    
      <?php    
      }
      ?>
    
  

</table>

</body>
</html>