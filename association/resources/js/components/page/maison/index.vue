<template>
    <div>
        <Transition name="fade" appear>
            <div class="page-header" style="background-color: #fafafa;">
                <h4 class="page-title text-primary"><strong>LISTE DES MAISON </strong></h4>
                <div class="btn-group btn-group-page-header ml-auto">
                    <div class="d-flex col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <button data-toggle="modal" data-target="#newHouseModal" class="btn btn-primary btn-round ml-auto mb-3"><i class="fa fa-plus"></i>
                            Nouveau
                        </button>
                    </div>
                </div>
            </div>
        </Transition>

        <Transition name="fade" appear>
              <!-- 
            | 
            | CORPS DU PAGE 
            |
            -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card  shadow-lg p-3 mb-5 bg-white">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table id="tableauRevision" class="display table table-striped table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nom</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="house in houses" :key="house.id">
                                                    <td><a href="#" @click="showHouse(house.id)" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></td>
                                                    <td>{{ house.name }}</td>
                                                    <td>
                                                        <button @click="toConfiguration(house.id)" style="margin-right:2px;" type="button"><i class="fas fa-cog"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- MODAL AJOUT SOCIETE -->
        <div class="modal fade" id="newHouseModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newHouseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="newHouseModalLabel">Ajout d'une maison</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" id="formAddHouse" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nameAddUser">Nom</label>
                                <input v-model="add.name"  required type="text" class="form-control input-pill" id="nameAddUser" name="name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click="addHouse"  id="btnAddHouse" class="btn btn-primary">Ajouter</button>
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
            add : {name: ""},
            houses : {},
        }
    },

    methods : {
        addHouse(){
            let btnAnimate = new Bouton('btnAddHouse');
            btnAnimate.attenteBtn();

            axios.post(helper.getBaseUrl() +"/house/add",  this.add).then(response => {
                btnAnimate.arreter();
                if(response != null && typeof response.data != "undefined")
                    helper.suucessRequest(response.data);
                this.houses = response.data.data;
                $("#newHouseModal .modal-footer button[data-dismiss=modal]").trigger("click");
                this.add = {name: ""};
            })
            .catch((error) => {
                btnAnimate.arreter();
                $("#newHouseModal .modal-footer button[data-dismiss=modal]").trigger("click");
                helper.errorRequest(error);
            });
			
        },

        getAll() {
            axios.post(helper.getBaseUrl() +"/house/getAll").then(response => {
                this.houses = response.data;
            })
            .catch((error) => {
                helper.errorRequest(error);
            });
        },

        showHouse(id) {
            window.open(helper.getBaseUrl() + "/house/show/" + id, "_blank") || window.location.replace(helper.getBaseUrl() + "/house/show/" + id);
        },

        toConfiguration(id) {
            this.$router.push("/house/configuration/" + id);
        },
    },

    created(){
        this.getAll();
    },

    mounted() {
    }
}
</script>
