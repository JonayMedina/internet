<template>
    <v-layout row wrap>
        <v-container>
            <v-flex xs6>
                <v-subheader>Clientes </v-subheader>
            </v-flex>

            <v-flex xs12>
                <v-card>
                    <status-alert ref="statusAlert"></status-alert>
                </v-card>
                <v-card>
                    <v-card-title>
                        <v-text-field
                            v-model="search" append-icon="mdi-magnify"
                            label="Busque cliente cualquier parametro"
                            single-line hide-details
                        ></v-text-field>
                    </v-card-title>

                    <v-data-table :headers="headers" :search="search" :items="customers" :items-per-page="10" class="elevation-1" >
                        <template >
                            <v-toolbar flat color="white">
                                <v-toolbar-title>Clientes Registrados</v-toolbar-title>
                                <v-divider class="mx-4" inset vertical></v-divider>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-btn @click="editCustomer(item)"
                            color="blue-grey darken-4" x-small
                            class="ma-1 white--text"
                            > Editar
                                <v-icon right small dark>  mdi-pencil </v-icon>
                            </v-btn>
                            <v-btn v-if="item.active ==1" x-small
                                @click="desactiveCustomer(item.id)"
                                color="blue-grey"
                                class="ma-1 white--text"
                                > Desactivar
                                    <v-icon small right dark>  mdi-eye-off-outline </v-icon>
                            </v-btn>
                            <v-btn v-if="item.active ==0 || item.active ==null" @click="activeCustomer(item.id)"
                            color="green darken-2" x-small
                            class="ma-1 white--text"
                            > Activar
                                <v-icon small right dark>mdi-check-circle-outline </v-icon>
                            </v-btn>
                            <v-btn v-if="item.active ==0 || item.active ==null" @click="deleteCustomer(item.id)"
                            color="deep-orange" x-small
                            class="ma-1 white--text"
                            > Eliminar
                                <v-icon small right dark>  mdi-close-outline </v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.send="{item}">
                            <v-btn @click="sendMail(item)"
                            color="green darken-2" x-small
                            class="ma-1 white--text" :loading="item.sending"
                            > Recordar pago
                                <v-icon small right dark>mdi-email-send </v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>

            <v-btn bottom color="pink" dark fab fixed right @click="showDialog()" >
              <v-icon>mdi-plus</v-icon>
            </v-btn>
            <v-row class="mx-2">
                <v-container>
                  <v-dialog v-model="dialog" cols="8">

                    <v-stepper v-model="step" vertical>
                    <v-stepper-step step="1" :complete="step > 1" class="pt-4">Información del Cliente</v-stepper-step>
                    <v-stepper-content step="1">

                        <v-row class="mx-2">
                            <v-col class="align-center justify-space-between justify-space-between" cols="12" md="6">
                                <v-text-field type="text" v-model="customer.name" prepend-icon="mdi-account-box-outline"
                                placeholder="Nombre Completo"
                                label="Ingrese nombre completo del Cliente"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-text-field type="text"
                                prepend-icon="mdi-phone" label="Ingrese Telefono"
                                placeholder="Ingrese Telefono" v-model="customer.phone"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <span style="color:red;" v-show="email">Email se encuentra Registrado</span>
                                <v-text-field type="text" @change="vEmail(customer.email)" prepend-icon="mdi-email-plus" placeholder="Ingrese email" v-model="customer.email"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <span style="color:red;" v-show="dni">Cedula se encuentra Registrada</span>
                                <v-text-field type="text" @change="vDni(customer.dni)" prepend-icon="mdi-account-box"
                                    placeholder="Ingrese Cedula" v-model="customer.dni"
                                />
                            </v-col>
                            <v-col cols="12" md="6">
                                <v-textarea :auto-grow="true" :clearable="true" rows="2" prepend-icon="mdi-city-variant-outline" placeholder="Ingrese Dirección" v-model="customer.address"
                                ></v-textarea>
                            </v-col>

                        </v-row>
                        <v-btn color="primary" @click.native="step = 2">Siguiente</v-btn>
                    </v-stepper-content>
                    <v-stepper-step step="2">Datos de Servicio</v-stepper-step>
                    <v-stepper-content step="2">

                        <v-row>
                            <v-col cols="12" md="8" class="pt-0">
                                <v-row class="mx-2 pt-0">
                                    <v-col cols="12" md="6" class="pt-0 pl-0">
                                        <span>Servicio contratado por el Cliente</span>
                                        <v-select v-model="customer.plan_id" item-value="id" :items="plans" item-text="name"></v-select>
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <v-textarea :auto-grow="true" :clearable="true" rows="2" prepend-icon="mdi-city-variant-outline" placeholder="Notas o Informacion del Cliente para el contrato del servicio" label="Información del Contrato" v-model="customer.notes"
                                        ></v-textarea>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="12" md="4" class="pt-0">
                                <div class="heading" elevation="7">Ingrese Fecha de Contrato</div>
                                <v-date-picker v-model="billing_date"
                                :full-width="true" :reactive="true" locale="es-es"
                                elevation="10"></v-date-picker>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6">
                                <v-btn text @click="dialog = false" > Cancelar</v-btn>
                                <v-btn color="primary" v-if="turn == 1" @click="createCustomer(customer)" :loading="saving" >Guardar</v-btn>
                                <v-btn color="primary" v-if="turn == 2" @click="updateCustomer(customer)" :loading="saving" >Actualizar</v-btn>
                            </v-col>
                            <v-col cols="6" class="text-right">
                                <v-btn color="gray" right @click="step = 1">Regresar</v-btn>
                            </v-col>
                        </v-row>
                    </v-stepper-content>
                    </v-stepper>
                  </v-dialog>
                </v-container>

            </v-row>
        </v-container>
    </v-layout>

