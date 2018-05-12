<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <title>Browse Page</title>
</head>
<body>

  <h1>Welcome to DJ's Thrift Store!</h1>
  <h3>
    Are you ready to pop some tags?
  </h3><p>
    Items for purchase: 
    </p>
  <form action="header.php" method="POST" onSubmit="window.location.reload()">
    <ul>
      
      <li><input type="checkbox" name="items[]" value="Long Coat"> Long Coat (Grandpa Style) - $5.00 </li>
      <li><input type="checkbox" name="items[]" value="Old Hat"> Old Hat - $7.00 </li>
      <li><input type="checkbox" name="items[]" value="Golf Clubs"> A set of Golf Clubs - $13.00 </li>
      <li><input type="checkbox" name="items[]" value="Ray Bands"> Ray Bands - $3.00</li>
      <li><input type="checkbox" name="items[]" value="Golden Calf"> Golden Calf - $39.00</li>
      <li><input type="checkbox" name="items[]" value="Super Old Chinese Ginseng"> Super Old Chinese Ginseng - $199.00 </li>
      </ul>
    
    <input type="submit" value="Add to Cart">
    </button>
</form>
<form action="header2.php" method="GET">
<input type="submit" value="View My Cart">
</form>
</body>
</html>
