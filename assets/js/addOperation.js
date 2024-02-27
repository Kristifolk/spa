function sendAddOperationRequest(){
    $(document).ready(function() {
        let amount
        let type
        let description
        $.ajax({
            url: '/controllers/addOperation.php',
            type: 'POST',
            data: {amount: amount, type: type, description: description},
            success: function (data) {
                //скрытие элемента с id
                document.getElementById(id).style.display = "none";

                let result = JSON.parse(data);
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
            }
        });
    });
}
