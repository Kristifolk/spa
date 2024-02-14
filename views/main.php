<?php

?>
<h1>Main</h1>

<form id="addOperation" action="/controllers/Main.php" method="POST"
      enctype="multipart/form-data">  <!--addOperation в checkStatus....js-->
    <div class="row">
        <div class="col-12 ">
            <label for="sum" class="form-label">Сумма, руб:</label>
            <input type="text" name="sum" id="sum" placeholder="Сумма" class="form-control">
        </div>
        <div class="col-12 mt-3">
            <label for="type" class="form-label">Тип:</label>
            <select name="type" id="type" class="form-control">
                <?php
                foreach ($types as $type): //из БД?>
                    <option value="<?= $type['id'] ?>">
                        <?= $type['title']; ?>
                    </option>
                <?php
                endforeach; ?>
            </select>
        </div>
        <div class="col-12 mt-3">
            <label for="comment" class="form-label">Комментарий:</label>
            <textarea name="comment" id="comment" placeholder="Комментарий" class="form-control"></textarea>
        </div>
        <div class="col-3 d-grid g-3 mt-3">
            <input type="submit" value="Добавить запись" class="btn btn-success">
        </div>
    </div>
</form>

<!-- Таблица START -->
<h2>Последние 10 записей</h2>
<table class="table">
    <h2>Таблица</h2>

</table>
<!-- Таблица END -->
