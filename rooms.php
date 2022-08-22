<?php
$roomname = $_GET['roomname'];

include 'db_connect.php';

$sql ="SELECT * FROM `rooms` WHERE roomname= '$roomname'";

$result = mysqli_query($conn, $sql);
if($result)
{
	if(mysqli_num_rows($result) ==0)
	{
	$message ="this room does not exits. Try creating a new one";

	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';
	}
}
else 
{
   echo "Error :". mysqli_error($conn);
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 <link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyClass{
	height: 350px;
	overflow-y: scroll;
}
</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ChatBox</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<h2>Chat Messages . <?php echo $roomname;?></h2>

<div class="container">
	<div class="anyClass">
 
  </div>
</div>
<input type="text" class ="form-control" name="usermsg" id="usermsg" placeholder="Add Messages"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">Send</button>
<script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
//Check for new messages every 1 second
setInterval(runFunction,1000);
function runFunction(){
	$.post("htcont.php",{room:'<?php echo $roomname ?>'},
     function(data,status)
     {
     	document.getElementsByClassName('anyClass')[0].innerHTML = data;
     }

		)
}





		// Get the input field
var input = document.getElementById("usermsg");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
   event.preventDefault();
   document.getElementById("submitmsg").click();
  }
});
	//If user submits the form 
   
	$("#submitmsg").click(function(){
		 var clientmsg = $("#usermsg").val();
    $.post("postmsg.php",{text: clientmsg, room:'<?php echo $roomname ?>', ip:'<?php echo $_SERVER['REMOTE_ADDR']?>'},
    function(data, status){
    	  document.getElementsByClassName('anyClass')[0].innerHTML = data;});
   $("#usermsg").val("");
    	return false;
    
 
});
</script>
</body>
</html>


