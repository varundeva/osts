
$(document).ready(function(){
  $("#loading").hide();
});


$(document).ready(function() {
$("#register").click(function() {
var name = $("#inputname").val();
var email = $("#inputEmail").val();
var password = $("#inputPassword").val();
var cpassword = $("#inputCnfPassword").val();
var phone = $("#inputPhone").val();

if (name == '' || email == '' || phone == '' || password == '' || cpassword == '') {
alert("Please fill all fields...!!!!!!");
} else if ((password.length) < 8) {
alert("Password should atleast 8 character in length...!!!!!!");
} else if (!(password).match(cpassword)) {
alert("Your passwords don't match. Try again?");
alert(name);
} else {
	 $("#loading").show();
$.post("reg.php", {
name: name,
email: email,
password: password,
phone:phone
}, function(data) {
if (data == 'You have Successfully Registered.....') {
$("form")[0].reset();
}
alert(data);
});
}
});
});