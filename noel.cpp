<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Christmas Tree</title>
  <style>
    .tree {
      width: 300px;
      height: 400px;
      background-image: url(https://i.imgur.com/X1Y2Z34.png);
      background-size: cover;
      background-position: center;
    }

    .trunk {
      width: 15px;
      height: 100px;
      background-color: #000000;
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translate(-50%, 0);
    }

    .star {
      width: 50px;
      height: 50px;
      background-color: #ffffff;
      position: absolute;
      top: 250px;
      right: 50%;
      transform: translate(-50%, 0);
    }
  </style>
</head>
<body>
  <div class="tree">
    <div class="trunk"></div>
    <div class="star"></div>
  </div>
</body>
</html>