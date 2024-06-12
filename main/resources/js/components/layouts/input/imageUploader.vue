<template>
    <div>
        <div style="width:100%;text-align: center;" :id="getContainerId()">
            <div class="card card-stats card-round"
                style="background-color: #f9f9f9;border:1px #000 solid;">
                <div class="card-body" style="width: auto;height: auto;">
                    <div>
                        <img class="img_imageUploader" style="width: 100px;height: 100px;" :src="valueImageInUploader">
                    </div>
                </div>
                <div style="margin-left: 30px;margin-right: 30px;">
                    <label :for="getInputId()" class="btn btn-primary btn-border btn-round btn-lg btn-block">
                        Changer l'image
                    </label>
                </div>
                <input @change="changeImage" style="display:none;"
                    class="form-control" type="file"
                    :id="getInputId()" name="image_uploader"
                    accept="image/png, image/jpeg, image/jpg">
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
            valueImageInUploader : "",
        }
    },
    props: [
       "defaultValue", "id"
    ],

    watch : {
        defaultValue : function(value){
            this.refresh();
        }
    },

    methods: {
        changeImage(e){
            this.valueToSend = e.target.files[0];
            this.refreshImg(e, this.getContainerId());
            this.$emit('image-change', this.valueToSend);
        },

        getContainerId(){
            return this.id + "UploaderContainer";
        },

        getInputId(){
            return this.id + "UploaderInput";
        },

        refreshImg(input, idContainer) {
            if (input.target && input.target.files && input.target.files[0]) {
                var reader = new FileReader();

                reader.onloadend = function() {
                    $('#'+idContainer+' .img_imageUploader').attr('src', reader.result);
                }

                reader.readAsDataURL(input.target.files[0]);
            }
        },

        refresh(){
            this.valueImageInUploader = helper.showImage(this.defaultValue);
        },
    },

    created() {
        
    },
    mounted() {
        this.refresh();
    }
}
</script>
