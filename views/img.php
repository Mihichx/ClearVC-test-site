<div class="text-center mt-5">
    <? if (isset($error)): ?> <h5 style="color: red;"><?= htmlspecialchars($error) ?></h5> <? endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="img">
        <button type="submit">Отправить</button>
    </form>
</div>
