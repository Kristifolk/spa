<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use src\models\Operation;

$operation = new Operation();
$operations = $operation->lastTenOperations();
$types = $operation->types();
$income = $operation->totalIncome();
$expense = $operation->totalExpense();
if (!empty($_SESSION['auth'])):
    ?>
    <h1>Main</h1>
    <div class="row">
        <div class="col-12 ">
            <label for="amount" class="form-label" >Сумма, руб:</label>
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
            <button type="submit" name="button" class="btn btn-primary" onclick="sendAddOperationRequest()">Добавить
                запись
            </button>
        </div>
    </div>

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
                <td><?= $operation['description']; ?></td>
                <td><?= $operation['created_at']; ?></td>
                <td><?= $operation['user_name']; ?></td>
                <td>
                    <button type="submit" name="button" onclick="sendDeleteRequest(<?= $operation['id']; ?>)">Удалить
                    </button>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
    <!-- Таблица END -->

    <div id="total">
        <!-- можно сделать выбор периода. Сейчас за все время -->
        <h3>Итого за:</h3>
        <h5>Сумма Прихода: <?= $income ?> руб</h5>
        <h5>Сумма Расхода: <?= $expense ?> руб</h5>
        <!-- можно сделать Баланс = Приход - Расход -->
    </div>
    <!-- Данные после обновления -->
    <div id="total2"></div>

    <!-- total END -->

<?php
else:
    header('Location: login.php');
endif; ?>
