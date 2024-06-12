<template>
    <div>
        <Transition name="fade" appear>
            <div class="page-header" style="background-color: #fafafa;">
                <h4 class="page-title text-primary"><strong>CONFIGURATION DE {{house.name}}</strong></h4>
            </div>
        </Transition>

        <div class="row">
            <Transition name="fade" appear>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Information Géneral</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="emailAdd">Déscription court</label>
                                <textarea v-model="configuration.shortDescription"  @change="refreshAbout" style="border: 1px solid #888;"  class="form-control description"
                                            rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="emailAdd">Prix</label>
                                <input  v-model="configuration.price"  @change="refreshAbout"  type="text" class="form-control input-pill" placeholder=" 200 EUR - 360 EUR / Nuit" name="price">
                            </div>
                            <div class="form-group">
                                <label for="emailAdd">À Noter sur le Prix</label>
                                <textarea  v-model="configuration.nbPrice"  @change="refreshAbout" style="border: 1px solid #888;"  placeholder="Ce tarif ne comprend pas le ménage de fin de séjour de 250€, ainsi que la taxe de séjour (variable selon la réglementation locale en vigueur)."  class="form-control"
                                            rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="emailAdd">À Propos De La Propriété</label>
                                <textarea  v-model="configuration.about"  @change="refreshAbout" style="border: 1px solid #888;"  class="form-control description"
                                            rows="6"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="emailAdd">Adresse</label>
                                <input  @change="refreshAbout"  v-model="configuration.adress"  type="text" class="form-control input-pill" placeholder="fiaccula - pianiccia capitoro, 20117 Cauro, France" name="adresse">
                            </div>

                            <div class="form-group">
                                <label for="emailAdd">Aux Alentours</label>
                                <textarea  v-model="configuration.voisignage"  @change="refreshAbout" style="border: 1px solid #888;"  class="form-control"
                                            rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>
            <Transition name="fade" appear>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Aménagements</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="emailAdd">Nombre de pièce</label>
                                <input min="0"  v-model="amenagement.piece"  @change="refreshAmenagement"  type="number" class="form-control input-pill">
                            </div>
                            <div class="form-group">
                                <label for="emailAdd">Lit</label>
                                <input  v-model="amenagement.bed"  @change="refreshAmenagement"  type="text" class="form-control input-pill" placeholder="Ex : 2 Lits simples, 3 Lits doubles, 1 Lit bébé, 1 Canapé" name="bed">
                            </div>
                            <div class="form-group">
                                <label for="emailAdd">Nombre de Salles de Bains</label>
                                <input min="0"  v-model="amenagement.bathroom"  @change="refreshAmenagement"  type="number" class="form-control input-pill">
                            </div>

                            <div class="form-group">
                                <label for="emailAdd">Nombre de Piscine</label>
                                <input min="0"  v-model="amenagement.pool"  @change="refreshAmenagement"  type="number" class="form-control input-pill">
                            </div>

                            <div class="form-group">
                                <label for="emailAdd">Nombre de Parking</label>
                                <input min="0"  v-model="amenagement.parking"  @change="refreshAmenagement"  type="number" class="form-control input-pill">
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>
            <Transition name="fade" appear>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Informations importantes</div>
                                <div class="card-tools">
                                    <a href="#"  data-toggle="modal" data-target="#newInfoModal" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Nouveau
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p  v-for="info in information" :key="info.id">- {{info.name}}</p>
                        </div>
                    </div>
                </div>
            </Transition>

            <Transition name="fade" appear>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Équipements</div>
                                <div class="card-tools">
                                    <a href="#"  data-toggle="modal" data-target="#newEquippementModal" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Nouveau
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body row">
                            <p class="col-md-4 col-lg-4"  v-for="e in equippement" :key="e.id">- {{e.name}}</p>
                        </div>
                    </div>
                </div>
            </Transition>

            <Transition name="fade" appear>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Partenaire</div>
                                <div class="card-tools">
                                    <a href="#"  data-toggle="modal" data-target="#newPartenaireModal" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Nouveau
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="card col-md-3 col-lg-3 col-sm-6"  v-for="partenaire in partenaires" :key="partenaire.id">
                                <img :src="getImagePartenaire(partenaire)" class="card-img-top" :alt="partenaire.name">
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>

            <Transition name="fade" appear>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Photo Gallery</div>
                                <div class="card-tools">
                                    <a href="#"  data-toggle="modal" data-target="#newGalleryModal" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Nouveau
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="card col-md-3 col-lg-3 col-sm-6"  v-for="g in gallery" :key="g.id">
                                <img :src="getImageInGallery(g)" class="card-img-top" :alt="g.name">
                            </div>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>

        <!-- MODAL AJOUT EQUIPEMENT -->
        <div class="modal fade" id="newInfoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="newInfoModalLabel">Ajout d'une Information importante</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" id="formAddInfo" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nameAddUser">Nom</label>
                                <input v-model="addInfo.name"  required type="text" class="form-control input-pill" name="name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click="addNewInfo"  id="btnAddInfo" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL AJOUT EQUIPEMENT -->
        <div class="modal fade" id="newEquippementModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newEquippementModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="newEquippementModalLabel">Ajout d'une Équipements</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" id="formAddEquippement" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nameAddUser">Nom</label>
                                <input v-model="add.name"  required type="text" class="form-control input-pill" name="name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click="addEquippement"  id="btnAddEquippement" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL AJOUT PARTENAIRE -->
        <div class="modal fade" id="newPartenaireModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newPartenaireModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="newPartenaireModalLabel">Ajout d'un Partenaire</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                    <div class="form-group">
                        <label for="add-image" class="text-primary"><i class="fas fa-angle-down"></i> Logo du Partenaire</label>
                        <image-uploader @image-change="changeImagePartenaire"  v-bind:id="idInputImagePartenaire" v-bind:defaultValue="defaultImagePartenaire"></image-uploader>
                    </div>
                    <div class="modal-footer">
                        <button @click="addPartenaire"  id="btnAddPartenaire" class="btn btn-primary">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        
                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL AJOUT image -->
        <div class="modal fade" id="newGalleryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newGalleryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="newGalleryModalLabel">Ajout d'une Image</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" id="formAddGallery" method="POST">
                        <div class="form-group">
                            <label for="add-image" class="text-primary"><i class="fas fa-angle-down"></i> Image</label>
                            <image-uploader @image-change="changeImage"  v-bind:id="idInputImage" v-bind:defaultValue="defaultImage"></image-uploader>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click="addGallery"  id="btnAddGallery" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
