document.addEventListener('click', e=> {
    if (e.target.tagName === 'A'){
        routeHref(e.target.getAttribute('href'));
        e.preventDefault();
    }
});

//кастомный роутинг для ссылок
const routeHref = (path) => {
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

//асинхронная функция, j будет подгружать страницы по указанному адресу
const handleLocation = async () => {
    const path = window.location.pathname;
    const html = await fetch(routersHref[path]).then((data) => data.text());
    document.querySelector('.container').innerHTML = html;

}

//кастомный роутинг для кнопки
// const routeBtn = (path) => {
//     window.history.pushState({}, '', path);
//     handleLocation(routersBtn);
// }
//
// //соответствие ссылок и страниц
// const routersBtn = {
//     '/login': 'controllers/login.php',
//     '/registration': 'controllers/registration.php',
//     '/': 'controllers/addOperation.php'
//     //'/': 'controllers/logout.php'//уточнить ссылка или кнопка и + доп if на роутинг
// }

//перезаписать стрелочки назад/вперед переход по истории в браузере//Не работает
window.onpopstate = handleLocation//уточнить
//перезаписать стандартный роут на кастомный
window.route = routeHref;
//чтобы при перезагрузке отображалась  const html
//уточнить почему при перезагрузке logout.php, а не const html
handleLocation(routersHref);//уточнить
//handleLocation(routersBtn);//уточнить
