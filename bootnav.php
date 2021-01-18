<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    label.logo {
  font-size: 35px;
  line-height: 50px;
  padding: 0 80px;
  font-weight: bold;
}
.txt{
  font-size: 20px;
}
.navbar-nav{
  margin-left: 65%;
}

  </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark" >
  <a class="navbar-brand" href="#"><label class="logo" style="color: #D7DF23; cursor: pointer;"> Ced<i class="fa fa-car" style="color: white ;" aria-hidden="true"></i>Cab</label></a>
  <button class="navbar-toggler align-center" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon "></span>
  </button>
  <div class="collapse navbar-collapse bg-dark " id="navbarNavDropdown">
    <ul class="navbar-nav ">
      <li class="nav-item active">
        <a class="nav-link text-white" href="#"><span class="txt">Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#"><span class="txt">Features</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="txt">My Account</span>
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item " href="#">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
</body>
</html>