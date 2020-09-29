<template>
    <v-layout row wrap mx-2>
            <v-flex xs6>
                <v-subheader>Planes de Servicio</v-subheader>
            </v-flex>

            <v-flex xs12>
                <v-card>
                    <v-alert :value="display.status" cols="6" :type="display.type"
                        dismissible close-icon="mdi-delete"
                        border="left" elevation="2" :color="display.color" dark
                        class="fixed zindex-1 col-12" colored-border
                        >
                        {{display.text}}
                    </v-alert>
                </v-card>
                <v-card>

                    <v-card-title>

                        <v-text-field
                            v-model="search" append-icon="mdi-magnify"
                            label="Buscar cobros por cualquier parametro"
                            single-line hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :search="search" :items="plans" :items-per-page="10" class="elevation-1"
                    :footer-props="{ 'items-per-page-options': [10, 50, 100, 250, 500] }" >
                        <template v-slot:item.id="{ item }">
                            <v-chip :color="getColor(item.active)" dark>{{ item.id }}</v-chip>
                        </template>
                        <template v-slot:item.download="{item}">
                            {{item.download }} {{ item.unit_dw}}
                        </template>
                        <template v-slot:item.upload="{item}">
                            {{item.upload }} {{ item.unit_up}}
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-btn @click="editPlan(item)"
                            color="blue-grey darken-4" x-small
                            class="ma-1 white--text"
                            > Editar
                                <v-icon right small dark>  mdi-pencil </v-icon>
                            </v-btn>
                            <v-btn v-if="item.active ==1" x-small
                            @click="desactivePlan(item.id)"
                            color="blue-grey"
                            class="ma-1 white--text"
                            > Desactivar
                                <v-icon small right dark>  mdi-eye-off-outline </v-icon>
                            </v-btn>
                            <v-btn v-if="item.active ==0 || item.active ==null" @click="activePlan(item.id)"
                            color="green darken-2" x-small
                            class="ma-1 white--text"
                            > Activar
                                <v-icon small right dark>mdi-check-circle-outline </v-icon>
                            </v-btn>
                            <v-btn v-if="item.active ==0 || item.active ==null" @click="deletePlan(item.id)"
                            color="deep-orange" x-small
                            class="ma-1 white--text"
                            > Eliminar
                                <v-icon small right dark>  mdi-close-outline </v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>
            <router-link :to="{ name: 'create-plan'}">
                <v-btn bottom color="pink" dark fab fixed right  >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
            </router-link>

            <v-row class="mx-2">
                <v-dialog v-model="dialog" cols="8">
                  <v-card>
                    <v-card-title class="grey darken-2" color="white" >
                        <div style="color:white">Actualizar Plan</div>
                    </v-card-title>
                    <v-container>
                        <v-row class="mx-2">
                            <v-col class="align-center justify-space-between" cols="12" md="4">
                            <v-row align="center" class="mr-0">
                                <v-text-field type="text" v-model="plan.name" prepend-icon="mdi-floor-plan"
                                placeholder="Nombre del Plan a Ofrecer o Servico" required label="Ingrese Plan o Servicio"
                                />
                            </v-row>
                            </v-col>

                            <v-col class="align-center justify-space-between" cols="6" md="3">
                            <v-row align="center" class="mr-0">
                                <v-text-field type="number" v-model="plan.download" prepend-icon="mdi-download" :rules="rules"
                                placeholder="Tasa de Bajada o Descarga (Download)" required label="Ingrese Tasa en Numeros"
                                />
                            </v-row>
                            </v-col>
                            <v-col class="align-center justify-space-between" cols="6" md="3">
                                <v-row align="center" class="mr-0">
                                    <span style="color:red;" v-show="plan.unit_dw == '' ">Seleccione unidad de Descarga</span>
                                    <v-select v-model="plan.unit_dw" item-value="value"
                                    :items="units" prepend-icon="mdi-chart-bell-curve-cumulative"
                                    label="Seleccione unidad de Descarga"
                                    >
                                        <template slot='selection' slot-scope='{ item }'>
                                            {{ item.text }}
                                        </template>
                                        <template slot='item' slot-scope='{ item }'>
                                            {{ item.text }}
                                        </template>
                                    </v-select>
                                </v-row>
                            </v-col>
                            <v-col class="align-center justify-space-between" cols="6" md="3">
                            <v-row align="center" class="mr-0">
                                <v-text-field type="number" v-model="plan.upload" prepend-icon="mdi-upload" :rules="rules"
                                placeholder="Tasa de Carga o subida (Upload)" required label="Ingrese Tasa en Numeros"
                                />
                            </v-row>
                            </v-col>
                            <v-col class="align-center justify-space-between" cols="6" md="3">
                                <v-row align="center" class="mr-0">
                                    <span style="color:red;" v-show="plan.unit_up == '' ">Seleccione unidad de Carga o Subida</span>
                                    <v-select v-model="plan.unit_up" item-value="value"
                                    :items="units" prepend-icon="mdi-chart-bell-curve-cumulative"
                                    label="Seleccione unidad de Carga o Subida"
                                    >
                                        <template slot='selection' slot-scope='{ item }'>
                                            {{ item.text }}
                                        </template>
                                        <template slot='item' slot-scope='{ item }'>
                                            {{ item.text }}
                                        </template>
                                    </v-select>
                                </v-row>
                            </v-col>
                            <v-col class="align-center justify-space-between" cols="8" md="4">
                                <v-row align="center" class="mr-0">
                                    <v-text-field type="number" v-model="plan.cost" prepend-icon="mdi-currency-usd-circle-outline"
                                    placeholder="Costo del Plan o servicio" required label="Precio del Plan" :rules="rulemoney"
                                    />
                                </v-row>
                            </v-col>

                            <v-col cols="6">
                            <v-text-field type="text" prepend-icon="mdi-account-card-details-outline" placeholder="Breve descripcion del Plan o Servico" v-model="plan.description"/>
                            </v-col>
                        </v-row>
                        </v-container>
                        <v-card-actions>
                            <v-btn  text @click="dialog=false"> Cancelar</v-btn>

                            <v-btn color="primary" :loading="saving" @click="updatePlan(plan)" >Actualizar Plan</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
    </v-layout>

