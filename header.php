<head>
<!-- bootstrap files  -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<!-- bootstrap nav bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">CDBAT</a>
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
        if(!isset($_SESSION['email'])){
      ?>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/login.php">Login</a>
      </li>
      <?php
        }
        // user login
        if(isset($_SESSION['email'])){

    ?>
      <!-- drop downs -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="https://cypress-cdbat.000webhostapp.com/create_report.php">Create Report</a>
          <a class="dropdown-item" href="https://cypress-cdbat.000webhostapp.com/edit_report.php">Edit Report</a>
          <a class="dropdown-item" href="https://cypress-cdbat.000webhostapp.com/delete_report.php">Delete Report</a>
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
      <!-- end php -->
      <?php }?>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/faq.php">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/contact.php">Contact</a>
      </li>

        <?php
        // user login
        if(isset($_SESSION['email'])){
          ?>
          <li class="nav-item">
          <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/accounts.php">Account Setting</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="https://cypress-cdbat.000webhostapp.com/logout.php">Logout</a>
          </li>
        <?php
           }
        ?>
    </ul>
  </div>
</nav>
