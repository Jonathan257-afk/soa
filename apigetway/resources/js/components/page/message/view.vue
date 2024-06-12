<template>
    <div>
        <Transition name="fade" appear>
            <div class="page-header" style="background-color: #fafafa;">
                <h4 class="page-title text-primary">
                    <strong>MESSAGE DE {{ message.name }} 
                        <p><small class="text-muted"> Email : {{ message.email }}  </small></p> 
                        <p><small class="text-muted"> Maison : {{ message.house.name }}  </small></p> 
                    </strong>
                </h4> 
                 
                
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
                                       <h4 class="timeline-title">{{ message.message}}</h4>
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
            message : { house : {name : ""}},
        }
    },

    methods : {
        getMessage() {
            axios.post(helper.getBaseUrl() +"/message/getById", {
                id : this.$route.params.id
            }).then(response => {
                this.message = response.data;
            })
            .catch((error) => {
                helper.errorRequest(error);
            });
        },
    },

    created(){
        this.getMessage();
    },

    mounted() {
    }
}
</script>
