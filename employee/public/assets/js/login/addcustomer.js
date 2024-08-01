console.log('hey');

function validateEmail(email) {
    // Regular expression for basic email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

function validasiForm(){
    if(document.getElementById('name').value === "") return "Nama Tidak Boleh Kosong!";
	else if(document.getElementById('email').value === "") return "Email Tidak Boleh Kosong!";
    else if(!validateEmail(document.getElementById('email').value)) return "Email Tidak Valid!";
    else return true;
}

function alertMain(alertText){
	window.scrollTo(0, 0);
	$("#alert-main").remove();
	$(".alertNih").prepend('<div class="alert alert-warning" id="alert-main" role="alert">'+alertText+'</div>');
}

$('#submitBtn').on('click', function(e){
    let validasi = validasiForm();
    if(validasi == true){
        document.getElementById('submitForm').submit();
    }else{
        alertMain(validasi);
    }
});
