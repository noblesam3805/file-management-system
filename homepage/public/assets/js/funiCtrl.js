// set application baseUri here
//window.baseUri = document.getElementById('baseurl-holder').value;
window.baseUri = 'https://c.oxygyn.com.ng/public';
// General Functions
function getValue(div) {
    return document.getElementById(div).value;
}

function setValue(div, value) {
    document.getElementById(div).value = value;
}

function getInnerHtml(div) {
    return document.getElementById(div).innerHTML;
}

function setInnerHtml(div, value) {
    document.getElementById(div).innerHTML = value;
}

function getSelectValue(div) {
    var e = document.getElementById(div);
    return e.options[e.selectedIndex].text;
}

function setSelectValueByIndex(div, index) {
    document.querySelector('#' + div).selectedIndex = index;
}

function setSelectValue(div, value) {
    document.querySelector('#' + div).value = value;
}

function getElement(div) {
    return document.getElementById(div);
}

function getDiv(div) {
    return document.getElementById(div);
}

function getById(idName) {
    return document.getElementById(idName);
}

function disableBtn(btn) {
    getElement(btn).setAttribute('disabled', 'disabled');
}

function enableBtn(btn) {
    getElement(btn).removeAttribute('disabled');
}

function disableElement(div) {
    getElement(div).setAttribute('disabled', 'disabled');
}

function enableElement(div) {
    getElement(div).removeAttribute('disabled');
}

function enableClass(classname) {

    var classDiv = document.getElementsByClassName(classname);
    for (var i = 0; i < classDiv.length; i++) {
        classDiv[i].removeAttribute('disabled');
    }
}

function disableClass(classname) {

    var classDiv = document.getElementsByClassName(classname);
    for (var i = 0; i < classDiv.length; i++) {
        classDiv[i].setAttribute('disabled', 'disabled');
    }
}

function showDiv(div) {
    document.getElementById(div).style.display = 'block';
}

function hideDiv(div) {
    document.getElementById(div).style.display = 'none';
}

function hideClass(classname) {

    var classDiv = document.getElementsByClassName(classname);
    for (var i = 0; i < classDiv.length; i++) {
        classDiv[i].style.display = 'none';
    }
}

function showClass(classname, display = 'block') {

    var classDiv = document.getElementsByClassName(classname);
    for (var i = 0; i < classDiv.length; i++) {
        classDiv[i].style.display = display;
    }
}



function removeClassFromClass(classToRemove, classname) {
    var classDiv = document.getElementsByClassName(classname);
    for (var i = 0; i < classDiv.length; i++) {
        classDiv[i].classList.remove(classToRemove);
    }
}

function addClassToClass(classToAdd, classname) {
    var classDiv = document.getElementsByClassName(classname);
    for (var i = 0; i < classDiv.length; i++) {
        classDiv[i].classList.add(classToAdd);
    }
}

function addClass(div, classname) {
    getElement(div).classList.add(classname);
}

function removeClass(div, classname) {
    getElement(div).classList.remove(classname);
}


function allowNosOnly(value, div) {

    if (isNaN(value)) {
        document.getElementById(div).value = value.substring(0, value.length - 1);
        return false;
    }

}

function allowNosAndCommasOnly(value, div) {
    var lastChar = value.substring(value.length - 1, value.length);
    if (isNaN(lastChar)) {

        if (lastChar != ',') {
            document.getElementById(div).value = value.substring(0, value.length - 1);
            return false;
        }

    }
}

function allowNosAndDotsOnly(value, div) {
    var lastChar = value.substring(value.length - 1, value.length);
    if (isNaN(lastChar)) {

        if (lastChar != '.') {
            document.getElementById(div).value = value.substring(0, value.length - 1);
            return false;
        }

    }
}

function toggleDiv(div) {
    if (getElement(div).style.display == 'block') {
        hideDiv(div);
    } else if (getElement(div).style.display == 'none') {
        showDiv(div);
    }
}

function appendInnerHtml(div, value) {
    document.getElementById(div).innerHTML += value;
}


function addSelectOption(div, elementName, elementValue) {
    var select = getElement(div);
    select.options[select.options.length] = new Option(elementName, elementValue);
}

function removeSelectOption(div, value = '') {
    var selectDIv = getElement(div);

    if (value == '') {
        selectDIv.remove(selectDIv.selectedIndex);
    } else {
        for (var i = 0; i < selectDIv.length; i++) {
            if (value == selectDIv[i].value) {
                selectDIv.remove(i);
            }
        }
    }
}


function showAlert(msg, title = 'Error Alert') {
    swal({
        title: title,
        text: msg,
        timer: 6000
    }).then(
        function () {
        },
        // handling the promise rejection
        function (dismiss) {
            if (dismiss === 'timer') {
                //console.log('I was closed by the timer')
            }
        }
    )
}


function showActionAlert(params) {

    swal({
        title: params.title,
        text: params.text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4fa7f3',
        cancelButtonColor: '#d57171',
        confirmButtonText: 'Yes, Continue!',
    }).then(function () {

        params.callbackFunction(params.params);

    })

}

function getLoader(msg = '') {
    return '<p><img src="' + window.baseUri + '/assets/images/loading.gif" style="width:12px; height:12px" /> ' + msg + '</p>';
}

function getLoader2(msg = '', marginTop = '50px') {
    return '<p style="text-align:center; margin-top:' + marginTop + '"><img src="' + window.baseUri + '/assets/images/loading.gif" style="width:16px; height:16px" /><br /> ' + msg + '</p>';
}


function showFileName(input, div) {

    var input = getElement(input);

    var filename = '';
    for (var i = 0; i <= input.files.length - 1; i++) {
        filename = input.files[i].name;

    }

    // use fileName however fits your app best, i.e. add it into a div
    getElement(div).textContent = filename;
}

//enterKey press e.keyCode == 13

function setClassInnerHtml(classname, content) {

    var classDiv = document.getElementsByClassName(classname);
    for (var i = 0; i < classDiv.length; i++) {
        classDiv[i].innerHTML = content;
    }
}

function getMultipleSelected(fieldID) {

    // fieldID is id set on select field

    // get the select element
    var elements = document.getElementById(fieldID).childNodes;

    // if we want to use key=>value of selected element we will set this object
    var selectedKeyValue = {};

    // if we want to use only array of selected values we will set this array
    var arrayOfSelecedIDs = [];

    // loop over option values
    for (i = 0; i < elements.length; i++) {

        // if option is select then push it to object or array
        if (elements[i].selected) {
            //push it to object as selected key->value 
            selectedKeyValue[elements[i].value] = elements[i].textContent;
            //push to array of selected values
            arrayOfSelecedIDs.push(elements[i].value)

        }

    }

    // output or do seomething else with these values :)
    //console.log(selectedKeyValue);

    return arrayOfSelecedIDs;

}


function copyText(input) {
    /* Get the text field */
    var copyText = document.getElementById(input);

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    showAlert('Text Copied', 'Success');
} 