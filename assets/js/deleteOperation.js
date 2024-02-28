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
                console.log(result);
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


                // // Данные после обновления. Выводим новую строку с данными в таблицу
                // const tableNew =
                //     '<tr id="'+ result[0]['id']+'">'
                //     +'<td>'+ result[0]['amount'] +'</td>'
                //     +'<td>'+ result[0]['type'] +'</td>'
                //     +'<td>'+ result[0]['description'] +'</td>'
                //     +'<td>'+ result[0]['created_at'] +'</td>'
                //     +'<td>'+ result[0]['user_name'] +'</td>'
                //     +'<td><button type="submit" name="button" onClick="sendDeleteRequest('+ result[0]['id']
                //     +')">Удалить</button></td>'
                //     +'</tr>';
                //
                // // Обновить элемент <tbody> таблицы с классом table
                // $('.table tbody').html(tableNew);


                // // Скрываем текущие данные #total
                //document.getElementById("tbody").style.display = "none";

                // Обновление списка строк таблицы
                let tableRows = $('.table tbody tr');
                if (tableRows.length > 10) {
                    tableRows.slice(10).remove();
                }
            }
        });
    });
}
