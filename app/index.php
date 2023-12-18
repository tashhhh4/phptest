<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP & MySQL Test Page</title>
  <style>
body   { background-color: #fff;
         color: #00a;
         font-family: sans-serif; }
pre    { color: #444; }
table  { color: #000;
         margin: 15px 0;
         border-collapse: collapse; }
th, tr { padding: 10px 0; }
tr     { border-bottom: 1px solid #ddd; }
td     { padding: 0 10px; }
  </style>
</head>
<body>

<h1>PHP & MYSQL Test Page</h1>
<hr>

<?php

// Connect to the Database
require 'config.php';
$mysqli = mysqli_connect(
    $HOSTNAME,
    $USERNAME,
    $PASSWORD,
    $DATABASE
);
if($mysqli) {
    echo '<p>Connected to the database.</p><hr>';
}

// Create a MySQL Table
$sql = "

    CREATE TABLE Test (
        name VARCHAR(50),
        color VARCHAR(30),
        number INT(10)
    );

";
if($mysqli->query($sql)) {
    echo '<pre>'.$sql.'</pre>';
    echo '<p>Created test table.</p><hr>';
}

// Insert Data
$sql = "

    INSERT INTO Test (name, color, number)
    VALUES
    ('Tom', 'blue', 50),
    ('Cathy', 'green', 12),
    ('Jean', 'yellow', 60);

";
if($mysqli->query($sql)) {
    echo '<pre>'.$sql.'</pre>';
    echo '<p>Inserted data.</p><hr>';
}
?>

<h2>Retrieve Data</h2>

<?php
$sql = "

    SELECT * FROM Test;
    
";
if($result = $mysqli->query($sql)) {
    echo '<pre>'.$sql.'</pre>';
    echo $result->num_rows . ' rows selected.';
    echo '<table>';
    echo '  <tr>';
    echo '    <th>Name</th>';
    echo '    <th>Color</th>';
    echo '    <th>#</th>';
    echo '  </tr>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$row['color'].'</td>';
        echo '<td>'.$row['number'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<hr>';
}

$sql = "

    DROP TABLE Test;

";
if($mysqli->query($sql)) {
    echo '<pre>'.$sql.'</pre>';
    echo '<p>Dropped test table.</p><hr>';
}

?>

</body>
</html>