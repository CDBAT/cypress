<head>
<!-- bootstrap files  -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<!-- bootstrap nav bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- check if user needs to login -->
      <?php
        if(!isset($_SESSION['username'])){
      ?>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/login.php">Login</a>
      </li>
      <?php
        }
    ?>
      <!-- drop downs -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Create Report</a>
          <a class="dropdown-item" href="#">Edit Report</a>
          <a class="dropdown-item" href="#">Delete Report</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/rankings.php">Rankings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/resolutions.php">Resolutions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/notifications.php">Notifications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/faq.php">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/contact.php">Contact</a>
      </li>

       <!-- give user option to logout -->
       <?php
           if(isset($_SESSION['username'])){
        ?>
        <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/logout.php">Logout</a>
        </li>
        <?php
           }
        ?>
    </ul>
  </div>
</nav>