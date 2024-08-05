console.log('hey1');

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

function ajaxSuccess(){
    $.ajax({
        url: '/customer',
        type: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            name: $('#name').val(),
            email: $('#email').val(),
            status: $('#statusHidden').val()
        },
        success: function(response) {
            console.log(response);

            if (response.success) {
                $('#tulisDisini').text('Data berhasil dibuat!').show();
                $('#spinnerLoading').css("display", "none");
                // Store the success message in local storage
                localStorage.setItem('success_message', response.message);

                // Redirect to the /customer page
                window.location.href = '/customer';
            }
        },
        error: function(response) {
            $('#spinnerLoading').css("display", "none");
            $('#tulisDisini').css("color", "red").text(response.responseJSON.message).show();
            console.log(response.responseJSON.message);
            console.log('kok bisa');
        }
    });
}

$('#submitBtn').on('click', function(e){
    console.log('masuk sini');
    $('#spinnerLoading').css("display", "block");
    $('#tulisDisini').css("color", "black")
    $('#tulisDisini').text('Melakukan validasi data...').show();
    setTimeout(function() {
        let validasi = validasiForm();
        if(validasi == true){
            $('#tulisDisini').text('Mengirim data...').show();
            ajaxSuccess();
            // document.getElementById('submitForm').submit();
        }else{
            $('#spinnerLoading').css("display", "none");
            $('#tulisDisini').css("display", "none");
            alertMain(validasi);
        }
    }, 900);
});
