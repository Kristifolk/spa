document.addEventListener('click', e=> {
    //target.tagName если имя тега на который тыкнули ссылка
    if (e.target.tagName === 'A'){
        routeHref(e.target.getAttribute('href')); // Передаем путь из атрибута href
    }
    if (e.target.tagName === 'BUTTON') {
        routeBtn(e.target.getAttribute('data-route')); // Передаем предопределенный маршрут из атрибута data-route);
    }
    e.preventDefault();
});

//кастомный роутинг для ссылок
const routeHref = (path) => {
    //добавляет новый элемент в историю(аргументы состояние истории стрелочки назад/вперед переход по истории в браузере; заголовок стрaницы в окне браузера;url в адресной строке;
    window.history.pushState({}, '', path);
    handleLocation(routersHref);
}
//соответствие ссылок и страниц
const routersHref = {
    '/': 'views/main.php',
    '/login': 'views/login.php',
    '/registration': 'views/registration.php'
    //'/logout': 'logout.php'//Нет вью только контроллер
}
//асинхронная функция, j которая будет подгружать страницы по указанному адресу
const handleLocation = async (routers) => {
    //адрес, j считываем с адресной строки
    const path = window.location.pathname;
    //страничка с html получаем fetch и переводим в текстовый формат
    const html = await fetch(routers[path]).then((data) => data.text());
    //добавить const html на главную страницу
    document.querySelector('.container').innerHTML = html;

}

//кастомный роутинг для кнопки
const routeBtn = (path) => {
    //добавляет новый элемент в историю(аргументы состояние истории стрелочки назад/вперед переход по истории в браузере; заголовок стрaницы в окне браузера;url в адресной строке;
    window.history.pushState({}, '', path);
    handleLocation(routersBtn);
}
//соответствие ссылок и страниц
const routersBtn = {
    '/login': 'controllers/login.php',
    '/registration': 'controllers/registration.php',
    '/': 'controllers/addOperation.php'
    //'/': 'controllers/logout.php'//уточнить ссылка или кнопка и + доп if на роутинг
}


//перезаписать стрелочки назад/вперед переход по истории в браузере
window.onpopstate = handleLocation;//уточнить
//перезаписать стандартный роут на кастомный
window.route = route;
//чтобы при перезагрузке отображалась  const html
//уточнить почему при перезагрузке logout.php, а не const html
handleLocation(routersHref);//уточнить
handleLocation(routersBtn);//уточнить
