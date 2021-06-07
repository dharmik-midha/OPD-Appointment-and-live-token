<!DOCTYPE html>
<html>
<head>
	<title>Receptionist</title>
</head>
<body>
	<form method="POST" class="box" action="verifiedRec.php">
		<h1>Receptionist Login</h1>
		<input type="text" name="Username" placeholder="Username">
		<input type="Password" name="pass" placeholder="Password">
		<button name="login">Sign In</button>
	</form>
</body>
</html>
<style type="text/css">
	body {
	margin: 0;
	padding: 0;
	font-family: sans-serif;
    background-image: url(assets/images/left_png.png); 
    background-size: 100%;


}
.box {
	width: 300px;
	padding: 40px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
	background: #ffffff;
	text-align: center;
    opacity:0.98;
}
.box h1{
	color: black;
	text-transform: uppercase;
	font-weight: 400;

}
.box input[type= "text"], .box input[type= "password"] {
	border: 0;
	background: none;
	display: block;
	margin: 20px auto;
	text-align: center;
	border: 2px solid #3498db;
	padding: 12px 5px;
	width:200px;
	outline: none;
	color: #000000i;
	border-radius: 24px;
	transition: 0.25s;
}


.box input[type= "text"]:focus, .box input[type= "password"]:focus {
	width: 240px;.
	transition: 0.25s;
	border-color: #2ecc71;
}

.box input[type="submit"] {
	border: 0;
	background: none;
	display: block;
	margin: 20px auto;
	text-align: center;
	border: 2px solid #2ecc71;
	padding: 14px 40px;
	outline: none;
	color: #2ecc71;
	border-radius: 24px;
	transition: 0.25s;
}
.box button{
	border: 0;
	background: none;
	display: block;
	margin: 20px auto;
	text-align: center;
	border: 2px solid #2ecc71;
	padding: 14px 40px;
	outline: none;
	color: #2ecc71;
	border-radius: 24px;
	transition: 0.25s;
}

.brr {
	color:white;
	font-size: 10px;
}
.aa{
	border:0;
	margin: 0;
	padding: 0;
	text-decoration: none;

}

</style>