</template>

<script>
import fire from '../../helpers/swalfire.js'
export default {
        data() {
            return {
                plan: {},
                plans:[],
                search: null,
                loading:false,
                dialog:false,
                saving: false,
                hasSaved: true,
                display: {
                    'status' : false
                },
                headers: [
                    {
                        text:'N° Plan',
                        align: 'left',
                        value: 'id',
                    },
                    {
                        text:'Nombre',
                        align: 'center',
                        value: 'name',
                    },
                    {
                        text:'Bajada',
                        align: 'center',
                        value: 'download',
                    },
                    {
                        text:'Subida',
                        align: 'center',
                        value: 'upload',
                    },
                    {
                        text:'Precio',
                        align: 'right',
                        value: 'cost',
                    },
                    {
                        text:'Fecha',
                        align: 'right',
                        value: 'created_at',
                    },

                    { text: 'Opciones', value: 'actions', sortable: false }
                ],
                units: [
                    {
                        text:'Kbps',
                        value: 'kb'
                    },
                    {
                        text:'Mbps',
                        value: 'mb'
                    },
                    {
                        text:'Gbps',
                        value: 'gb'
                    }
                ],
                errorplan:0,
                errorListplan:[],
                arrayDetail: [],
                rules: [
                    value => !!value || 'Required.',
                    value => (value && value.length < 1) || 'Minimo 1 numero',
                ],
                rulemoney: [
                    value => !!value || 'Required.',
                    value => (value && value.length <= 2) || 'Min 2 caracteres',
                ],

            }
        },
        computed: {
        },
        methods: {
            index() {
                let me = this;

                me.axios
                    .get('/api/plans')
                    .then(response => {
                        me.plans = response.data.plans;
                });
            },
            editPlan(plan){
                let me = this
                me.plan = {}
                me.plan = plan
                me.dialog = true

            },
            updatePlan(plan) {
                let me = this;
                if (me.validatePlan()) {
                    return;
                }
                plan._method = 'put';
                console.log(plan);
                me.saving = true;
                axios.post('/api/plans/update/'+plan.id, plan)
                    .then(response => {
                        me.dialog = false
                        Swal.fire({
                            position:'top-end',
                            icon: 'success',
                            title: `${response.data.message}`,
                            timer: 3000
                        });
                        me.index();
                        me.plan = {}

                    })
                    .catch(error => console.log(error))
                    .finally(() => this.saving = false);
            },
            validatePlan() {
                let me=this;
                me.errPlan=0;
                me.errPlanL =[];

                if (!me.plan.name) me.errPlanL.push("Por favor un nombre de plan");
                if (!me.plan.download)me.errPlanL.push("Por favor ingrese una tasa de descarga (Download)");
                if (!me.plan.upload)me.errPlanL.push("Por favor ingrese una tasa de subida (Upload).");
                if (!me.plan.unit_dw)me.errPlanL.push("Por favor Seleccione medida de Bajada");
                if (!me.plan.unit_up)me.errPlanL.push("Por favor Seleccione medida de Subida");
                if (!me.plan.cost)me.errPlanL.push("Por favor ingrese el Costo del Plan");
                if (me.errPlanL.length) me.errPlan = 1;
                if (me.errPlanL.length >= 1) {
                    Swal.fire({
                        title:'Hey!! Nos falta(n) Datos',
                        icon: 'info',
                        confirmButtonText: 'Aceptar!',
                        confirmButtonColor: '#3085d6',
                        html: `${me.errPlanL.map( er =>`<br><span style="color:red;" class="mb-3"><i class="mdi mdi-minus-circle-outline mdi-spin mr-3"></i> ${er}</span>`)}`,
                        showCancelButton: false
                    });
                };
                return me.errPlan;
            },
            desactivePlan(id){
                let me = this
                const data = {
                    'url':'/api/plans/desactive/'+id,
                    'title' :'Esta seguro de anular este plan ?',
                }
                fire.desactiveF(data)
                .then((res)=>{
                    me.index();
                    me.showAlert(2,res)
                })
                .catch((error)=>{
                    me.showAlert(4,error)
                })
            },
            activePlan(id){
                let me = this;
                const data = {
                    'url':'/api/plans/activate/'+id,
                    'title' :'Activar Plan ?',
                }
                fire.activeF(data)
                .then((res)=>{
                    me.index();
                    me.showAlert(1,res)
                })
                .catch((error)=>{
                    me.showAlert(4,error)
                })
            },
            deletePlan(id){
                let me = this;
                const data = {
                    'url':'/api/plans/destroy/'+id,
                    'title' :'Elimiar Plan',
                }
                fire.deleteF(data)
                .then((res)=> {
                    me.index();
                    me.showAlert(3,res)
                })
                .catch((error)=>{
                    me.showAlert(4,error)
                })
            },
            showAlert(display, res){
                let me = this
                switch (display) {

                    case 1:
                        // pago aprobado 'activePlan()'
                        me.display = {
                            'text' : res,
                            'color' : 'green',
                            'status' : true,
                            'type' : 'success'
                        }
                        setTimeout(() => me.display.status = false, 3000);
                        break;
                    case 2:
                        // disactivePlan()
                        me.display = {
                            'text' : 'Plan Inactivo',
                            'color' : 'grey',
                            'status' : true,
                            'type' : 'info'
                        }
                        setTimeout(() => me.display.status = false, 3000);
                        break;

                    case 3:
                        // deletePlan()
                        me.display = {
                            'text' : 'Plan Eliminado',
                            'color' : 'blue',
                            'status' : true,
                            'type' : 'warning'
                        }
                        setTimeout(() => me.display.status = false, 3000);
                        break;

                    case 4:
                        // error
                        me.display = {
                            'text' : 'Error, no se pudo procesar!!',
                            'color' : 'red',
                            'status' : true,
                            'type' : 'error'
                        }
                        setTimeout(() => me.display.status = false, 3000);
                        break;
                    default:
                        break;
                }

            },
            getColor (active) {
                if (active > 0) return 'green'
                else return 'orange'
            },
        },
        mounted() {
            this.index();
        }
    }
</script>
