<template>
    <div>
        <Transition name="fade" appear>
            <div class="page-header" style="background-color: #fafafa;">
                <h4 class="page-title text-primary"><strong>TABLEAU DE BORD</strong></h4>
            </div>
        </Transition>

        <Transition name="fade" appear>
              <!-- 
            | 
            | CORPS DU PAGE 
            |
            -->
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Visiteur Aujourd'hui</p>
                                        <h4 class="card-title">{{data.toDay.nombre}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Visiteur Ce mois-ci</p>
                                        <h4 class="card-title">{{data.month.nombre}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Visiteur Cette année</p>
                                        <h4 class="card-title">{{data.year.nombre}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Nbre Total de visiteur</p>
                                        <h4 class="card-title">{{data.all.nombre}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </Transition>
        <Transition name="fade" appear>
            <div class="row  flex-grow">
                <div class="col-12 col-md-12 col-sm-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Evolution</h4>

                                </div>
                                <a id="downGraphEvolution" @click="download('downGraphEvolution', 'lineChart')" download="statistique_evolution_visiteur.jpg" href=""
                                    class="btn btn-success float-right bg-flat-color-1"
                                    title="télécharger">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                            <div class="chartjs-bar-wrapper mt-3">
                                <div id="chart-container">
                                    <canvas class="my-auto" height="250" id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <Transition name="fade" appear>
            <div class="row  flex-grow">
                <div class="col-12 col-md-12 col-sm-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="card-title card-title-dash">Visiteur par maison</h4>

                                </div>
                                <a id="downGraphByHouse" @click="download('downGraphByHouse', 'barChart')" download="statistique_visiteur_par_maison.jpg" href=""
                                    class="btn btn-success float-right bg-flat-color-1"
                                    title="télécharger">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                            <div class="chartjs-bar-wrapper mt-3">
                                <div id="chart-container">
                                    <canvas class="my-auto" height="250" id="barChart"></canvas>
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
            data : {
                toDay : {nombre : 0},
                month : {nombre : 0},   
                year : {nombre : 0},   
                all : {nombre : 0}, 
                graph : {
                    evolution : {data : [], label : []},
                    house : {data : [], label : []},
                }  
            },
        }
    },

    methods : {
        download(id, graph) {
            var url_base64jp = document.getElementById(graph).toDataURL("image/jpg");

            var a = document.getElementById(id);
            a.href = url_base64jp;
        },

        getData() {
            axios.post(helper.getBaseUrl() +"/dashboard/getData").then(response => {
                this.data = response.data;
                this.setGraph();
            })
            .catch((error) => {
                helper.errorRequest(error);
            });
        },

        setGraph() {
            var lineChart = document.getElementById('lineChart').getContext('2d');
            var myLineChart = new Chart(lineChart, {
                type: 'line',
                data: {
                    labels: this.data.graph.evolution.label,
                    datasets: [{
                        label: "Visiteur",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: this.data.graph.evolution.data
                    }]
                },
                options : {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels : {
                            padding: 10,
                            fontColor: '#1d7af3',
                        }
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode:"nearest",
                        intersect: 0,
                        position:"nearest",
                        xPadding:10,
                        yPadding:10,
                        caretPadding:10
                    },
                    layout:{
                        padding:{left:15,right:15,top:15,bottom:15}
                    }
                }
            }); 


            var barChart = document.getElementById('barChart').getContext('2d');

            var myBarChart = new Chart(barChart, {
                type: 'bar',
                data: {
                    labels: this.data.graph.house.label,
                    datasets : [{
                        label: "Visiteur",
                        backgroundColor: 'rgb(23, 125, 255)',
                        borderColor: 'rgb(23, 125, 255)',
                        data: this.data.graph.house.data,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    },
                }
            });
        }
    },

    created(){
    },

    mounted() {
        this.getData();        
    }
}
</script>