</template>

<script>

import fire from '../../helpers/swalfire.js'
import statusAlert from '../vue-helpers/Alerts.vue'

export default {
    components:{
        statusAlert
    },
    data() {
        return {
            id:0,
            dni:'',
            email:'',
            phone:'',
            active:0,
            search:'',
            customers: [],
            billing_date: new Date().toISOString().substr(0, 10),
            customer: {},
            plans: [],
            dialog:false,
            dialog_title:'',
            turn:0,
            step:1,
            saving: false,
            sending: false,
            errC:0,
            errCustomers:[],
            headers: [
                {
                    text:'Nombre',
                    align: 'right',
                    value: 'name',
                },
                {
                    text:'DNI',
                    align: 'right',
                    value: 'dni',
                },
                {
                    text:'Telefono',
                    align: 'right',
                    value: 'phone',
                    sortable: false
                },
                {
                    text:'email',
                    align: 'right',
                    value: 'email',
                },
                {
                    text: 'N° Contrato',
                    align: 'rigth',
                    value: 'contract.contract_num',
                },
                {
                    text: 'Plan Asignado',
                    align: 'rigth',
                    value: 'contract.plan.name',
                },
                {
                    text: 'Ultimo Pago',
                    align: 'left',
                    value: 'last_pay.created_at',
                },
                { text: 'Opciones', value: 'actions', sortable: false },
                { 
                    text: 'Recordar Pago',
                    value: 'send',
                    sortable: false
                }
            ],

        }
    },
    methods: {
        index() {
            let me = this;
            axios.get('/api/customers')
            .then(response => {
                me.customers = response.data.customers;
            });
        },
        showDialog() {
            let me = this;
            me.clearData();
            me.getPlans();
            me.dialog = true;

        },
        getPlans(){
            let me = this
            axios.get('/api/plans/')
            .then((res)=>{
                me.plans = res.data.plans
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        createCustomer() {
            let me = this
            if(me.validateCustomer()){
                return;
            }
            me.saving = true
            me.customer.billing_date = me.billing_date
            axios.post('/api/customers/store', me.customer)
            .then(response => {
                me.clearData()
                Swal.fire({
                    position:'top-end',
                    type: 'success',
                    title: 'Cliente Guardado',
                    timer: 3000
                });
            })
            .catch(error => console.log(error))
            .finally(() => me.saving = false)

        },
        desactiveCustomer(id){
            let me = this;
            const data = {
                'url':'/api/customers/desactive/'+id,
                'title' :'Esta seguro de inactivar este Cliente ?',
            };
            fire.desactiveF(data)
            .then((res)=>{
                me.index();
                me.alert(2,res);
            })
            .catch((error)=>{
                me.alert(4,error);
            })
        },
        activeCustomer(id){
            let me = this;
            const data = {
                'url':'/api/customers/activate/'+id,
                'title' :'Activar Cliente?',
            }
            fire.activeF(data)
            .then((res)=>{
                me.index();
                me.alert(1,res);
            })
            .catch((error)=>{
                me.alert(4,error);
            })
        },
        sendMail(item){
            let me = this;
            item.sending = true;
            const data = {
                'url':'/api/customers/remember-pay/'+item.id,
                'title' :'Enviar Email de recordatorio al Cliente?',
            };
            fire.sendEmail(data)
            .then((res)=>{
                me.alert(1,res);
            })
            .catch((error)=>{
                me.alert(4,error);
            })
            .finally(() => item.sending = false)
        },
        editCustomer (item) {
            let me = this;
            me.turn = 2;
            me.dialog_title='Actualizar datos de Cliente';
            me.customer = item;
            me.dialog = true;
        },
        updateCustomer() {
            let me =this;
            if(me.validateCustomer()){
                return;
            }
            me.saving = true;
            me.customer._method = 'put';
            axios.post(`/api/customers/update/${me.customer.id}`,me.customer)
            .then((res) => {
                me.clearData();
                me.alert(1,res.data.message);
            })
            .catch((error)=>{
                me.alert(4,error);
            })
            .finally(() => me.saving = false);
        },
        deleteCustomer(id){
            let me = this;
            const data = {
                'url':'/api/customers/destroy/'+id,
                'title' :'Eliminar Cliente',
            }
            fire.deleteF(data)
            .then((res)=> {
                me.index();
                me.alert(3,res)
            })
            .catch((error)=>{
                me.alert(4,error)
            })
        },
        vPhone(phone){

            let me = this;
            axios.get('/api/customers/verify-phone/'+phone)
            .then(response => {
                me.phone =response.data.phone;
            })
            .catch(error => console.log(error))
            .finally(() => this.loading = false);

        },
        vEmail(email){

            let me = this;
            axios.get('/api/customers/verify-email/'+email)
            .then(response => {
                me.email =response.data.email;
            })
            .catch(error => console.log(error))
            .finally(() => this.loading = false);

        },
        vDni(dni){

            let me = this;
            axios.get('/api/customers/verify-dni/'+dni)
            .then(response => {
                me.dni =response.data.dni;
            })
            .catch(error => console.log(error))
            .finally(() => this.loading = false);
        },
        validateCustomer(){
            let me=this;
            me.errC=0;
            me.errCustomers =[];

            if (!me.customer.name)me.errCustomers.push("Por favor ingrese nombre completo.");
            if (!me.customer.phone)me.errCustomers.push("Ingrese un numero telefonico valido.");
            if (!me.customer.email)me.errCustomers.push("Ingrese un email valido.");
            if (!me.customer.dni)me.errCustomers.push("Ingrese una Cedula valida.");
            if (!me.customer.plan_id)me.errCustomers.push("Ingrese un Servicio de Contrato.");
            if (!me.billing_date)me.errCustomers.push("Ingrese una Fecha de Facturación.");
            if (me.email)me.errCustomers.push("email Registrado, por favor introduzca otro.");
            if (me.dni)me.errCustomers.push("Cedula Registrada, por favor introduzca otra.");
            if (me.errCustomers.length) me.errC = 1;
            if (me.errCustomers.length >= 1) {
                Swal.fire({
                    title:'Falta(n) Datos',
                    icon: 'error',
                    confirmButtonText: 'Aceptar!',
                    confirmButtonColor: '#3085d6',
                    html: `${me.errCustomers.map( er =>`<br><span style="color:red;" class="mb-3"><i class="mdi mdi-minus-circle-outline mdi-spin mr-3"></i> ${er}</span>`)}`,
                    showCancelButton: false
                });
            };
            return me.errC;
        },
        clearData(){
            let me = this
            me.customer={};
            me.turn = 1;
            me.id=0;
            me.phone='';
            me.email
            me.dni=0;
            me.dialog_title='Nuevo Cliente';
            me.index();
            me.dialog = false;
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
<style>
    .v-stepper--vertical .v-stepper__step {
        padding: 10px !important;
    }

    .v-picker__title {
        padding: 4px 10px;
    }

    .v-date-picker-table--date th{
        padding: 0;
    }
</style>
