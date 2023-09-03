"use strict"

//View Match Details modal
let viewMatch = (id) => {
    let url = `./api/master.php?a=viewmatchdetails&id=${id}`;
    let myDisplay = document.getElementById('in_details')
    fetch(url)
    .then((response) => response.text())
    .then((data) => {
        myDisplay.innerHTML = data;
    })
}
//view fair matches
let viewFairDets = (id) => {
    let url = `./api/master.php?a=viewfairmatchdetails&id=${id}`;
    let myDisplay = document.getElementById('in_details')
    fetch(url)
    .then((response) => response.text())
    .then((data) => {
        myDisplay.innerHTML = data;
    })
}
//View Won Matches Details modal
let viewWonToday = (user) => {
  let url = `./api/master.php?a=viewwontodaydets&user=${user}`;
  let myDisplay = document.getElementById('wonMatchesDetails')
  fetch(url)
  .then((response) => response.text())
  .then((data) => {
      myDisplay.innerHTML = data;
  })
}
//View Lost Matches Details modal
let viewLostToday = (user) => {
  let url = `./api/master.php?a=viewlosttodaydets&user=${user}`;
  let myDisplay = document.getElementById('lostMatchesDetails')
  fetch(url)
  .then((response) => response.text())
  .then((data) => {
      myDisplay.innerHTML = data;
  })
}

let payUp = (id) => {
      Swal.fire({
        title: 'Are you sure?',
        text: `Pay Debt With Id ${id}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.isConfirmed) {
        let url = `./api/master.php?a=payIndebt&debId=${id}`;
        fetch(url)
        .then(response => response.text())
        .then((data) => {
            if(data.indexOf('Paid') > 0){
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
                'Cancelled :)',
                'error'
              )
        }
      })
}

let doneDeal = (id, dte) => {
  Swal.fire(
    'Already Paid',
    `Debt ${id} Was Paid On: ${dte}`,
    'success'
  )
}



export { viewMatch, viewFairDets, payUp, doneDeal, viewLostToday, viewWonToday };