document.addEventListener('click', e=> {
    //если имя тега на который тыкнули ссылка
    if (e.target.tagName === 'A'){
        route(e);

    }
    e.preventDefault();
});
//кастомный роутинг
const route = (e) => {
    //добавляет новый элемент в историю(аргументы состояние истории стрелочки назад/вперед переход по истории в браузере; заголовок стрaницы в окне браузера;url в адресной строке;
    window.history.pushState({}, '', e.target.href);
    handleLocation();
}
//соответствие ссылок и страниц
const routers = {
    '/': 'views/main.php',
    '/login': 'views/login.php',
    '/registration': 'views/registration.php'
    //'/logout': 'logout.php'//Нет вью только контроллер

}
//асинхронная функция, j которая будет подгружать страницы по указанному адресу
const handleLocation = async () => {
    //адрес, j считываем с адресной строки
    const path = window.location.pathname;
    //страничка с html получаем fetch и переводим в текстовый формат
    const html = await fetch(routers[path]).then((data) => data.text());
    //добавить const html на главную страницу
    document.querySelector('.container').innerHTML = html;

}
//перезаписать стрелочки назад/вперед переход по истории в браузере
window.onpopstate = handleLocation;
//перезаписать стандартный роут на кастомный
window.route = route;
//чтобы при перезагрузке отображалась  const html
handleLocation();
