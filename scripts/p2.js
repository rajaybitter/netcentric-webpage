function validate(){
	var fname = document.getElementById('firstname');
	var lname = document.getElementById('lastname');
	var constituency = document.getElementById('constituency');
	var email = document.getElementById('email');
	var years = document.getElementById('years');
	var password = document.getElementById('password');
	var confirmation = document.getElementById('confirm');
	
	// test data being entered for validity
	if(!fname.value || !(/^([^0-9]*)$/.test(fname.value))){
		alert('First name incorrect');
		fname.style.borderColor='red';
		return false; 
	}
	if(!lname.value || !(/^([^0-9]*)$/.test(lname.value))){
		alert('Last name incorrect');
		lname.style.borderColor='red';
		return false; 
	}
	if(!constituency.value || !(/^([^0-9]*)$/.test(fname.value))){
		alert('Constituency field empty');
		constituency.style.borderColor='red';
		return false; 
	}

	if(!email.value){/* || !(/\A[\w+\-.]+@[a-z\d\-.]+\.[a-z]+\z/i.test(email.value))*/
		alert('Email field incorrect');
		email.style.borderColor='red';
		return false; 
	}
	if(!years.value || years.value < 0 || years.value >50){
		alert('Years field incorrect');
		years.style.borderColor='red';
		return false; 
	}
	if(!password.value){
		alert('Password field empty');
		password.style.borderColor='red';		
		return false; 
	}
	if(!confirmation.value){
		alert('Password not confirmed');
		confirmation.style.borderColor='red';
		return false; 
	}
	if(password.value != confirmation.value){
		alert("Passwords don't match");
		password.style.borderColor='red';
		confirmation.style.borderColor='red';
		return false; 
	}
}