import helper from '../../../helper';
export default {
    data(){
        return {
            add : {name : ""},
            addInfo : {name : ""},
            update : {name: ""},
            house : {},
            configuration : {house : {name: ""}},
            amenagement : {},
            equippement : [],
            gallery : [],
            partenaires : [],
            information : [],
            idInputImage : "addContainerImageGallery",
            idInputImagePartenaire : "addContainerImagePartenaire",
            newImageGallery : {image : {}, imageName : ""},
            newImagePartenaire : {image : {}, imageName : ""},

            defaultImage : "",
            defaultImagePartenaire : "",
        }
    },

    methods : {
        addEquippement(){
            let btnAnimate = new Bouton('btnAddEquippement');
            btnAnimate.attenteBtn();

            const params = {
                name : this.add.name,
                house_id : this.$route.params.id,
            };

            axios.post(helper.getBaseUrl() +"/equippement/add",  params).then(response => {
                btnAnimate.arreter();
                if(response != null && typeof response.data != "undefined")
                    helper.suucessRequest(response.data);
                this.equippement = response.data.data;
                $("#newEquippementModal .modal-footer button[data-dismiss=modal]").trigger("click");
                this.add = {name: ""};
            })
            .catch((error) => {
                btnAnimate.arreter();
                $("#newEquippementModal .modal-footer button[data-dismiss=modal]").trigger("click");
                helper.errorRequest(error);
            });
			
        },

        addNewInfo(){
            let btnAnimate = new Bouton('btnAddInfo');
            btnAnimate.attenteBtn();

            const params = {
                name : this.addInfo.name,
                house_id : this.$route.params.id,
            };

            axios.post(helper.getBaseUrl() +"/information/add",  params).then(response => {
                btnAnimate.arreter();
                if(response != null && typeof response.data != "undefined")
                    helper.suucessRequest(response.data);
                this.information = response.data.data;
                $("#newInfoModal .modal-footer button[data-dismiss=modal]").trigger("click");
                this.addInfo = {name: ""};
            })
            .catch((error) => {
                btnAnimate.arreter();
                $("#newInfoModal .modal-footer button[data-dismiss=modal]").trigger("click");
                helper.errorRequest(error);
            });
			
        },

        addGallery(){
            
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };

            let btnAnimate = new Bouton('btnAddGallery');
            btnAnimate.attenteBtn();

            var formData = new FormData();
            formData.append("house_id", this.$route.params.id);
            formData.append("image", this.newImageGallery.image);
            formData.append("imageName", this.newImageGallery.imageName);

            axios.post(helper.getBaseUrl() +"/gallery/add", formData, config)
                .then((response) => {
                    btnAnimate.arreter();
                    if(response != null && typeof response.data != "undefined")
                        helper.suucessRequest(response.data);
                    this.gallery = response.data.data;
                    $("#newGalleryModal .modal-footer button[data-dismiss=modal]").trigger("click");
                })
                .catch((error) => {
                    btnAnimate.arreter();
                    $("#newGalleryModal .modal-footer button[data-dismiss=modal]").trigger("click");
                    helper.errorRequest(error);
                });
            
        },

        addPartenaire() {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };

            let btnAnimate = new Bouton('btnAddPartenaire');
            btnAnimate.attenteBtn();

            var formData = new FormData();
            formData.append("house_id", this.$route.params.id);
            formData.append("image", this.newImagePartenaire.image);
            formData.append("imageName", this.newImagePartenaire.imageName);

            axios.post(helper.getBaseUrl() +"/partenaire/add", formData, config)
                .then((response) => {
                    btnAnimate.arreter();
                    if(response != null && typeof response.data != "undefined")
                        helper.suucessRequest(response.data);
                    this.partenaires = response.data.data;
                    $("#newPartenaireModal .modal-footer button[data-dismiss=modal]").trigger("click");
                })
                .catch((error) => {
                    btnAnimate.arreter();
                    $("#newPartenaireModal .modal-footer button[data-dismiss=modal]").trigger("click");
                    helper.errorRequest(error);
                });
        },

        changeImage(data) {
            this.newImageGallery.image = data;
            this.newImageGallery.imageName = helper.getNameImage(data);
        },

        changeImagePartenaire(data) {
            this.newImagePartenaire.image = data;
            this.newImagePartenaire.imageName = helper.getNameImage(data);
        },

        getImageInGallery(image) {
            var path = "";
            if(Image != null && typeof image.name != "undefined" &&  image.name != "" && typeof image.house_id != "undefined")
                path = "assets/img/gallery/"+ image.house_id + "/" +  image.name;
            return path;
        },

        getImagePartenaire(partenaire) {
            var path = "";
            if(partenaire != null && typeof partenaire.name != "undefined" &&  partenaire.name != "" && typeof partenaire.house_id != "undefined")
                path = "assets/img/partenaire/"+ partenaire.house_id + "/" +  partenaire.name;
            return path;
        },

        getHouse() {
            axios.post(helper.getBaseUrl() +"/house/getById", {
                id : this.$route.params.id
            }).then(response => {
                this.house = response.data;
                if(this.house != null && typeof this.house.about != "undefined" && this.house.about != null &&  typeof this.house.about[0] != "undefined" )
                    this.configuration = this.house.about[0];

                if(this.house != null && typeof this.house.amenagement != "undefined" && this.house.amenagement != null &&  typeof this.house.amenagement[0] != "undefined" )
                    this.amenagement = this.house.amenagement[0];

                if(this.house != null && typeof this.house.equippement != "undefined" && this.house.equippement != null &&  typeof this.house.equippement[0] != "undefined" )
                    this.equippement = this.house.equippement;

                if(this.house != null && typeof this.house.gallery != "undefined" && this.house.gallery != null &&  typeof this.house.gallery[0] != "undefined" )
                    this.gallery = this.house.gallery;

                if(this.house != null && typeof this.house.information != "undefined" && this.house.information != null &&  typeof this.house.information[0] != "undefined" )
                    this.information = this.house.information;

                if(this.house != null && typeof this.house.partenaire != "undefined" && this.house.partenaire != null &&  typeof this.house.partenaire[0] != "undefined" )
                    this.partenaires = this.house.partenaire;
            })
            .catch((error) => {
                helper.errorRequest(error);
            });
        },

        refreshAbout() {
            var  params = this.configuration;
            params["house_id"] = this.$route.params.id;
            axios.post(helper.getBaseUrl() +"/about/refreshValue",  params).then(response => {
                if(response != null && typeof response.data != "undefined")
                    helper.suucessRequest(response.data);
            })
            .catch((error) => {
                helper.errorRequest(error);
            });
        },

        refreshAmenagement() {
            axios.post(helper.getBaseUrl() +"/amenagement/refreshValue",  this.amenagement).then(response => {
                if(response != null && typeof response.data != "undefined")
                    helper.suucessRequest(response.data);
            })
            .catch((error) => {
                helper.errorRequest(error);
            });
        },

    },

    created(){
        this.getHouse();
    },

    mounted() {
    }
}
</script>
