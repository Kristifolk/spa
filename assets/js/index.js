document.addEventListener('click', e=> {
    if (e.target.tagName === 'A'){
        routeHref(e.target.getAttribute('href'));
        e.preventDefault();
    }
});

//кастомный роутинг для ссылок
const routeHref = (path) => {
    window.history.pushState({}, '', path);
    handleLocation(routersHref).then(r =>  {
        console.log('Содержимое успешно загружено!');
    });
}

//соответствие ссылок и страниц
const routersHref = {
    '/': 'views/main.php',
    '/login': 'views/login.php',
    '/registration': 'views/registration.php'
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
handleLocation(routersHref).then(r => {
    console.log('Содержимое успешно загружено!');
});//чтобы при перезагрузке отображалась  const html
