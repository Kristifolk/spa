function sendAddOperationRequest() {
    $(document).ready(function () {
        let amount = document.getElementById("amount").value;
        let type = document.getElementById("type").value;
        let description = document.getElementById("description").value;
        $.ajax('/controllers/addOperation.php', {
            method: 'POST',
            data: {amount: amount, type: type, description: description},
            success: function (data) {
                //скрытие элемента
                // document.getElementById(id).style.display = "none";

                let result = JSON.parse(data);
                if(result.error) {
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
                $('.table tbody').prepend(tableRow);
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
                $('#amount').val('');
                $('#description').val('');

                // Скрытие строк таблицы, если их количество превышает 10
                let tableRows = $('.table tbody tr');
                if (tableRows.length > 10) {
                    tableRows.slice(10).hide();
                }
            },

            error: function (e) {
                console.log(e);
            }
        });
    });
}
