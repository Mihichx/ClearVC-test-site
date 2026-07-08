<div class="my-5">
  <h3 class="text-black text-center">Вход</h3>
  <div class="d-flex align-items-center justify-content-center">
      <div class="w-25">
        <h5 class="text-center" style="color: red;"><?= $_SESSION['error'] ?? '' ?></h5>
        <form method="POST">
          <div class="form-group mt-2">
            <label>Имя</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group mt-2">
            <label>Пароль</label>
            <input type="password" class="form-control" name="password">
          </div>
          <a href="/register" class="d-block text-center mt-3">Регистрация</a>
          <button type="submit" class="btn btn-primary mt-3 d-block mx-auto">Вход</button>
        </form>
      </div>
    </div>
  </div>
</div>
