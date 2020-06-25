<!DOCTYPE html>
<html>
<body>

<h1>DATABASE CONNECTION</h1>


<?php
ini_set('display_errors', 1);
echo "Hello Cloud Computing class 0705!";
?>
    <input type="text" placeholder="Search..." name="Search">
    <input type="submit" name="form_click" value="Submit" />
<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
          "host=
ec2-52-202-146-43.compute-1.amazonaws.com
;port=5432;user=lnmlwwbswnzsfa;password=cb977e5e295f4561e6e00a6bfe3cb3f1239bd0a6f672d8cde0d2527d0f465bbd;dbname=d5jt6vji9s8ql3",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "SELECT * FROM product";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>product information:</p>';

?>
<div id="container">
<table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // tạo vòng lặp 
         //while($r = mysql_fetch_array($result)){
             foreach ($resultSet as $row) {
      ?>
   
      <tr>
        <td scope="row"><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['price'] ?></td>
        
      </tr>
     
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
