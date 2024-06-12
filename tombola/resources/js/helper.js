import axios from "axios";
var serveur = $("#serveurRoute").val();
console.log(serveur);

const helper = {
    classes : {},
    matieres : {},

    combinateString : function(string1, string2){
        return string1 + string2;
    },

    dateToString : function(dateToChange){
        var time = "";
        var res = dateToChange.split(".")[0].split("T");
        var date = res[0];

        if(typeof res[1] != "undefined" || res.length > 1)
            time = " à " + res[1];
        
        const dateSplit =  date.split("-");
        const mois = helper.monthToString(dateSplit[1]);
        

        return dateSplit[2] + mois + dateSplit[0] + time;
    },

    default: {
        imageUploader: "image-uploader-default.jpg",
        
    },

    errorRequest : function(error){
        if(helper.notNull(error) && helper.notNull(error.message))
            errorNotify(error.message);
        else{
            if(typeof error == "string") 
                errorNotify(error);
            else if(Array.isArray(error) || typeof error === 'object'){
                $.each(error, function(kk, vv){
                    if(typeof vv == "string") 
                        errorNotify(vv);
                    else if(Array.isArray(vv) || typeof vv === 'object')
                        helper.errorRequest(vv);
                });
            }
        }
            
    },

    getAllMonthOnJson : function() {
        return [
            {id : 1, name : "Janvier"},
            { id : 2, name : "Février"},
            { id : 3, name : "Mars"},
            { id : 4, name : "Avril"},
            { id : 5, name : "Mei"},
            { id : 6, name : "Juin"},
            { id : 7, name : "Juillet"},
            { id : 8, name : "Août"},
            { id : 9, name : "Septembre"},
            { id : 10,  name : "Octobre"},
            { id : 11,  name : "Novembre"},
            { id : 12,  name : "Décembre"},
        ]
    },

    suucessRequest : function(data) {
        if(typeof data.res != "undefined" && data.res && typeof data.message != "undefined")
            succesNotify(data.message);
        if(typeof data.res != "undefined" && !data.res && typeof data.message != "undefined")
            errorNotify(data.message);
    },

    getBaseUrl: function () {
        return serveur;
    },

    getNameImage : function(image, nomImage = ""){
        var name = ""; 
        const img_split_name = image.name.split(".");

        if(img_split_name.length > 1){
            nomImage = (nomImage != "") ? nomImage : img_split_name[img_split_name.length - 2 ];
            name = nomImage + "." + img_split_name[img_split_name.length - 1 ]; 
        }
    
        return name;
    },

    getStyleLigneRelever : function(relever) {
        var style = "";
        if(relever.pointage == 0 && relever.reference == 0 && relever.piece == null)
            style= "color:#000;";
        else if( relever.piece == null && relever.pointage == 0)
            style= "color:#F78104;";
        else if(relever.reference == 0)
            style= "color:red;";
        else
            style= "color:green;";
        return style;
    },

    idInputImage : {
        add : "add-image",
        update : "update-image",
    },
    
    isConnected : function(response){
        if(typeof response.message != "undefined"){
            if(response.message == "Request failed with status code 401"){
                document.location.replace(serveur);
            }
        }
    },

    isEmptyJson : function(myJson) {
        if (JSON.stringify(myJson) === '{}')
            return true;
        return false;
    },

    monthToString : function(month){
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
    },

    spaceNombre : function(nombre, unite = "") {
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
    },

    notNull : function(data){
        if(typeof data != "undefined" && data != null)
            return true;
        return false;
    },

    path: {
        image: serveur + "/assets/img",
        implication : serveur + "/assets/img/implication",
        partenaire : serveur + "/assets/img/partenaire",
        equipe : serveur + "/assets/img/equipe",
        activite : serveur + "/assets/img/activite",
        objective : serveur + "/assets/img/objective",
    },

    showImage: function (path) {
        if (path == "" || path == null)
            path = helper.path.image + "/" + helper.default.imageUploader;
        else
            path = helper.path.image + "/" + path;
        return path;
    },

    UserConnected : null,
}

export default helper;