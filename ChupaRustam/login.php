<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login Form - My Shop</title>
  <link href="css/normalize.css" type="text/css" rel="stylesheet"> 
 <link href="css/login.css" type="text/css" rel="stylesheet">
  <script src="js/prefixfree.min.js"></script>

</head>

<body>

  <div class="login">
	<h1>Login</h1>
    <form method="post" action="signin.php">
    	<input type="text" name="uname" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" name="submit" class="btn btn-primary btn-block btn-large" value="Let me in">
    </form>
</div>


    
  <script src="js/index.js"></script>

</body>

</html>
