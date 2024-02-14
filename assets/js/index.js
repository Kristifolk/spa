document.addEventListener('click', e=> {
    //если имя тега на который тыкнули ссылка
    if (e.target.tagName === 'A'){


    }
    e.preventDefault();
})
//кастомный роутинг
const route = () =>{
    //добавляет новый элемент в историю(аргументы состояние истории стрелочки назад/вперед переход по истории в браузере; заголовок строницы в окне браузера;url в адресной строке;
    window.history.pushState({}, '', e.target.href);

}