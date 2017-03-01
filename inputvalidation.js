
var submit = document.getElementById("submitButton");
function checkFields(){

var name = document.getElementById("contact-name");
var email = document.getElementById("contact-email");
var address =document.getElementById("contact-address");
var city =document.getElementById("contact-city");
var state =document.getElementById("contact-state");
var zip =document.getElementById("contact-zip");
var errorMessage ="";

//TEXT ONLY
var textRE = /^[a-zA-Z ]*$/
if(name.value ===""||name.value.length === 0||textRE.exec(name.value)==null){
	errorMessage+= "You must enter your name.\n";
}

//text or numbers before @, '.' after @
var emailRE = /\S+@\S+\.\S+/
if(email.value ===""||email.value.length === 0||emailRE.exec(email.value)==null){
	errorMessage+= "You must enter a valid email.\n";
}

var addRE = /\d+\s+\w+\s+\w+/
if(address.value.length === 0||address.value.length===0||addRE.exec(address.value)==null){
	errorMessage+= "You must enter your address.\n";
}

//TEXT ONLY
if(city.value ===""||city.value.length === 0||textRE.exec(city.value)==null){
	errorMessage+= "You must enter your city.\n";
}

//list of valid states
var stateRE = /^(?:(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY]))$/i;
if(state.value ===""||state.value.length === 0||stateRE.exec(state.value)==null){
	errorMessage+= "You must enter your state.\n";
}

//five digit number
var zipRE = /^[0-9]{5}$/
if(zip.value ===""||zip.value.length === 0||zipRE.exec(zip.value)==null){
	errorMessage+= "You must enter your zip.\n";
}

if(errorMessage.length===0){
alert("noerrorinform");
jQuery.ajax({
    type: "POST",
    url: 'signup.php',
    dataType: 'json',
    data: {name: name.value, email: email.value, address: address.value, city: city.value, state: state.value, zip: zip.value},

    success: function (obj, textstatus) {
                  if( !('error' in obj) ) {
                      yourVariable = obj.connection;
alert(yourVariable);
alert("success");
                  }
                  else {
                      alert(obj.error);
alert("error");
                  }
            }
});



}else{
alert(errorMessage);
}


}