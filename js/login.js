//Custom Loaders
//On Load
window.addEventListener('load', () => {
    const loader = document.querySelector('.loader');
    const circle = document.querySelector('.circle');

    // function changeOpacity(elem) {
    //     elem.style.opacity = '0';
      let changeOpacity = (elem) => {
        elem.style.opacity = "0";
        elem.style.display = "none";
    }

    setInterval(changeOpacity(loader), 5000);
    setInterval(changeOpacity(circle), 3000);
    // }
   
})
const loginForm = document.getElementById('login-form');

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let fromdb = document.getElementById('feedback');
    let formValues = {
        uname: document.getElementById('un').value,
        pass:document.getElementById('pwd').value
    }

    let url = `${loginForm.getAttribute('action')}?a=loginAdmin`;
    let formOptions = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(formValues)
    }
    fetch(url, formOptions)
    .then(response => response.text())
    .then((data) => {
        if(data.indexOf('Successful') > 0){
            fromdb.innerHTML = data;
            fromdb.classList.add('alert');
            fromdb.classList.add('alert-success');
        }
        if(data.indexOf('Wrong') > 0){
            fromdb.innerHTML = data;
            fromdb.classList.add('alert');
            fromdb.classList.add('alert-danger');
        }
        
    })
})