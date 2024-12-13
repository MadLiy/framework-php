<div class="container">
  <div class="d-flex justify-content-center vh-100 align-items-center flex-column">
    <form class="w-50 text-center" method="post" action="">
      <h4 class="text-danger"><?php echo $message ?></h4>
      <label for="login" class="form-label">email</label>
      <input type="email" class="form-control" id="login" name="email" required />
      <label for="pwd" class="form-label">password</label>
      <input type="password" class="form-control" id="pwd" name="password" required />
      <button type="submit" class="btn btn-success mt-3">Envoyer</button>
    </form>
    <a href="/register" class="btn btn-primary">Créer un compte</a>
  </div>
