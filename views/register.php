<div class="my-5">
  <h3 class="text-black text-center">Регистрация</h3>
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
          <div class="form-group mt-2">
            <label>Повторите пароль</label>
            <input type="password" class="form-control" name="password1">
          </div>
          <a href="/login" class="d-block text-center mt-3">Вход</a>
          <button type="submit" class="btn btn-primary mt-3 d-block mx-auto">Регистрация</button>
        </form>
      </div>
    </div>
  </div>
</div>
