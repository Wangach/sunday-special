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

export { viewMatch };