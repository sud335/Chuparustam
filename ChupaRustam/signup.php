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
	<h1>Register</h1>
    <form method="post" action="register.php">
    	<input type="text" name="uname" id="myusername" placeholder="Username" required />
    	<input type="text" name="cname" placeholder="Company Name" required />
    	<input type="text" size="10" pattern="(\+?\d[- .]*){10,11}" title="Mobile number or local phone(eg.012-34567891)" name="number" placeholder="Contact Number" required />
    	<input type="email" name="email" placeholder="Your E-Mail" required />
        <input type="password" name="password" placeholder="Password" required />
        <select type="text" name="category"><option value="FOOD">Food</option><option value="APPAREL">Apparel</option><option value="Grooming">Grooming</option></select>
        <input type="submit" name="submit" class="btn btn-primary btn-block btn-large" value="Register">
    </form>
</div>


  <script src="js/index.js"></script>


</body>

</html>
