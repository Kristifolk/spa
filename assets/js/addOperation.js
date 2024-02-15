let addOperation = document.querySelector("#addOperation");
if (addOperation) {
    addOperation.addEventListener('submit', e => {
        e.preventDefault();
        let xhr = new XMLHttpRequest();
        xhr.onloadend = function () {
            checkStatusWithAlert(xhr);
        }
        xhr.open('POST', addOperation.action);
        let formData = new FormData(addOperation);
        xhr.send(formData);
    });
}
