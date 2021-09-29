<style>
    #bar-chart{
        max-height :500px;
    }
</style>

<template>
    <div class="container">
        <div class="row">
            <section class="content-header col-md-12">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
            </section>

        <!-- chartjs -->
            <section class="content col-md-12">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6">
                            <va-card theme="card-success">
                                <h1 class="text-center">Usulan Per Prodi</h1>
                                <pie-chart v-if="loaded" :chartdata="usulanProdiData" />
                            </va-card>
                        </div>
                        
                        <div class="col-md-6 mx-auto">
                            <va-card theme="card-info">
                                <h1 class="text-center">Usulan Per Kategori</h1>
                                <pie-chart v-if="loaded" :chartdata ='usulanKategoriData' />
                            </va-card>
                        </div>

                        <div class="col-md-12">
                            <va-card theme="card-danger">
                                <h1 class="text-center">Usulan Per Bulan</h1>
                                <bar-chart v-if="loaded" :chartdata="usulanBulanData" />
                            </va-card>
                        </div>

                        

                        </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import LineChart from './chart/LineChart.vue'
import BarChart from './chart/BarChart.vue'
import PieChart from './chart/PieChart.vue'
import VACard from './card/VACard.vue'

export default {
data(){
    return{
        loaded: false,
        usulanProdiData:{},
        usulanBulanData:{},
        usulanKategoriData:{}
    }
},

beforeMount(){
},

async mounted() {
    this.loaded = false
    await this.line()
    await this.bar()
    await this.pie()
    this.loaded = true

    },

    methods:{
        async line(){
            try {
                let labels = []
                let data = []
                let color = []
                    await axios.get('api/jumlahusulan')
                    .then(res=>{
                        res.data.forEach(element => {
                            labels.push(element.labels)
                            data.push(parseInt(element.data))
                            color.push(this.getColorMonth(element.labels))
                            })
                        })

                    this.usulanBulanData={
                            labels: labels,
                            datasets: [
                                {
                                label: 'Usulan Per Tiap Bulan',
                                data: data,
                                backgroundColor: color,
                                }
                            ]
                        }
            } catch (e) {
            console.error(e)
            }
        },
         async bar(){
            try {
            let labels = []
            let data = []
            let color = []
            await axios.get('api/jumlahusulanbar')
            .then(res=>{
                res.data.forEach(element => {
                    labels.push(element.kategori)
                    data.push(parseInt(element.jumlahusulan))
                    color.push("#"+Math.floor(256 * Math.random()))
                    })
                })

                this.usulanKategoriData={
                        labels: labels,
                        datasets: [
                            {
                            label: false,
                            data: data,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1

                            }
                        ]
                    }
                } catch (e) {
                console.error(e)
                }
        },
        async pie(){
            try {
            let labels = []
            let data = []
            let color = []
            await axios.get('api/jumlahusulanpie')
            .then(res=>{
                res.data.forEach(element => {
                    labels.push(element.prodi)
                    data.push(parseInt(element.jumlahusulan))
                    color.push(this.getColor(element.prodi))
                    })
                })

        this.usulanProdiData={
                labels: labels,
                datasets: [
                    {
                    label: 'Usulan Per Kategori',
                    data: data,
                    backgroundColor: color,
                    }
                ]
            }

                } catch (e) {
                console.error(e)
                }
        },

        getColor(prodi){
            switch(prodi){
                case "Teknik Informatika":
                    return "yellow"
                    break;
                case "Teknik Sipil":
                    return "blue"
                    break;
                case "Teknik Mesin":
                    return "red"
                    break;
                case "Teknik Manufaktur Kapal":
                    return "#A93226"
                    break;
                case "Manajemen Bisnis Pariwisata":
                    return "pink"
                    break;
                case "Agribisnis":
                    return "green"
                    break;
                case "Teknologi Pengolahan Hasil Ternak":
                    return "#935116"
                    break;

                default :
                    return "black"
                    break;
            }
        },
        getColorMonth(bulan){
            switch (bulan) {
                case " January":
                    return "#1abc9c"
                    break;
                case " February":
                    return "#2ecc71"
                    break;
                case " March":
                    return "#f1c40f"
                    break;
                 case " April":
                    return "#e74c3c"
                    break;
                 case " May":
                    return "#e67e22"
                    break;
                 case " June":
                    return "#9b59b6"
                    break;
                 case " July":
                    return "#2980b9"
                    break;
                 case " August":
                    return "#8e44ad"
                    break;
                case " September":
                    return "#d35400"
                    break;
                case " October":
                    return "#16a085"
                    break;
                case " November":
                    return "#2980b9"
                    break;
                case " December":
                    return "#e74c3c"
                    break;
                default:
                    return "red"
                    break;
            }
        }

    },
components:{
    LineChart,
    BarChart,
    PieChart,
    'va-card':VACard,
    },
}
</script>
