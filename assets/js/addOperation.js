function sendAddOperationRequest(){
    $(document).ready(function() {
        let amount = document.getElementById("amount").value;
        let type = document.getElementById("type").value;
        let description = document.getElementById("description").value;
        $.ajax({
            url: '/controllers/addOperation.php',
            type: 'POST',
            data: {amount: amount, type: type, description: description},
            success: function (data) {
                //скрытие элемента
                // document.getElementById(id).style.display = "none";

                let result = JSON.parse(data);
                // Данные после обновления. Выводим новую строку с данными в таблицу
                const tableRow =
                    '<tr id="'+ result[0]['id']+'">'
                        +'<td>'+ result[0]['amount'] +'</td>'
                        +'<td>'+ result[0]['type'] +'</td>'
                        +'<td>'+ result[0]['description'] +'</td>'
                        +'<td>'+ result[0]['created_at'] +'</td>'
                        +'<td>'+ result[0]['user_name'] +'</td>'
                        +'<td><button type="submit" name="button" onClick="sendDeleteRequest('+ result[0]['id']
                        +')">Удалить</button></td>'
                    +'</tr>'
                //в начало (в верхнюю часть) элемента <tbody> таблицы с классом table
                $('.table tbody').prepend(tableRow);
                //Выводим данные сумм в #total2
                const totalSum =
                    '<div>'
                    +'<h3>'+ 'Итого за:' +'</h3>'
                    +'<h5>'+ 'Сумма Прихода: ' + result[1] + 'руб' + '</h5>'
                    +'<h5>'+ 'Сумма Расхода: ' + result[2] + 'руб' + '</h5>'
                    +'</div>'

                $('#total2').html(totalSum);
                // Скрываем текущие данные #total
                document.getElementById("total").style.display = "none";

                // // Обнуление Суммы и Комментарий
                // $('#amount').val('');
                // $('#description').val('');
            }
        });
    });
}
