import { viewMatch, payUp, doneDeal } from './reus.js';
window.viewMatch = viewMatch;
window.payUp = payUp;
window.doneDeal =doneDeal;
//On Load
window.addEventListener("load", () => {
  const loader = document.querySelector(".loader");
  const circle = document.querySelector(".circle");

  // function changeOpacity(elem) {
  //     elem.style.opacity = '0';
  let changeOpacity = (elem) => {
    elem.style.opacity = "0";
    elem.style.display = "none";
  };

  setInterval(changeOpacity(loader), 5000);
  setInterval(changeOpacity(circle), 3000);

  //check for theme
  (() => {
    let inheritedTheme = localStorage.getItem('theme');
    if(inheritedTheme == 'dark'){
      themeSwitcher();
    }
  })();
});
//Dark Theme button
const themeBtn = document.getElementById("theme-btn");
const themeSwitcher = () => {
    //get the items being changed
  const navigate = document.querySelector('nav');
  const changee = document.getElementById('content');
  const cards = document.querySelectorAll('#main-cards');
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
    cardHeaders.forEach((cardHeader) => {
        cardHeader.classList.remove('change-theme')
    })

    return localStorage.setItem('theme', 'light');
  }
}

themeBtn.addEventListener('click', themeSwitcher);
const logoutButton = document.getElementById('logout-btn');
//logout function
logoutButton.addEventListener('click', (e) => {
    e.preventDefault();
    let url = `${logoutButton.getAttribute('href')}?a=logoutAdmin`;
    fetch(url)
    .then(response => response.text())
    .then((data) => {
        if (data == 'Logged Out!') {
            Swal.fire(data, '', 'success');
            setTimeout( ()=> {
                location.reload();
            }, 3000)
        }else{
            alert('There Has Been An error!');
        }
        
    })
})
const searchUserForm = document.getElementById("searchUser");

searchUserForm.addEventListener("submit", (event) => {
  event.preventDefault();

  let formValue = {
    username: document.getElementById("un").value,
  };

  //get the match summary
  let matchesSummary = () => {
    //Send data to db
    let url = `${searchUserForm.getAttribute("action")}?a=seaUs&dets=msummary`;
    let summaryHolder = document.getElementById("match-calculate");
    let formOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formValue),
    };
    fetch(url, formOptions)
      .then((response) => response.text())
      .then((data) => {
        // JSON.parse(data);
        summaryHolder.innerHTML = data;
      });
  };
  //get the debt summary
  let debtSummary = () => {
    //Send data to db
    let url = `${searchUserForm.getAttribute("action")}?a=seaUs&dets=dtsummary`;
    let summaryHolder = document.getElementById("debt-calculate");
    let formOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formValue),
    };
    fetch(url, formOptions)
      .then((response) => response.text())
      .then((data) => {
        // JSON.parse(data);
        summaryHolder.innerHTML = data;
      });
  };
   //get todays match statistics for individual player
   let todaysStats = () => {
    //Send data to db
    let url = `${searchUserForm.getAttribute("action")}?a=seaUs&dets=cntodaystats`;
    let todayStatsHolder = document.getElementById("daily-stats-calculate");
    let formOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formValue),
    };
    fetch(url, formOptions)
      .then((response) => response.text())
      .then((data) => {
        // JSON.parse(data);
        todayStatsHolder.innerHTML = data;
      });
  };
  //latest matches
  let individualMatches = () => {
    //Send data to db
    let url = `${searchUserForm.getAttribute("action")}?a=seaUs&dets=recentms`;
    let display = document.getElementById("latest-lost-individual");
    let formOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formValue),
    };
    fetch(url, formOptions)
      .then((res) => res.text())
      .then((data) => {
        display.innerHTML = data;
        // console.log(data)
      });
  };
  //recent individual transactions
  let individualTransactions = () => {
    let url = `${searchUserForm.getAttribute("action")}?a=seaUs&dets=indTrans`;
    let display = document.getElementById("recent-transactions-individual");
    let formOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formValue),
    };
    fetch(url, formOptions)
      .then((res) => res.text())
      .then((data) => {
        display.innerHTML = data;
        // console.log(data)
      });
  };
    //
  let recentIndebts = () => {
    //Send data to db
    let url = `${searchUserForm.getAttribute("action")}?a=seaUs&dets=recentIndebts`;
    let display = document.getElementById("recent-indebt-individual");
    let formOptions = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formValue),
    };
    fetch(url, formOptions)
      .then((res) => res.text())
      .then((data) => {
        display.innerHTML = data;
      });
  };



  //get the match summary
  matchesSummary();
  //get the debt summary
  debtSummary();
  //get the latest matches
  individualMatches();
  //get the latest transactions
  individualTransactions();
  //Recent Indebts
  recentIndebts();
  //Todays Stats
  todaysStats();



});


