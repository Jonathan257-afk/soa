class Bouton {
    constructor(id) {
        this.id = id;
        if(this.id != ""){
            this.btn = document.getElementById(id);
            this.value = this.btn.innerHTML;
            this.arret = false;
            this.time = null;
            $("#"+this.id).attr("disabled", "disabled");
            $("#"+this.id).css("cursor", "not-allowed");
        }
        
        
    }

    attenteBtn(index = 0) {
        if(this.id != ""){
            var me = this;
            
            if (index == 0) {
                this.btn.innerHTML = "";
            }

            index++;

            this.btn.innerHTML += ".";
            

            if (index > 3) {
                index = 0;
            }

            if(!this.arret){
                this.time = setTimeout(function () {
                    me.attenteBtn(index);
                }, 200);
            }
        }
    }
    
    arreter(){
        if(this.id != ""){
            clearTimeout(this.time);
            this.btn.innerHTML = this.value;
            
            $("#"+this.id).removeAttr("disabled");
            $("#"+this.id).css("cursor", "pointer");
        }
    }
}