<template>
    <div>
        <li class="nav-item dropdown hidden-caret">
            <a class="nav-link dropdown-toggle"  style="cursor: pointer;" id="notifDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <span class="notification" id="notifCount">{{ count }}</span>
            </a>
            <ul class="dropdown-menu notif-box animated fadeIn overflow-auto" aria-labelledby="notifDropdown">
                <li>
                    <div class="dropdown-title">Vous avez <span id="notifCount">{{ count }}</span> nouveau notification
                    </div>
                </li>
                <div id="notificationValue" class=" overflow-auto" style="height:400px;overflow: scroll;">

                    <li data-toggle="modal" data-target="#exampleModal" v-for="notification in notifications"
                        :key="notification.id">
                        <div class="notif-scroll scrollbar-outer" @click="showNotification(notification)">
                            <div class="notif-center">
                                <a  style="cursor: pointer;">
                                    <div class="notif-icon notif-primary"> <i class="flaticon-alarm-1"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            <span class="text-primary">{{ notification.titre }}</span> <br>
                                            <strong class="text-truncate d-inline-block" style="max-width: 150px;"
                                                id="listeNotif">{{ notification.designation }}</strong>
                                        </span>
                                        <span class="time" id="dateNotif">{{
        dateToString(notification.created_at)
}}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>


                </div>
                <li>
                    <a  style="cursor: pointer;" class="see-all" @click="deleteAllNotif">Supprimer tous les notifications<i
                            class="fa fa-angle-right"></i> </a>
                </li>
            </ul>
        </li>

    </div>
</template>

<script>
import helper from '../../../helper';
import axios from 'axios';
export default {

    data() {
        return {
            count: 0,
            notifications: {},
        }
    },
    methods: {
        getAllNotification() {
            axios.post(helper.serveur + "/notification/getAll")
                .then((response) => {
                    helper.isConnected(response);
                    this.notifications = response.data.data;
                    this.count = this.notifications.length;

                })
                .catch((error) => {
                    helper.isConnected(error);
                });
        },
        dateToString(dateTochange) {
            return helper.dateToString(dateTochange);
        },
        closeModal() {
            $('#modalNotificationShow').modal('toggle');
        },
        showNotification(notification) {
            swal({
                title: notification.titre,
                text: notification.designation,
                type: 'info',
                buttons: {
                    confirm: {
                        text: 'Supprimer !',
                        className: 'btn btn-danger'
                    },
                    cancel: {
                        text: 'Ok',
                        visible: true,
                        className: 'btn btn-success'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    axios.post(helper.serveur + "/notification/delete/id", {
                        id : notification.id
                    })
                        .then((response) => {
                            if (typeof response.data != "undefined" && typeof response.data.message != "undefined")
                                succesNotify(response.data.message);
                            
                            if (typeof response.data != "undefined" && typeof response.data.erreur != "undefined")
                                errorNotify(response.data.erreur);

                            this.notifications = response.data.data;
                            this.count = this.notifications.length;
                            swal.close();
                        })
                        .catch((error) => {
                            helper.isConnected(error);
                            swal.close();
                        });
                } else {
                    swal.close();
                }
            });
        },
        deleteAllNotif() {
            swal({
                title: "Suppression !",
                text: "Supprimer tous les notifications?",
                type: 'info',
                buttons: {
                    confirm: {
                        text: 'Oui !',
                        className: 'btn btn-danger'
                    },
                    Annuler: {
                        visible: true,
                        className: 'btn btn-success'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    axios.post(helper.serveur + "/notification/delete/all")
                        .then((response) => {
                            if (typeof response.data != "undefined" && typeof response.data.message != "undefined")
                                succesNotify(response.data.message);
                            
                            if (typeof response.data != "undefined" && typeof response.data.erreur != "undefined")
                                errorNotify(response.data.erreur);

                            this.notifications = response.data.data;
                            this.count = this.notifications.length;
                            swal.close();
                        })
                        .catch((error) => {
                            helper.isConnected(error);
                            swal.close();
                        });
                    
                } else {
                    swal.close();
                }
            });
        },
    },
    created() {
        this.getAllNotification();
    }
}
</script>
