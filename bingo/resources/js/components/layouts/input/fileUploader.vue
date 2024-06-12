<template>
    <div>
        <div style="width:100%;text-align: center;" :id="getContainerId()">
            <div class="card card-stats card-round"
                style="background-color: #f9f9f9;border:1px #000 solid;">
                <div class="card-body" style="margin: auto;padding: auto;text-align:center;">
                    <div style="margin: auto;padding: auto;text-align:center;">
                        <img id="img_fileUploader" style="width: 100px;height: 100px;text-align:center;display:none" src="">
                        <p id="fileCsvLoad">Aucun fichier sélectionné</p>
                    </div>
                </div>
                <div style="margin-left: 30px;margin-right: 30px;">
                    <label :for="getInputId()" class="btn btn-primary btn-border btn-round btn-lg btn-block">
                        Importer un Fichier
                    </label>
                </div>
                <input @change="changeImage" style="display:none;"
                    class="form-control" type="file"  :accept="accept"
                    :id="getInputId()">
            </div>
        </div>
    </div>

</template>


<script>
import helper from '../../../helper';
export default {
    data() {
        return {
            valueToSend : "",
        }
    },
    props: [
      "id", "accept"
    ],

    methods: {
        changeImage(e){
            this.valueToSend = e.target.files[0];
            var nameFile = helper.getNameImage(this.valueToSend);
            $("#"+ this.getContainerId() +" #fileCsvLoad").html(nameFile);
            if(nameFile != null ) {
                const extension = nameFile.split(".")[1];
                $("#"+ this.getContainerId() +" #img_fileUploader").attr("src", "assets/img/"+ extension + ".png");
                $("#"+ this.getContainerId() +" #img_fileUploader").css("display", "block");
            }
            this.$emit('file-change', this.valueToSend);
        },

        getContainerId(){
            return this.id + "UploaderContainer";
        },

        getInputId(){
            return this.id + "UploaderInput";
        },
    },

    created() {
        
    },
    mounted() {
    }
}
</script>
