
// function delOperation(id) {
//     // Вызываем функцию для отправки AJAX-запроса
//     var xhr = sendDeleteRequest(id);
//
//     // Отслеживаем состояние запроса
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             // Если запрос выполнен успешно, удаляем строку из таблицы
//             var row = document.getElementById(id);
//             if (row) {
//                 row.parentNode.removeChild(row);
//             }
//         }
//     };
// }

function delOperation(id) {
    // Вызываем функцию для отправки AJAX-запроса
    var xhr = sendDeleteRequest(id);

    // Отслеживаем состояние запроса
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Получаем ответ от сервера
                var response = JSON.parse(xhr.responseText);

                // Проверяем статус ответа
                if (response.status === 'success') {
                    // Удаляем строку из таблицы
                    var row = document.getElementById(id);
                    if (row) {
                        row.parentNode.removeChild(row);
                    }
                } else {
                    // Выводим сообщение об ошибке удаления
                    alert(response.message);
                }
            } else {
                // Выводим сообщение об ошибке сервера
                alert('Ошибка сервера');
            }
        }
    };
}
