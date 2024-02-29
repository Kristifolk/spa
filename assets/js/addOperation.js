function sendAddOperationRequest() {
    let amountField = $('#amount');
    let typeField = $('#type');
    let descriptionField = $('#description');

    let amount = amountField.val();
    let type = typeField.val();
    let description = descriptionField.val();

    $.ajax('/controllers/addOperation.php', {
        method: 'POST',
        data: {amount: amount, type: type, description: description},
        success: function (data) {
            let result = JSON.parse(data);
            if (result.error) {
                alert(result.error);
            }
            const operationData = result.operationData;
            const totalIncome = result.totalIncome;
            const totalExpense = result.totalExpense;
            // Данные после обновления. Выводим новую строку с данными в таблицу
            const tableRow =
                '<tr id="' + operationData['id'] + '">'
                + '<td>' + operationData['amount'] + '</td>'
                + '<td>' + operationData['type'] + '</td>'
                + '<td>' + operationData['description'] + '</td>'
                + '<td>' + operationData['created_at'] + '</td>'
                + '<td>' + operationData['user_name'] + '</td>'
                + '<td><button type="submit" name="button" onClick="sendDeleteRequest(' + operationData['id']
                + ')">Удалить</button></td>'
                + '</tr>';
            //в начало (в верхнюю часть) элемента <tbody> таблицы с классом table
            let tableTbodyField = $('.table tbody');
            tableTbodyField.prepend(tableRow);

            //Выводим данные сумм в #total2
            const totalSum =
                '<div>'
                + '<h3>' + 'Итого за:' + '</h3>'
                + '<h5>' + 'Сумма Прихода: ' + totalIncome + 'руб' + '</h5>'
                + '<h5>' + 'Сумма Расхода: ' + totalExpense + 'руб' + '</h5>'
                + '</div>'

            $('#total2').html(totalSum);
            // Скрываем текущие данные #total
            document.getElementById("total").style.display = "none";

            // Обнуление Суммы и Комментарий
            amountField.val('');
            descriptionField.val('');

            // Скрытие строк таблицы, если их количество превышает 10
            let tableRows = tableTbodyField.find('tr');
            if (tableRows.length > 10) {
                tableRows.slice(10).hide();
            }
        },

        error: function (e) {
            console.log(e);
        }
    });
}
