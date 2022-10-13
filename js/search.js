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
const searchUserForm = document.getElementById('searchUser');

searchUserForm.addEventListener('submit', (event) => {
	event.preventDefault();

	let formValue = {
        username: document.getElementById('un').value
    }

    
    //get the match summary
    let matchesSummary = () => {
    	//Send data to db
    let url = `${searchUserForm.getAttribute('action')}?a=seaUs&dets=msummary`;
    let summaryHolder = document.getElementById('match-calculate');
    let formOptions = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(formValue)
    }
    fetch(url, formOptions)
    .then(response => response.text())
    .then((data) => {
        // JSON.parse(data);
        summaryHolder.innerHTML = data;
        console.log(`${data}`)
    })
    }
    //get the debt summary
    let debtSummary = () => {
        //Send data to db
    let url = `${searchUserForm.getAttribute('action')}?a=seaUs&dets=dtsummary`;
    let summaryHolder = document.getElementById('debt-calculate');
    let formOptions = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(formValue)
    }
    fetch(url, formOptions)
    .then(response => response.text())
    .then((data) => {
        // JSON.parse(data);
        summaryHolder.innerHTML = data;
        console.log(`${data}`)
    })
    }
    //latest matches
    let individualMatches = () => {
        //Send data to db
    let url = `${searchUserForm.getAttribute('action')}?a=seaUs&dets=recentms`;
    let display = document.getElementById('latest-lost-individual');
    let formOptions = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(formValue)
    }
    fetch(url, formOptions)
    .then(res => res.text())
    .then((data) => {
        display.innerHTML = data;
        // console.log(data)
    })
    }
    //recent individual transactions
    let individualTransactions = () => {
        let url = `${searchUserForm.getAttribute('action')}?a=seaUs&dets=indTrans`;
        let display = document.getElementById('recent-transactions-individual');
        let formOptions = {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify(formValue)
        }
        fetch(url, formOptions)
        .then(res => res.text())
        .then((data) => {
            display.innerHTML = data;
            // console.log(data)
        })
    }


    //get the match summary
    matchesSummary();
    //get the debt summary
    debtSummary();
    //get the latest matches
    individualMatches();
    //get the latest transactions
    individualTransactions();
})