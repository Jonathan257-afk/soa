<template>
    <div>
        <Transition name="fade" appear>
            <div class="page-header" style="background-color: #fafafa;">
                <h4 class="page-title text-primary"><strong>LISTE DES MESSAGE </strong></h4>
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
                                                    <th>Expediteur</th>
                                                    <th>Email</th>
                                                    <th>Maison</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="message in messages" :key="message.id">
                                                    <td><a style="cursor:pointeur;" @click="showMessage(message.id)" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></td>
                                                    <td>{{ message.name }}</td>
                                                    <td>{{ message.email }}</td>
                                                    <td>{{ message.house.name }}</td>
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
    </div>

</template>


<script>
import helper from '../../../helper';
export default {
    data(){
        return {
            messages : {},
        }
    },

    methods : {
        getAll() {
            axios.post(helper.getBaseUrl() +"/message/getAll").then(response => {
                this.messages = response.data;
            })
            .catch((error) => {
                helper.errorRequest(error);
            });
        },

        showMessage(id) {
            this.$router.push("/message/view/" + id);
        },
    },

    created(){
        this.getAll();
    },

    mounted() {
    }
}
</script>
