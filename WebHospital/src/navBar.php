<?php 
  session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
      <img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Hospital Tracking
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php
  if(isset($_SESSION['isConnected'])){
  ?>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav mr-auto">
      <a class="nav-item nav-link" href="home.php">Overview</a>
      <a class="nav-item nav-link" href="patient.php">Patients</a>
      <a class="nav-item nav-link" href="#">Tracking</a>
      <a class="nav-item nav-link" href="#">Settings</a>
    </div>
  </div>
  <?php 
    }
  ?>
</nav>
