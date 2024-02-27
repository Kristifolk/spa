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
            }
        });
    });
}
