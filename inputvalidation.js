alert("loaded");

var submit = document.getElementById("submitButton");
submit.onclick = checkFields;
function checkFields(){
alert("inFunction");
var name = document.getElementById("contact-name");
var email = document.getElementById("contact-email");
var address =document.getElementById("contact-address");
var city =document.getElementById("contact-city");
var state =document.getElementById("contact-state");
var zip =document.getElementById("contact-zip");
var errorMessage ="";
alert(name.value.length);
if(name.value ===""||name.value.length === 0){
alert("what up");
	errorMessage+= "You must enter your name.\n";

}
if(email.value ===""||email.value.length === 0){
	errorMessage+= "You must enter your email.\n";

}
alert("hi");
if(address.value.length === 0){

	errorMessage+= "You must enter your address.\n";
alert("nothing");
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
alert("hello");
if(errorMessage.length===0){

jQuery.ajax({
    type: "POST",
    url: 'signup.php',
    dataType: 'json',
    data: {name: name.value, email: email.value, address: address.value, city: city.value, state: state.value, zip: zip.value},

    success: function (obj, textstatus) {
                  if( !('error' in obj) ) {
                      yourVariable = obj.result;
                  }
                  else {
                      alert(obj.error);
                  }
            }
});



}else{
alert(errorMessage);
}


}