
 console.log('%c' + 'registration.js LOADED', 'color: #0bf; font-size: 1rem; background-color:#fff'); 
/**
 * display of certificates
 */
 function handleViewCertificate() {


    let div = document.querySelector("#certificate");
    let radioTeacher = document.querySelector("#teacher");

    if (radioTeacher.checked == true) {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}






