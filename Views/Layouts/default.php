<?php
	session_start();
?>

<!doctype html>
    <head>
     <meta charset="utf-8">
    <title>Camagru Project 42</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">

body, html {
  background: url("/bckground.gif") fixed;
}
ul {
	padding: 0;
	list-style: none;
}

.nav {
	display: grid;
	grid-template: 1fr / min-content min-content auto min-content min-content;
	align-items: center;
	padding: 10px 10px;
	border: 1px solid #eeeeee;
	color: #757575;
	background-color: #222831;
	margin: 0px;
}

.nav li {
	text-align: center;
	cursor: pointer;
	padding: 10px;
	min-width: 120px;
}

.nav li a {
	text-align: center;
	text-decoration: none;
	color: #757575;
}

.nav li:hover {
	color: #55acee;
}

.nav li>button {
	font-size: 0.8em;
	border: 0;
	background: #55acee;
	color: #fff;
	border-radius: 100px;
}

.nav_logo {
	color: #55acee;
	font-size: 2.6em;
}

@media screen and (max-width: 717px) {
	.nav li {
		min-width: 50px;
	}
	.nav_logo {
		display: none;
	}
	.nav_spacing {
		display: none;
	}
	.nav {
		grid-template: 1fr / 1fr 1fr 1fr;
	}
}

@media screen and (max-width: 600px) {
	.nav-text {
		display: none;
	}
	.nav li {
		min-width: 50px;
	}
	.nav li i {
		font-size: 20px;
	}
	.nav_logo {
		display: none;
	}
	.nav_spacing {
		display: none;
	}
	.nav {
		grid-template: 1fr / 1fr 1fr 1fr;
	}
}

.nav_account ul {
	position: absolute;
	right: 0;
	top: 0;
	display: flex;
	padding: 10px 10px;
	border: 1px solid #eeeeee;
	border-radius: 5px;
	color: #757575;
	box-shadow: 5px 10px 20px -20px #55acee;
	flex-direction: column;
	opacity: 0;
	background-color: #1c2938;
	margin-top: 50px;
	margin-right: 10px;
	width: 168px;
	z-index: 1000;
}

.nav_account ul ul li {
	margin-right: auto;
	width: 100px;
}

.nav_account ul:hover, .nav_account ul:active {
	opacity: 1;
	height: auto;
}

.nav_account ul ul li a {
	padding: 5px;
	display: block;
}

.ani {
	-webkit-transition: 0.4s ease-in;
	-moz-transition: 0.4s ease-in;
	-o-transition: 0.4s ease-in;
	transition: 0.4s ease-in;
}

.ani .handler {
	background-color: transparent;
    width: 130px;
    height: 38px;
    position: absolute;
    margin-top: -50px;
}
    </style>
   
</head>

<body>

<header>
	<ul class="nav">
		<li>
			<a href="/">
				<i class="fa fa-home"></i>
        <img src="/icon/home.svg">
				<span class="nav-text">Home</span>
			</a>
		</li>
   
		<li class="nav_spacing">
				<!-- Spacing -->
			</li>		<li class="nav_logo">CAMAGRU</li>
     
		<li>
			<a href="/Users/home">
				<i class="fa fa-camera"></i>
        <img src="/icon/video.svg">
				<span class="nav-text">Upload</span>
			</a>
		</li>
		<li class="nav_account">
			<!-- If user is logged in and set -->
			{%IF session.user}
			<a href="/users/">
				<span><i class="fas fa-user-circle"></i>
					<span class="nav-text" style="white-space: nowrap;">{{session.user.username_cut}}</span>
				</span>
			</a>
			<ul class="ani">
				<li><a href="/users/profile">Profile</a></li>
				<li><a href="/users/edit">Réglages</a></li>
				<li><a href="/users/logout">Logout</a></li>
				<div class='handler'></div>
			</ul>
			{%END}
			{%IFN session.user}
			<!--else usr isnt set  -->
            <ul class="ani">
				<li><a href="/Users/login">Login</a></li>
				<li><a href="/Users/create">Sign up</a></li>
				<div class='handler'></div>
			</ul>
       		{%END}
		</li>
	</ul>
</header>

     <main role="main" class="container">

    <div class="starter-template">

        <?php
        echo $content_for_layout;
        ?>

    </div>

</main>

</body>
</html>

<!-- <li style="float:right"><a class="active" href="#about">Login or Signup</a></li>/ -->
