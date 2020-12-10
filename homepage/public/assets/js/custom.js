var xhr = new XMLHttpRequest();
var searchXhr = new XMLHttpRequest();

function moveToNexStep(validate){
    var currentStep = parseInt(getValue('currentStep'));
   
    switch(currentStep){
        case 1:
            var avatarUploaded = getValue('avatarUploaded');
            if(validate == 'true' && avatarUploaded == 0){
                alert('Please upload Passport');
                return false;
            }

            var nextStep = currentStep + 1;
            setValue('currentStep', nextStep);
            hideClass('step');
            showDiv('step-' + nextStep);

        break;

        case 2:

            var surname = getValue('surname');
            if(surname == ''){
                alert('Please enter Surname');
                return false;
            }

            var otherNames = getValue('otherNames');
            if (otherNames == '') {
                alert('Please enter Other Names');
                return false;
            }

            var gender = getValue('gender');
            

            var phoneNo = getValue('phoneNo');
            if (phoneNo == '') {
                alert('Please enter Phone No');
                return false;
            }

            var email = getValue('email');
            
            var address = getValue('address');
            if (address == '') {
                alert('Please enter Residential Address');
                return false;
            }

            var dob = getValue('dob');
            if (dob == '') {
                alert('Please enter Date of Birth');
                return false;
            }

            var state = getValue('state');
            if (state == '') {
                alert('Please enter State of Origin');
                return false;
            }

            var idNo = getValue('idNo');

            var params = {
                'surname' : surname,
                'otherNames' : otherNames,
                'gender' : gender,
                'phoneNo' : phoneNo,
                'email' : email,
                'address' : address,
                'dob' : dob,
                'stateId' : state,
                'idNo' : idNo,
                'currentStep' : currentStep
            }

            var uri = window.baseUri + '/member/uploadInfo';
            var form = new FormData();
            form.append('data', JSON.stringify(params));

            xhr.open('POST', uri, true);
            xhr.onload = function (e) {
                var nextStep = currentStep + 1;
                setValue('currentStep', nextStep);
                hideClass('step');
                showDiv('step-' + nextStep);
            };
            xhr.send(form);

        break;

        case 3:

            var username = getValue('username');
            if(username == ''){
                alert('Please enter Username');
                return false;
            }

            var password = getValue('pwd');
            if (password == '') {
                alert('Please enter Password');
                return false;
            }

            if(password.length < 8){
                alert('Password must be atleast 8 characters');
                return false;
            }

            var password2 = getValue('pwd2');
            if (password2 == '') {
                alert('Please confirm your Password');
                return false;
            }

            if(password != password2){
                alert('Password & Confirm Password values must be the same');
                return false;
            }

            var params = {
                'username' : username,
                'password' : password,
                'currentStep' : currentStep
            }

            var uri = window.baseUri + '/member/uploadInfo';
            var form = new FormData();
            form.append('data', JSON.stringify(params));

            xhr.open('POST', uri, true);
            xhr.onload = function (e) {
                window.location.href = window.baseUri + '/member/dashboard';
            };
            xhr.send(form);



        break;
    }
}

function setRepaymentAmount(plan){
    //var plan = plan;
    var planArray = plan.split('-');
    var interestRate = planArray[1];
    var duration = planArray[2];

    var amount = getValue('amount');
    if(amount == ''){
        alert('Please enter Loan Amount');
        return false;
    } 

    setValue('interestRate', interestRate);

    calculateRepaymentAmount(amount, interestRate, duration);
}


function calculateRepaymentAmount(amount, interestRate, duration){
    var interest = amount * (interestRate/100) * ( duration/12);
    var totalAmount = parseInt(interest) + parseFloat(amount);

    setValue('interest', interest);
    setValue('tpa', totalAmount);
}
