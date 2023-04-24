<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Pullo</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Pullo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('home')}}">Home</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="{{route('about')}}">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('showcontactus')}}">Contact Us</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container my-5">
    <div class="row">
      <div class="col-md-6">
        <h1>About Us</h1>
        <p>Pullo is your one-stop-shop for all your fashion and lifestyle needs. We are a team of passionate individuals who believe that everyone deserves to look and feel their best.</p>
        <p>Our mission is to provide high-quality and affordable products that cater to every style and preference. We source our products from the best manufacturers and designers to ensure that you get only the best.</p>
        <p>At Pullo, we are committed to making your shopping experience hassle-free and enjoyable. Our user-friendly website and excellent customer service make it easy for you to find what you need and get it delivered to your doorstep.</p>
        <p>Thank you for choosing Shopify. We look forward to serving you.</p>
      </div>
      <div class="col-md-6">
        <img src="bag.jpg" alt="Shopify Team" class="img-fluid">
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJ
