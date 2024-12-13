<h2>Créer un compte</h2>
<div class="container">
  <div class="d-flex justify-content-center vh-100 align-items-center">
    <form class="w-50" method="post" action="">

      <label for="name" class="form-label">name</label>
      <input type="name" class="form-control" id="name" name="name" required />

      <label for="role" class="form-label">role</label>
      <input type="role" class="form-control" id="role" name="role" required />

      <label for="login" class="form-label">email</label>
      <input type="email" class="form-control" id="login" name="email" required />
      <h4 class="text-danger"></h4>

      <label for="pwd" class="form-label">password</label>
      <input type="password" class="form-control" id="pwd" name="password" required />
      <label for="pwd" class="form-label">confirm password</label>
      <input type="password" class="form-control" id="pwd" name="confirm_password" required />

      <button type="submit" class="btn btn-success mt-3">Envoyer</button>
    </form>
  </div>
