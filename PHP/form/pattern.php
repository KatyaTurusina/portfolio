<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Форма регистрации на конференцию </title>
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
      color: #333;
    }
    html{
      font-family: Arial;
      
    }
    ul{
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }
    li{
      float: left;
    }
    li a{
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      cursor: pointer;
    }
    li a:hover, .exit:hover{
      background-color: #111;
    }
    span{
      color: red;
      font-size: 13px;
    }
    p {
      padding-top: 15px;
      font-size: 20px;
    }
    .form {
      display: inline-block;
      margin-left: 10px;
    }
    input[type=text], select{
      display: block;
      width: 200px;
      margin: 3px 0 15px 0;
      padding: 5px 3px;
    }
    table {
      border-collapse: collapse;
      border: 1px solid #333;
      text-align: center;
    }
    th, td {
      border: 2px solid #333;
      padding: 5px;
    }
    input[type=checkbox] {
      margin: 3px 0 20px 0;
    }
    button {
      display: block;	
      outline: none;
	    border: none;
      background-color: #05cd51;
      padding: 0 24px;
      height: 37px;
	    line-height: 37px;
      font-size: 14px;
      color: white;
      cursor: pointer;
    }
    .del {
      margin-top: 15px;
    }
    .exit{
      background-color: #333;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      display: inline-block;
      margin: 10px 0 0 0;
      cursor: pointer;
    }
    caption {
      font-size: 25px;
      margin-bottom: 10px;
      font-weight:bold
    }
    

  </style>
</head>
<body>
  <ul class="navigation">
    <li><a  href='index.php'>Главная</a></li>
    <li><a  href='admin.php'>Админка</a></li>
	</ul>
</body>
</html>