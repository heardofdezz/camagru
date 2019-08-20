<?php
//	session_start();
	if (!isset($_SESSION['User_id']))
	{
        header("Location: " . WEBROOT . "users/create");
		exit;
	}
?>


<h1>Edit Profile information</h1>
<form method='post' action='#'>
    <div class="form-group">
         <label for="title">Email:</label>
        <input type="text" class="form-control" id="email" placeholder="Changez votre Email" name="email" value ="<?php if (isset($user["email"])) echo $user["email"];?>">
        <label for="title">Ville:</label>
        <input type="text" class="form-control" id="ville" placeholder="Changez votre Ville" name="ville" value ="<?php if (isset($user["ville"])) echo $user["ville"];?>">
        <label for="title">Zipcode:</label>
        <input type="text" class="form-control" id="zipcode" placeholder="Changez votre Zipcode" name="zipcode" value ="<?php if (isset($user["zipcode"])) echo $user["zipcode"];?>">
        <label for="title">Password:</label>
        <input type="text" class="form-control" id="password" placeholder="Changez votre Password" name="password" value ="<?php if (isset($user["password"])) echo $user["password"];?>">
        <label for="title">Retapez votre Password:</label>
        <input type="text" class="form-control" id="password2" placeholder="Retapez votre Password" name="password2" value ="<?php if (isset($user["zipcode"])) echo $user["pqassword2"];?>">

        <!-- <label for="description">Description</label> -->
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>