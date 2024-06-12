<template>
    <div>
        <p @click="deconnexion"  class="dropdown-item" style="cursor: pointer;">Deconnexion</p>
    </div>
</template>

<script>
import helper from '../../../helper';
import axios from 'axios';
    export default {
        methods: {
            deconnexion(){
                swal({
                    title: 'Déconnection',
                    text: "Vous voulez vraiment vous Deconnexion ?",
                    type: 'warning',
                    buttons: {
                        confirm: {
                            text: 'Oui !',
                            className: 'btn btn-danger'
                        },
                        cancel: {
                            visible: true,
                            className: 'btn btn-success'
                        }
                    }
                }).then((Delete) => {
                    if (Delete) {
                        axios.post(helper.serveur+"/logOut")
                            .then((response) => {
                                swal.close();
                                document.location.replace(helper.serveur);
                            })
                            .catch((error) => {
                                swal.close();
                                helper.isConnected(error);
                                errorNotify("Une erreur est survenue ! Veuiller recommencer de nouveau !");
                            });
                    } else {
                        swal.close();
                    }
                });
            }
        }
    }
</script>
