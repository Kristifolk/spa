function sendDeleteRequest(id){
    $(document).ready(function() {
        $.ajax({
            url: '/controllers/deleteOperation.php',
            type: 'GET',
            data: {id: id},
            success: function (data) {
                //скрытие элемента с id
                document.getElementById(id).style.display = "none";

                let result = JSON.parse(data);
                if(result.error) {
                    alert(result.error);
                }
                // Данные после обновления. Выводим данные сумм в #total2
                const totalSum =
                    '<div>'
                    +'<h3>'+ 'Итого за:' +'</h3>'
                    +'<h5>'+ 'Сумма Прихода: ' + result[0] + 'руб' + '</h5>'
                    +'<h5>'+ 'Сумма Расхода: ' + result[1] + 'руб' + '</h5>'
                    +'</div>'
                $('#total2').html(totalSum);

                // Скрываем текущие данные #total
                document.getElementById("total").style.display = "none";

                let tableNew = '';
                const innerArray = result[2]; // Получаем внутренний массив
                for (let i = 0; i < innerArray.length; i++) {
                    // Данные после обновления. Выводим новую строку с данными в таблицу
                    const tableRow =
                        '<tr id="' + innerArray[i]['id'] + '">'
                        + '<td>' + innerArray[i]['amount'] + '</td>'
                        + '<td>' + innerArray[i]['type'] + '</td>'
                        + '<td>' + innerArray[i]['description'] + '</td>'
                        + '<td>' + innerArray[i]['created_at'] + '</td>'
                        + '<td>' + innerArray[i]['user_name'] + '</td>'
                        + '<td><button type="submit" name="button" onClick="sendDeleteRequest(' + innerArray[i]['id']
                        + ')">Удалить</button></td>'
                        + '</tr>';
                    tableNew += tableRow;
                }

                // Обновить элемент <tbody> таблицы с классом table
                $('.table tbody').html(tableNew);

                // Обновление списка строк таблицы
                let tableRows = $('.table tbody tr');
                if (tableRows.length > 10) {
                    tableRows.slice(10).remove();
                }
            },

            error: function (e) {
                console.log(e);
            }
        });
    });
}
