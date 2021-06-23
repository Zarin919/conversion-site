<!DOCTYPE html>
<html>
<head>

</head>
<body>

<div style="width: 400px;
  height:  350px;
  border: 5px black;
  margin-left: 300px;">

  <h3 style="color: orange;">Page 3 [History]</h3>
  <h3 style="color: yellowgreen;">Conversion Site</h3>
  <p><a href="page1.php">1.Home</a><a href="page2.php">2.Coversion Rate</a><a href="page3.php">3.History</a></p>
<?php
// Store JSON data in a PHP variable
$json = '{"zarin":23,"sultana":12,"zabin":18,"rafi":22,"ibrahim":29}';
 
var_dump(json_decode($json));

?>
  





</div>


</body>
</html>