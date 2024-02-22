<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
use src\models\Operation;
$operation = new Operation();
//$operations = //записи операций из БД
$types = $operation->types();
var_dump($types);
//$income = //приход
//$expense = //расход
if (!empty($_SESSION['auth'])):
    echo "views main";
    ?>
    <h1>Main</h1>

    <form id="addOperation" action="/controllers/addOperation.php" method="POST"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 ">
                <label for="amount" class="form-label">Сумма, руб:</label>
                <input type="text" name="amount" id="amount" placeholder="Сумма" class="form-control">
            </div>
            <div class="col-12 mt-3">
                <label for="type" class="form-label">Тип:</label>
                <select name="type" id="type" class="form-control">
                    <?php
                    foreach ($types as $type):
                        ?>
                        <option value="<?= $type['type'] ?>">
                            <?= $type['type']; ?>
                        </option>
                    <?php
                    endforeach; ?>
                </select>
            </div>
            <div class="col-12 mt-3">
                <label for="description" class="form-label">Комментарий:</label>
                <textarea name="description" id="description" placeholder="Комментарий" class="form-control"></textarea>
            </div>
            <div class="col-3 d-grid g-3 mt-3">
                <button type="submit" class="btn btn-primary">Добавить запись</button>
            </div>
        </div>
    </form>

    <!-- Таблица START -->
    <h2>Последние 10 записей</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Сумма</th>
            <th>Тип</th>
            <th>Комментарий</th>
            <th>Дата</th>
            <th>Имя</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($operations as $operation): ?>
            <tr id="<?= $operation['id']; ?>">
                <td><?= $operation['amount']; ?></td>
                <td><?= $operation['type']; ?></td>
                <!-- из табл $operations поле type и табл types поле title as type   -->
                <td><?= $operation['description']; ?></td>
                <td><?= $operation['created_at']; ?></td>
                <td>
                    <button>Удалить</button><!--Ajax-->
                </td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
    <!-- Таблица END -->

    <!-- total START        или перенести в  sidebar?
    <div class="sidebar col-12 col-md-3">
                {total}
    </div> -->
    <div>
        <h3>Итого за:</h3><!-- можно сделать выбор периода. Сейчас за все время -->
        <h5>Сумма Прихода: <?= $income ?> </h5>
        <h5>Сумма Расхода: <?= $expense ?> </h5>
        <!-- можно сделать Баланс = Приход - Расход -->
    </div>
    <!-- total END -->


    -->
<?php
else:
    header('Location: login.php');
endif; ?>
