

document.addEventListener("DOMContentLoaded", e => {

    e.preventDefault();

});

document.getElementById("btn_Save_Travel").addEventListener("click", e => {
    e.preventDefault();

    let formData = new FormData();
    formData.append("Insert", "Insert" );
    formData.append("Travel_Start", document.getElementById("Travel_Start").value );
    formData.append("Travel_Destination", document.getElementById("Travel_Destination").value );
    formData.append("Start_Date", document.getElementById("Start_Date").value );
    formData.append("Expiration_Date", document.getElementById("Expiration_Date").value );
    formData.append("Passenger_Name", document.getElementById("Passenger_Name").value );

    fetch("././assets/scripts/BackEnd/Travels.php", {
        method: 'POST',
        body: formData,
    })
    .then( response => response.json() )
    .then( json => {
        if ( json.Message === true ) {
            notyf("Information has been saved successfully");
        } else if ( json.Message === false ) {
            notyf("There was an error with the information");
        } else if ( json.Message === "Error" ) {
            notyf("The information could not be saved, we are sorry, please check if what you entered is correct.");
        } else if ( json.Message === "Empty Fields" ) {
            notyf("There are empty fields in the record");
        }
    })
    .catch( err => {
        notyf(err);
    })

});

document.getElementById("btn_Modify_Travel").addEventListener("click", e => {
    e.preventDefault();

    let formData = new FormData();
    formData.append("Update", "Update" );
    formData.append("Folio", document.getElementById("Folio").value );
    formData.append("Travel_Start", document.getElementById("Travel_Start").value );
    formData.append("Travel_Destination", document.getElementById("Travel_Destination").value );
    formData.append("Start_Date", document.getElementById("Start_Date").value );
    formData.append("Expiration_Date", document.getElementById("Expiration_Date").value );
    formData.append("Passenger_Name", document.getElementById("Passenger_Name").value );

    fetch("../assets/scripts/BackEnd/Travels.php", {
        method: 'POST',
        body: formData,
    })
    .then( response => response.json() )
    .then( json => {
        if ( json.Message === true ) {
            notyf("Information has been updated");
        } else if ( json.Message === false ) {
            notyf("There was an error with the information");
        } else if ( json.Message === "Error" ) {
            notyf("The information could not be saved, we are sorry, please check if what you entered is correct.");
        } else if ( json.Message === "Empty Fields" ) {
            notyf("There are empty fields in the record");
        }
    })
    .catch( err => {
        notyf(err);
    })

});
