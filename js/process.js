//Global Variables
const looserForm = document.getElementById('looser-form');
const fairForm = document.getElementById('fair-form');
const payForm = document.getElementById('pay-form');


//Looser Form 
looserForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let formValues = {
        fpl: document.getElementById('hp').value,
        spl: document.getElementById('ap').value,
        ft: document.getElementById('ht').value,
        st:document.getElementById('at').value,
        fsc: document.getElementById('hsc').value,
        ssc: document.getElementById('asc').value,
        mty: document.getElementById('mtyp').value,
        coupon: document.getElementById('coup').value
    }

    let payableAmt;
    let couponVal;
    let netPay;
    let gamesNumber;
    //Check The Type of match
    switch(formValues.mty){
        case 'hut':
            payableAmt = 15;
            gamesNumber = 1;
            break;
        case 'fut':
            payableAmt = 30;
            gamesNumber = 1;
            break;
        case 'nus':
            payableAmt = 15;
            gamesNumber = 1;
            break;
        case 'sul':
            payableAmt = 60;
            gamesNumber = 2;
            break;
        case 'ssl':
            payableAmt = 90;
            gamesNumber = 3;
            break;
        default:
            payableAmt = 30;
    }
    //Check Coupon Value
    switch (formValues.coupon) {
        case 'cst':
            couponVal = 5
            netPay = payableAmt - (couponVal*gamesNumber);
            break;
    
        default:
            couponVal = 0;
            netPay = payableAmt - couponVal;
            break;
    }
    alert(`Payable amount is ${netPay}`)

    let newFormData = {...formValues, debt: netPay};
    //console.log(newFormData)
//    let nVals = JSON.stringify(newFormData);
//     console.log(nVals)
    //Send data to db
    let url = looserForm.getAttribute('action');
    let formOptions = {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        headers: {
        'Content-Type': 'application/json'
        // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: JSON.stringify(newFormData)
    }
    fetch(url, formOptions)
    .then(response => response.json())
    .then((data) => {
        JSON.parse(data);
        console.log(`Success: ${data}`)
    })
})