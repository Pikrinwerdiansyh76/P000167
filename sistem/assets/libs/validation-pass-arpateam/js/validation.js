// Validasi Password
    var pass    = document.getElementById("pass");
    var letter  = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number  = document.getElementById("number");
    var length  = document.getElementById("length");
    // When the user starts to type something inside the password field
    pass.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (pass.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if (pass.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }
        // Validate numbers
        var numbers = /[0-9]/g;
        if (pass.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }
        // Validate length
        if (pass.value.length >= 10) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
// Validasi Password

// Pencocokkan Password
    $('#pass, #passUlangi').on('keyup', function(){
        $('.confirm-message').removeClass('success-message').removeClass('error-message');

        let pass=$('#pass').val();
        let confirm_password=$('#passUlangi').val();

        if(pass===""){
            $('.confirm-message').text("Kolom Password tidak boleh kosong").addClass('error-message');
        }
        else if(confirm_password===""){
            $('.confirm-message').text("Kolom Ulangi Password tidak boleh kosong").addClass('error-message');
        }
        else if(confirm_password===pass)
        {
            $('.confirm-message').text('Password Sama!').addClass('success-message');
        }
        else{
            $('.confirm-message').text("Password Tidak Sama!").addClass('error-message');
        }
    });
// Pencocokkan Password