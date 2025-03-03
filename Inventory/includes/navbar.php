<style>
  .navbar-expand-lg {
    height: 3rem;
  }

  .navbar {
        background: #00BD79;
        color: white;
        
    }
</style>

<nav class="navbar navbar-expand-lg shadow-lg rounded-3 m-2 mx-2">
  <div class="container">

    <a class="navbar-brand text-white" href="#">Inventory System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white fw-bold" href="index.php">Home</a>
        </li>

        <?php if(isset($_SESSION['loggedIn'])) : ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="#"><?= $_SESSION['loggedInUser']['name']; ?></a>
        </li>
        <li class="nav-item">
          <a class="btn btn-danger text-white rounded-3" href="logout.php">Logout</a>
        </li>

        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link text-white fw-bold" href="login.php">Login</a>
        </li>
        <?php endif; ?>
      </ul>
      
    </div>
  </div>
</nav>