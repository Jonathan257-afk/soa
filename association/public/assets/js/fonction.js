


function notEmpty(data) {
    if (data != "")
        return true

    return false
}

function dateToString(dateToChange) {
    var time = "";
    var res = dateToChange.split(".")[0].split(" ");
    var date = res[0];

    if(typeof res[1] != "undefined" || res.length > 1)
        time = " à " + res[1];
    
    const dateSplit =  date.split("-");
    const mois = monthToString(dateSplit[1]);
    

    return dateSplit[2] + mois + dateSplit[0] + time;
}


function getMontInDate(dateToChange) {
    var res = dateToChange.split(".")[0].split(" ");
    var date = res[0];

    const dateSplit =  date.split("-");
    return monthToString(dateSplit[1]);
}

function monthToString(month){
    if(month == "01" || month == 1) return " Janvier ";
    else if(month == "02" || month == 2) return " Février ";
    else if(month == "03" || month == 3) return " Mars ";
    else if(month == "04" || month == 4) return " Avril ";
    else if(month == "05" || month == 5) return " Mei ";
    else if(month == "06" || month == 6) return " Juin ";
    else if(month == "07" || month == 7) return " Juillet ";
    else if(month == "08" || month == 8) return " Août ";
    else if(month == "09" || month == 9) return " Septembre ";
    else if(month == "10" || month == 10) return " Octobre ";
    else if(month == "11" || month == 11) return " Novembre ";
    else if(month == "12" || month == 12) return " Décembre ";
}

function spaceNombre(nombre, unite = "") {
    const stringNombre = nombre + "";
    const count = stringNombre.length;
    var resultat = "";
    var j = 1;

    for (var i = count - 1; i >= 0; i--) {
        if (j % 3 == 0) {
            resultat = " " + " " + stringNombre[i] + resultat;
            j = 0;
        }
        else {
            resultat = stringNombre[i] + resultat;
        }

        j++;
    }

    return resultat + " " + unite;
}

function isEmpty(data) {
    if (data != "")
        return false

    return true
}

function defilerTo(idOrClass) {
    $(idOrClass).css({"transition" : "all .5s"});
    if($(idOrClass) != null && typeof $(idOrClass)[0] != "undefined"){
        $(idOrClass)[0].scrollIntoView({
            block: "end",
            behavior: "smooth"
        });
    }
}


function validateInput(inputIdOrClass) {
    $(inputIdOrClass).css("border-color", "red");
    defilerTo(inputIdOrClass);
}


function AjaxPost(url, dataToSend, btnId, successF, errorrF) {
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    let btnAnimate = new Bouton(btnId);
    btnAnimate.attenteBtn();
    
    

    fetch(url, {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        method: 'post',
        body: JSON.stringify(dataToSend)
    }).then(response => {
        response.json().then(data => {
            btnAnimate.arreter();
                
            if(data != null) {
                if(typeof data.res != "undefined" && data.res && typeof data.message != "undefined")
                    succesNotify(data.message);
                if(typeof data.res != "undefined" && !data.res && typeof data.message != "undefined")
                    errorNotify(data.message);
                successF(data);
            }
        })
    }).catch(error => {
        btnAnimate.arreter();
          
        errorNotify(error);
        errorrF(error);
    });
}

function ifExiste(data) {
    if (typeof data != "undefined" && notEmpty(data))
        return true;
    return false;
}

function redirect(url) {
    document.location.replace(url);
}

function myConfirmBox(type, title, texte, textTrue, classTrue, classFalse, successF) {
    swal({
        title: title,
        text: texte,
        type: type,
        buttons: {
            confirm: {
                text: textTrue,
                className: classTrue
            },
            cancel: {
                text : "Annuler",
                visible: true,
                className: classFalse
            }
        }
    }).then( (Delete) => {
        if (Delete) {
            successF();
        } else {
            swal.close();
        }
    });
}

function succesNotify(notification) {
    $.notify({
        // options
        icon: 'fas fa-check',
        title: 'Notification',
        message: notification,
    }, {
        // settings
        element: 'body',
        position: null,
        type: "success",
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "bottom",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 2000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',

    });
}

function errorNotify(notification) {
    $.notify({
        // options
        icon: 'fas fa-times',
        title: 'Erreur',
        message: notification,
    }, {
        // settings
        element: 'body',
        position: null,
        type: "danger",
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "bottom",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 2000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',

    });
}

function getNameImage(image, nomImage = ""){
    var name = ""; 
    const img_split_name = image.name.split(".");

    if(img_split_name.length > 1){
        nomImage = (nomImage != "") ? nomImage : img_split_name[img_split_name.length - 2 ];
        name = nomImage + "." + img_split_name[img_split_name.length - 1 ]; 
    }

    return name;
}