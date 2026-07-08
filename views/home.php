<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-inner mt-5">
    <? foreach($stock as $index => $row): ?>
      <div class="carousel-item text-center p-5 <?= ($index === 0) ? 'active' : '' ?> bg-dark">
        <a class="text-white d-block hover" href="/stock">
          <img src="/assets/img/ghost.jpg" class="d-block m-auto rounded" style="width: 300px;" alt="...">
          <h3><?= htmlspecialchars($row['name']) ?></h3>
          <h5><?= htmlspecialchars($row['description']) ?></h5>
        </a>
      </div>
    <? endforeach; ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="mt-5">
  <div class="container">
    <div class="row">
      <? foreach($about as $row): ?>
        <div class="col-6">
          <div class="bg-dark p-5 text-white text-break rounded">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <h5><?= htmlspecialchars($row['description']) ?></h5>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  </div>
</div>

<div class="mt-5 p-5 bg-dark">
  <h3 class="text-white text-center">Популярные товары</h3>
  <div class="container py-5">
    <div class="row g-5">
      <? foreach($items as $row): ?>
        <div class="col-6 col-md-4">
          <div class="card rounded">
            <img src="/assets/img/ghost.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <form>
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <h5><?= htmlspecialchars($row['small-description']) ?></h5>
                <button href="#" class="btn btn-primary">Добавить</button>
              <form>
            </div>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  </div>
</div>

<div class="mt-5">
  <h3 class="text-dark text-center">Новинки</h3>
  <div class="container">
    <div class="row g-5">
      <? foreach($items1 as $row): ?>
        <div class="col-6 col-md-4">
          <div class="bg-dark p-5 text-white text-break rounded">
            <form action="/catalog" method="POST">
              <input type="hidden" name="id_product" value="<?= $row['id'] ?>">
              <img src="/assets/img/ghost.jpg" class="card-img-top" alt="...">
              <h3><?= htmlspecialchars($row['title']) ?></h3>
              <h5><?= htmlspecialchars($row['small-description']) ?></h5>
              <button class="btn btn-primary" type="submit">Добавить</button>
            </form>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  </div>
</div>

<div class="mt-5 p-5 bg-dark">
  <h3 class="text-white text-center">Наши отзывы</h3>
  <div class="container py-5">
    <div class="row g-5">
      <? foreach($reviews as $row): ?>
        <div class="col-6 col-md-4">
          <div class="card rounded text-center"">
            <div class="card-body text-center">
              <a class="text-dark hover" href="/reviews">
                <i class="fas fa-user h1"></i>
                <h3><?= htmlspecialchars($row['name']) ?></h3>
                <h5><?= htmlspecialchars($row['description']) ?></h5>
                <? for ($i = 0; $i < $row['stars']; $i++): ?><i class="fas fa-star"></i><? endfor; ?>
              </a>
            </div>
          </div>
        </div>
      <? endforeach; ?>
    </div>
  </div>
</div>

<div class="my-5">
  <h3 class="text-black text-center">Мы вам напишем</h3>
  <div class="d-flex align-items-center justify-content-center">
      <div class="w-25">
        <form method="POST">
          <div class="form-group mt-2">
            <label>Имя</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group mt-2">
            <label>Телефон</label>
            <input type="text" class="form-control" name="number">
          </div>
          <button type="submit" class="btn btn-primary mt-3 d-block mx-auto">Отправить</button>
        </form>
      </div>
    </div>
  </div>
</div>
