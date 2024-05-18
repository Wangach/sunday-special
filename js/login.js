"use strict";
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
        dest: document.getElementById('role').value,
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
    //clear the feedback
        let clearFeed = (clr) => {
            fromdb.classList.remove('j-alert');
            fromdb.classList.remove(`j-alert-${clr}`);
            fromdb.innerHTML = '';
        }
    fetch(url, formOptions)
    .then(response => response.text())
    .then((data) => {
        if(data.indexOf('Successful') > 0){
            fromdb.innerHTML = data;
            fromdb.classList.add('j-alert');
            fromdb.classList.add('j-alert-success');

            //clear after 5 secs
            setTimeout(() => {
                clearFeed('success');
                // Redirect To Logged Page
                window.location.href = "logged.php";
            }, 5000);
        }
        if(data.indexOf('Try') > 0){
            fromdb.innerHTML = data;
            fromdb.classList.add('j-alert');
            fromdb.classList.add('j-alert-danger');

            //clear after 5 secs
            setTimeout(() => {clearFeed('danger')}, 5000);
        }
        
    })
    .catch((err) => {
        console.log(err);
        fromdb.innerHTML = err;
        fromdb.classList.add('j-alert');
        fromdb.classList.add('j-alert-danger');
    })
})

