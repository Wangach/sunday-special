//Global Variables
const looserForm = document.getElementById('looser-form');
const fairForm = document.getElementById('fair-form');
const payForm = document.getElementById('pay-form');

let wholeDay = '';
let currentTime = '';
let rNum = '';
let rid = '';

//Get the time and Date
let dte = new Date();
let now = dte.getTime();
let padTo2Digits = (num) => {
    return num.toString().padStart(2, '0');
  }
let convertMsToTime = (milliseconds) => {
    let seconds = Math.floor(milliseconds / 1000);
    let minutes = Math.floor(seconds / 60);
    let hours = Math.floor(minutes / 60);
  
    seconds = seconds % 60;
    minutes = minutes % 60;
  
    //  If you don't want to roll hours over, e.g. 24 to 00
    //  comment (or remove) the line below
    // commenting next line gets you `24:00:00` instead of `00:00:00`
    // or `36:15:31` instead of `12:15:31`, etc.
    hours = (hours % 24)+ 3;
    currentTime = `${padTo2Digits(hours)}:${padTo2Digits(minutes)}:${padTo2Digits(
        seconds,
      )}`
    return currentTime;
  }

let todaysDte = () => {
    let dte = new Date();
    let dateOfMonth = dte.getUTCDate();
    let currentMonth = dte.getUTCMonth();
    let CurrentYear = dte.getUTCFullYear();

    wholeDay = `${dateOfMonth}/${currentMonth}/${CurrentYear}`;
    return wholeDay;
}
//generate A unique Id
let genMatchId = () => {
    let myLetters = ["F", "A", "V", "O", "R", "E", "D", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
    for(let i = 0; i < 5; i++){
        rNum = Math.floor(Math.random() * (myLetters.length - 1));
        rid += myLetters[rNum];
        console.log(rid);
        return rid;
    }
    
}

//Looser Form 
looserForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    
    todaysDte();
    convertMsToTime(now);
    genMatchId();
    
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

    let payableAmt, couponVal, netPay, gamesNumber, looser, winner;
    
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
    //check for the winner and looser
    if(formValues.fsc > formValues.ssc){
        //home player has won
        winner = formValues.fpl;
        looser = formValues.spl;
    }else if(formValues.ssc > formValues.fsc){
        //away player has won
        winner = formValues.spl;
        looser = formValues.fpl;
    }else{
        winner = 'N/A';
        looser = 'N/A';
    }
    // alert(`Payable amount is ${netPay}`)

    let newFormData = {...formValues, debt: netPay, winner: winner, looser: looser, subDte: wholeDay, subTme: currentTime, 
    matchId: rid};
    //Send data to db
    let url = looserForm.getAttribute('action');
    let formOptions = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(newFormData)
    }
    fetch(url, formOptions)
    .then(response => response.text())
    .then((data) => {
        // JSON.parse(data);
        console.log(`${data}`)
    })
})

//Fair Form 
fairForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    
    todaysDte();
    convertMsToTime(now);
    genMatchId();
    
    let formValues = {
        fft: document.getElementById('fht').value,
        fst:document.getElementById('fat').value,
        ffsc: document.getElementById('fhsc').value,
        fssc: document.getElementById('fasc').value
    }

    let newFormData = {...formValues,  subDte: wholeDay, subTme: currentTime, matchId: rid};
    //Send data to db
    let url = fairForm.getAttribute('action');
    let formOptions = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify(newFormData)
    }
    fetch(url, formOptions)
    .then(response => response.text())
    .then((data) => {
        // JSON.parse(data);
        console.log(`${data}`)
    })
})