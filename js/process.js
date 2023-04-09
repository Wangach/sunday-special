import { viewMatch, viewFairDets } from './reus.js';
window.viewMatch = viewMatch;
window.viewFairDets = viewFairDets;
//Global Variables
const looserForm = document.getElementById('looser-form');
const fairForm = document.getElementById('fair-form');
const payForm = document.getElementById('pay-form');
const transactForm = document.getElementById('payments-form');
const createUserForm = document.getElementById('user-form');
const indebtForm = document.getElementById('indebt');
const logoutButton = document.getElementById('logout-btn');
const themeChangeBtn = document.getElementById("theme-btn");
let defTheme;

//Custom Loaders
//On Load
window.addEventListener('load', () => {
    const loader = document.querySelector('.loader');
    const circle = document.querySelector('.circle');


    // function changeOpacity(elem) {
    // elem.style.opacity = '0';
      let changeOpacity = (elem) => {
        elem.style.opacity = "0";
        elem.style.display = "none";
    }
    //Update the fairplay counter
    let countFair = () => {
        let fairCountDisp = document.getElementById('tu');
        let url = './api/master.php?a=cntFair';
        fetch(url)
        .then(res => res.text())
        .then((data) => {
            fairCountDisp.innerHTML = data;
        })
    }

    setInterval(changeOpacity(loader), 5000);
    setInterval(changeOpacity(circle), 3000);
    setInterval(countFair, 60000);

    //check for theme
      (() => {
        let inheritedTheme = localStorage.getItem('theme');
        if(inheritedTheme == 'dark'){
          themeSwitcher();
        }
      })();
})


//Dark Theme button
const themeBtn = document.getElementById("theme-btn");
const themeSwitcher = () => {
    //get the items being changed
  const navigate = document.querySelector('nav');
  const changee = document.getElementById('content');
  const cards = document.querySelectorAll('#main-cards');
  const miniCards = document.querySelectorAll('#mini-cards');
  const cardHeaders = document.querySelectorAll('.card-header');
  const sidebar = document.getElementById('accordionSidebar');
  const myFooter = document.querySelector('footer');
  const dmenu = document.getElementById('dropdown-menu');
  const allModals = document.querySelectorAll('.modal-content');
  themeBtn.classList.toggle("fa-sun");

  if (themeBtn.classList.contains("fa-sun")) {
    navigate.classList.add("change-nav-theme");
    navigate.classList.remove("bg-white");
    sidebar.classList.add('bg-gradient-dark')
    sidebar.classList.remove('bg-gradient-primary')
    myFooter.classList.remove('bg-white');
    myFooter.classList.add('change-theme');
    changee.classList.add("change-theme");
    dmenu.classList.add("minicards-theme");
    allModals.forEach(modal => {
        modal.classList.add('modal-theme')
    })
 
    cards.forEach((card) => {
        card.classList.add('change-card-theme')
    })
    miniCards.forEach((minicard) => {
        minicard.classList.add('minicards-theme')
    })
    cardHeaders.forEach((cardHeader) => {
        cardHeader.classList.add('change-theme')
    })

    return localStorage.setItem('theme', 'dark');
  } else {
    navigate.classList.remove("change-nav-theme");
    changee.classList.remove("change-theme");
    navigate.classList.add("bg-white");
    sidebar.classList.remove('bg-gradient-dark')
    sidebar.classList.add('bg-gradient-primary')
    myFooter.classList.add('bg-white');
    myFooter.classList.remove('change-theme');
    dmenu.classList.remove('minicards-theme')

   allModals.forEach(modal => {
        modal.classList.remove('modal-theme')
    })
    cards.forEach((card) => {
        card.classList.remove('change-card-theme')
    })
    miniCards.forEach((minicard) => {
        minicard.classList.remove('minicards-theme')
    })
    cardHeaders.forEach((cardHeader) => {
        cardHeader.classList.remove('change-theme')
    })

    return localStorage.setItem('theme', 'light');
  }
}

themeBtn.addEventListener('click', themeSwitcher);
//logout function
logoutButton.addEventListener('click', (e) => {
    e.preventDefault();
    let url = `${logoutButton.getAttribute('href')}?a=logoutAdmin`;
    fetch(url)
    .then(response => response.text())
    .then((data) => {
        if (data == 'Logged Out!') {
            localStorage.clear();
            Swal.fire(data, '', 'success');
            setTimeout( ()=> {
                location.reload();
            }, 3000)
        }else{
            alert('There Has Been An error!');
        }
        
    })
})

