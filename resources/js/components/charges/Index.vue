<template>
    <v-layout row wrap mx-2>
            <v-flex xs6>
                <v-subheader>Listado de Cobros</v-subheader>
            </v-flex>

            <v-flex xs12>
                <v-card>
                    <status-alert ref="statusAlert"></status-alert>
                </v-card>
                <v-card>

                    <v-card-title>
                        <v-text-field
                            v-model="search" append-icon="mdi-magnify"
                            label="Buscar cobros por cualquier parametro"
                            single-line hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :search="search" :items="charges" :items-per-page="10" class="elevation-1"
                    :footer-props="{ 'items-per-page-options': [10, 50, 100, 250, 500] }" >
                        <template v-slot:item.actions="{ item }">
                            <v-btn v-if="item.active ==1" x-small
                            @click="desactiveCharge(item.id)"
                            color="blue-grey"
                            class="ma-1 white--text"
                            > Desaprobar
                                <v-icon small right dark>  mdi-eye-off-outline </v-icon>
                            </v-btn>
                            <v-btn v-if="item.active ==0 || item.active ==null" @click="activeCharge(item.id)"
                            color="green darken-2" x-small
                            class="ma-1 white--text"
                            > Aprobar Pago
                                <v-icon small right dark>mdi-check-circle-outline </v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>
            <router-link :to="{ name: 'create-charge'}">
                <v-btn bottom color="pink" dark fab fixed right  >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
            </router-link>
    </v-layout>

</template>

<script>
import statusAlert from '../vue-helpers/Alerts.vue'
import fire from '../../helpers/swalfire.js'
export default {
    components:{
        statusAlert
    },
    data() {
        return {
            id:0,
            banks:[],
            amount:0,
            operation_method:'',
            description:'',
            date:'',
            dialog_title:'',
            turn:0,
            charges: [],
            charge: {},
            search:'',
            color: '',
            loading:false,
            saving: false,
            hasSaved: true,
            headers: [
                {
                    text:'N° Oper',
                    align: 'left',
                    value: 'id',
                },
                {
                    text:'Cliente',
                    align: 'center',
                    value: 'customer.name',
                },
                {
                    text:'Monto',
                    align: 'center',
                    value: 'amount',

                },
                {
                    text:'Banco',
                    align: 'right',
                    value: 'bank.name',
                },
                {
                    text:'Mesualidad Pagada',
                    align: 'right',
                    value: 'payment_date',
                },
                {
                    text:'Fecha de Pago',
                    align: 'right',
                    value: 'created_at',
                },

                { text: 'Opciones', value: 'actions', sortable: false }
            ],

        }
    },
    computed: {
    },
    methods: {
        index() {
            let me = this;

            me.axios
                .get('/api/charges')
                .then(response => {
                    me.charges = response.data.charges;
            });
        },
        desactiveCharge(id){
            let me = this
            const data = {
                'url':'/api/charges/desactive/'+id,
                'title' :'Esta seguro de Desaprobar este cobro ?',
            }
            fire.desactiveF(data)
            .then((res)=>{
                me.index();
                me.alert(2,res)
            })
            .catch((error)=>{
                me.alert(4,error)
            })
        },
        activeCharge(id){
            let me = this;
            const data = {
                'url':'/api/charges/activate/'+id,
                'title' :'Aprobar Cobro ?',
            }
            fire.activeF(data)
            .then((res)=>{
                me.index();
                me.alert(1,res)
            })
            .catch((error)=>{
                me.alert(4,error)
            })
        },
        deleteSale(id){
            let me = this;
            const data = {
                'url':'/api/charges/destroy/'+id,
                'title' :'Elimiar cobro ?',
            }
            fire.deleteF(data)
            .then((res)=> {
                me.index();
                me.lert(3,res)
            })
            .catch((error)=>{
                me.alert(4,error)
            })
        },
        getColor (active) {
            if (active > 0) return 'green'
            else return 'orange'
        },
        alert: function (display,res){
            this.$refs.statusAlert.showAlert(display, res);
        },
    },
    mounted() {
        this.index();
    }
}
</script>
