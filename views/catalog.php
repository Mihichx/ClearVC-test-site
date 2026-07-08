<div class="container">
    <div class="row bg-dark mt-5">
        <div class="col-6 text-white">
            <div class="p-5 rounded">
                <form method="GET">
                    <select name="sort" class="form-select" aria-label="Default select example">
                        <option selected>Сортировка</option>
                        <option value="ASC">По возрастанию цены</option>
                        <option value="DESC">По убыванию цены</option>
                    </select>
                    <button type="submit">Применить</button>
                </form>
            </div>
        </div>
        <div class="col-6 text-white">
            <div class="p-5 rounded">
                <form method="GET" class="d-flex" role="search">
                    <input name="search" class="form-control me-2" type="search" placeholder="Искать" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row g-5 mt-5">
        <? foreach ($products as $item): ?>
            <div class="col-4 text-white">
                <div class="bg-dark p-5 rounded">
                    <form method="POST">
                        <input type="hidden" name="id_product" value="<?= $item['id'] ?>">
                        <h3><?= $item['product_name'] ?></h3>
                        <h5 class="text-white-50"><?= $item['category_name'] ?></h5>
                        <h5><?= $item['price'] ?> руб.</h5>
                        <button class="btn btn-primary" type="submit">Добавить</button>
                    </form>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
<!-- ... Ваш существующий код (строки 1-38) ... -->
    </div> <!-- Закрывающий тег строки товаров (строка 38) -->

    <!-- БЛОК ПАГИНАЦИИ -->
    <?php if (isset($total_pages) && $total_pages > 1): ?>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="Навигация по каталогу">
                    <ul class="pagination">
                        
                        <!-- Кнопка Назад -->
                        <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                            <?php
                            $prev_params = $_GET;
                            $prev_params['page'] = $current_page - 1;
                            ?>
                            <a class="page-link" href="?<?php echo http_build_query($prev_params); ?>">Назад</a>
                        </li>

                        <!-- Кнопки с номерами страниц -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <?php
                            // Копируем все GET-параметры и подставляем текущую страницу цикла
                            $page_params = $_GET;
                            $page_params['page'] = $i;
                            ?>
                            <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?<?php echo http_build_query($page_params); ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Кнопка Вперед -->
                        <li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                            <?php
                            $next_params = $_GET;
                            $next_params['page'] = $current_page + 1;
                            ?>
                            <a class="page-link" href="?<?php echo http_build_query($next_params); ?>">Вперед</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
    <?php endif; ?>

</div> <!-- Самый последний закрывающий контейнер (строка 39) -->

