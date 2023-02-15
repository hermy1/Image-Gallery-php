<?php
session_start();

//gallery selection from form 
$_SESSION['gallery'] ?? [];

// get errors
$_SESSION['error'] ?? [];

//get all images in selected gallery
$images = $_SESSION['files'] ?? [];


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="List,keywords,with,comma,separated,values" />
  <title>Images</title>
  <link type="image/x-icon" rel="icon" href="images/favicon2.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="css/mystyles.css" rel="stylesheet" />
</head>

<body>
  <header>
    <div class="container">
      <h2>Php Images</h2>
    </div>
    <nav class="navbar navbar-expand-md">
      <div class="container">
        <a class="navbar-brand" href="#">Image Gallery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
          </ul>
        </div>
      </div>
  </header>
  <main>
    <section class="container">
      <div class="row">
        <div class="col-4 mt-4 mb-5">
          <form action="gallery_controller.php" method="post">
            <div class="mb-3">
              <label for="formFile" class="form-label">Choose gallery</label>
              <select name="gallery" class="form-select" aria-label="Default select example" required>
                <option selected>Select a gallery</option>
                <option name="gallery1" value="1">Gallery 1</option>
                <option name="gallery2" value="2">Gallery 2</option>
                <option name="gallery3" value="3">Gallery 3</option>
              </select>

            </div>
            <button type="submit" name='submit' class="btn btn-primary">Submit</button>
            <div class="text-danger mt-3" role="alert">
              <?php
              if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
              }
              ?>
            </div>
            
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-7">
          <div class="row">
            <div class="mb-4">
              <div class="card">
                <div class="card-body">
                  <?php
                  if(isset($images)){
                    foreach($images as $img){ ?>
                      <img src='<?php echo $img ?>' class='card-img-top m-3' alt='...'>
                  <?php
                  }
                }
                 ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <aside>


  </aside>
  <footer class="text-center text-white">
    <div>
      © 2020 Copyright:
      <p class="text-white" href="#">Herman</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="js/myscripts.js" type="text/javascript"></script>
</body>

</html>