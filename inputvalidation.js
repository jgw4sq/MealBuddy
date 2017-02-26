
var submit = document.getElementById("submitButton");
function checkFields(){

var name = document.getElementById("contact-name");
var email = document.getElementById("contact-email");
var address =document.getElementById("contact-address");
var city =document.getElementById("contact-city");
var state =document.getElementById("contact-state");
var zip =document.getElementById("contact-zip");
var errorMessage ="";

if(name.value ===""||name.value.length === 0){
	errorMessage+= "You must enter your name.\n";

}
if(email.value ===""||email.value.length === 0){
	errorMessage+= "You must enter your email.\n";

}
if(address.value.length === 0){

	errorMessage+= "You must enter your address.\n";

}
if(city.value ===""||city.value.length === 0){
	errorMessage+= "You must enter your city.\n";
}
if(state.value ===""||state.value.length === 0){
	errorMessage+= "You must enter your state.\n";
}
if(zip.value ===""||zip.value.length === 0){
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