let wholeDay = '';
let currentTime = '';


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
//generate A unique Id For Matches played
let genMatchId = () => {
    let myLetters = ["F", "A", "V", "O", "R", "E", "D", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
    let rNum = '';
    let rid = '';
    for(let i = 0; i < 5; i++){
        rNum = Math.floor(Math.random() * (myLetters.length - 1));
        rid += myLetters[rNum];
        
    }
    return rid;
}
//generate A unique Id for transactions
let trMatchId = () => {
    let myLetters = ["O", "P", "Q", "T", "U", "Z", "I", "2", "4", "6", "8", "9", "0"];
    let rNum = '';
    let rid = '';
    for(let i = 0; i < 5; i++){
        rNum = Math.floor(Math.random() * (myLetters.length - 1));
        rid += myLetters[rNum];
        
    }
    console.log(rid);
    return rid;
}
//generate A Registration number for users
let genId = () => {
    let myLetters = ["1", "3", "5", "7", "2", "4", "6", "8", "9", "0"];
    let rNum = '';
    let rid = '';
    for(let i = 0; i < 6; i++){
        rNum = Math.floor(Math.random() * (myLetters.length - 1));
        rid += myLetters[rNum];
        
    }
    console.log(rid);
    return rid;
}
//Recent Looser Games
let recentLooser = () => {
    let display = document.getElementById('latest-lost');
    let url = './api/master.php?a=recentLost';
    fetch(url)
    .then(res => res.text())
    .then((data) => {
        display.innerHTML = data;
    })
}
//Recent Fair Games
let recentFair = () => {
    let display = document.getElementById('latest-fair');
    let payAllBtn = document.getElementById('pay-all');
    payAllBtn.addEventListener('click', () => {
        Swal.fire({
            title: 'Pay All Fair Games?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
                let payAllUrl = './api/master.php?a=payAll';
                fetch(payAllUrl)
                .then(res => res.text())
                .then((data) => {
                    if(data.includes('Matches Paid')){
                        Swal.fire(
                            'Paid!',
                            data,
                            'success'
                          )
                    }else if(data.includes('An Error')){
                        Swal.fire(
                            'Error!',
                            data,
                            'error'
                          )
                    }else{
                        Swal.fire(
                            'Uknown!',
                            'There Has Been An Uknown Error.',
                            'error'
                          )
                    }
                })
            }else{
                Swal.fire(
                    'Cancelled',
                    'Process Terminated',
                    'error'
                  )
            }
          })
    })
    let url = './api/master.php?a=recentFair';
    fetch(url)
    .then(res => res.text())
    .then((data) => {
        display.innerHTML = data;
        // console.log(data)
    })
}
//count Looser Games 
let countLooser = () => {
    let display = document.getElementById('t-looser');
    let url = './api/master.php?a=totLooser';
    fetch(url)
    .then(res => res.text())
    .then((data) => {
        animateValue(display, 0, data, 5000);
    })
    let animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
          if (!startTimestamp) startTimestamp = timestamp;
          const progress = Math.min((timestamp - startTimestamp) / duration, 1);
          obj.innerHTML = Math.floor(progress * (end - start) + start);
          if (progress < 1) {
            window.requestAnimationFrame(step);
          }
        };
        window.requestAnimationFrame(step);
      }
}

//Looser Form 
looserForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let clearBtn = document.getElementById('clear-looser');
    clearBtn.removeAttribute('disabled');
    
    todaysDte();
    convertMsToTime(now);
    let rid = genMatchId();
    
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
            payableAmt = 20;
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
    let url = `${looserForm.getAttribute('action')}?a=recordLooser`;
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
        if (data == 'Data Recorded'){
            Swal.fire(data, '', 'success');
        }else{
            Swal.fire(data, '', 'error');
        }
        
    })
       //upon click
       clearBtn.addEventListener('click', () => {
        //Clear Form Fields
        looserForm.reset();
        //set disabled attr to true
        setInterval(() => {
            clearBtn.setAttribute("disabled", "true");
        }, 3000)
    })
})

