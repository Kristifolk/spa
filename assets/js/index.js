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
    '/registration': 'views/registration.php',
    '/logout': 'controllers/logout.php'//очищает сессию и Должен редиректит на views/logout.php (или на login,тогда можно удалить views/logout.php), но не делает
    //'/logout': 'views/logout.php'//кидает на views/logout.php минуя controllers/logout.php и сессия не очищается
}

//асинхронная функция, j будет подгружать страницы по указанному адресу
const handleLocation = async () => {
    const path = window.location.pathname;
    const html = await fetch(routersHref[path]).then((data) => data.text());
    document.querySelector('.container').innerHTML = html;
}

//перезаписать стрелочки назад/вперед переход по истории в браузере
window.onpopstate = handleLocation
window.route = routeHref;//перезаписать стандартный роут на кастомный
handleLocation(routersHref);//чтобы при перезагрузке отображалась  const html