//Fair Form 
fairForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    
    todaysDte();
    convertMsToTime(now);
   let rid = genMatchId();
   let clearFair = document.getElementById('clear-fair');
   clearFair.removeAttribute("disabled");
    
    let formValues = {
        fft: document.getElementById('fht').value,
        fst:document.getElementById('fat').value,
        ffsc: document.getElementById('fhsc').value,
        fssc: document.getElementById('fasc').value
    }

    let newFormData = {...formValues,  subDte: wholeDay, subTme: currentTime, matchId: rid};
    //Send data to db
    let url = `${fairForm.getAttribute('action')}?a=recordFair`;
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
        if (data == 'Data Recorded'){
            Swal.fire(data, '', 'success');
        }else{
            Swal.fire(data, '', 'error');
        }
    })
    clearFair.addEventListener('click', () => {
        fairForm.reset();
        setInterval(() => {
            clearFair.setAttribute("disabled", "true");
        }, 3000)
    })
})
//Make Payments
transactForm.addEventListener('submit', (e)=>{
    e.preventDefault();
    let rid = trMatchId();
    let clearTransBtn = document.getElementById('clear-transact');
    clearTransBtn.removeAttribute('disabled');

    let formValues = {
        transType: document.getElementById('txntyp').value,
        transName:document.getElementById('trname').value,
        paymentMeth: document.getElementById('txnmode').value,
        transAmt: document.getElementById('tramt').value,
        transDesc: document.getElementById('trds').value
    }

    Swal.fire({
        title: 'Are you sure?',
        text: `Pay ${formValues.transAmt} by ${formValues.transName}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Pay'
      }).then((result) => {
        if (result.isConfirmed) {
        let newFormData = {...formValues, transId: rid};
        //Send data to db
        let url = `${transactForm.getAttribute('action')}?a=pay`;
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
            if(data.indexOf('Successful') > 0){
                Swal.fire(
                    'Paid!',
                    data,
                    'success'
                  )
            }else{
                Swal.fire(
                    'Failed!',
                    data,
                    'error'
                  )
            }
        })
        }else{
            Swal.fire(
                'Cancelled',
                'Transaction Has Been Cancelled :)',
                'error'
              )
              transactForm.reset();
              clearTransBtn.setAttribute("disabled", "true");
        }
        clearTransBtn.addEventListener('click', () => {
            transactForm.reset();

            setInterval(() => {
                clearTransBtn.setAttribute("disabled", "true")
            }, 3000)
        })
      })
})
//Register users
createUserForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    let regDte = todaysDte();
    let userId = genId();
    let formValues = {
        custName: document.getElementById('jina').value,
        systemName:document.getElementById('alias').value,
        phoneNum: document.getElementById('ph').value,
        favTeam: document.getElementById('ftm').value,
        gameLimit: document.getElementById('un').value
    }

    let newFormData = {...formValues, dateRegistered: regDte, regnum: userId};
    //Send data to db
    let url = `${createUserForm.getAttribute('action')}?a=regUser`;
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

//Indebt
indebtForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let clearIndebt = document.getElementById('clear-indebt');
    clearIndebt.removeAttribute('disabled');
    let debtId = trMatchId();
    let dOfIssue = todaysDte();
    let formValues = {
        debtee: document.getElementById('dn').value,
        debtReason:document.getElementById('drxn').value,
        debtAmount: document.getElementById('damt').value
    }

    Swal.fire({
        title: "Indebt",
        text: `Indebt ${formValues.debtee}, Amount ${formValues.debtAmount}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
            let newFormData = {...formValues, whenIndebt: dOfIssue, debtNum: debtId};
            //Send data to db
            let url = `${indebtForm.getAttribute('action')}?a=indebt`;
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
                if (data.indexOf('Recorded') > 0) {
                    Swal.fire(
                        'Confirmed',
                        data,
                        'success'
                      )
                }else{
                    Swal.fire(
                        'Error Occured',
                        data,
                        'error'
                      )
                }
            })
        }else{
            Swal.fire(
                'Cancelled',
                'Action Has Been Cancelled :)',
                'error'
              )
              indebtForm.reset();
              clearIndebt.setAttribute("disabled", "true");
        }
        clearIndebt.addEventListener('click', () => {
            indebtForm.reset();

            setInterval(() => {
                clearIndebt.setAttribute("disabled", "true")
            }, 3000)
        })
      })

})
//Load Recent Looser Games
window.addEventListener('load', () => {
    recentLooser();
    recentFair();
    countLooser();
})