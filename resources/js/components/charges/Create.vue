<template>
    <v-layout row wrap>
        <v-container>
              <v-card>
                <v-card-title class="grey darken-2" color="white" >
                  <div v-text="dialog_title" style="color:white"></div>
                </v-card-title>
                <v-container>
                  <v-row class="mx-2">
                    <v-col class="align-center justify-space-between" cols="12" md="4">
                      <v-row align="center" class="mr-0">
                        <v-icon mx-2>
                            mdi-bank-outline
                        </v-icon>
                          <v-autocomplete clearable
                            v-model="sale.bank_id" :items="banks" :filter="bankFilter"
                              color="white" item-text="name" item-value="id"
                              label="Escriba nombre del Banco y Seleccione"
                            ></v-autocomplete>
                        </v-row>
                    </v-col>

                    <v-col class="align-center justify-space-between" cols="12" md="4">
                      <v-row align="center" class="mr-0">
                        <v-icon>
                            mdi-briefcase
                        </v-icon>
                            <v-autocomplete v-model="sale.agent_id" clearable :filter="agentFilter" :items="agents"
                              color="white" item-text="username" item-value="id"  @search="agentClient"
                              label="Escriba nombre del Agente y Seleccione" @blur="agentClient">
                            </v-autocomplete>
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="12" md="4">
                      <v-row align="center" class="mr-0">
                            <v-autocomplete prepend-icon="mdi-account-box-outline" clearable v-model="sale.client_id" :items="clients"
                              color="white" item-text="name" item-value="id" :filter="clientFilter"
                              label="Escriba nombre del Cliente y Seleccione">
                            </v-autocomplete>
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="6" md="3">
                        <v-row align="center" class="mr-0">
                            <v-text-field type="number" v-model="clientAmount" prepend-icon="mdi-currency-eur"
                            placeholder="Monto enviado" required disabled label="Monto enviado por el cliente"
                            />
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="6" md="3">
                        <v-row align="center" class="mr-0">
                            <span style="color:red;" v-show="percent_amount == '' ">Seleccione un porcentaje</span>
                            <v-select @input="calcPrice"
                            v-model="percent_amount" item-value="amount"
                            :items="percents" prepend-icon="mdi-percent"
                            label="Select % de Precio"
                            >
                                <template slot='selection' slot-scope='{ item }'>
                                    {{ item.amount }} % - {{ item.type }}
                                </template>
                                <template slot='item' slot-scope='{ item }'>
                                    {{ item.amount }} % - {{ item.type }}
                                </template>
                            </v-select>
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="12" md="6">
                        <v-row align="center" class="mr-0">
                            <v-text-field disabled type="number" label="Precio Btc" v-text="'Neto '+price.amount_formated+ '. Calculado: '+ price.calc_formated+ ' ' + price.notes" required
                            placeholder="Precio Btc" prepend-icon="mdi-currency-btc"
                            />
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="6" md="4">
                        <v-row align="center" class="mr-0">
                            <v-text-field type="number" prepend-icon="mdi-currency-eur"  @input="calcBtc" v-model="amount" :rules="rulemoney" hide-details="auto"
                            placeholder="Monto" required label="Monto a cambiar"
                            />
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="6" md="3">
                        <v-row align="center" class="mr-0">
                            <v-text-field disabled type="number" label="Total BTC transferir" v-model="total_btc"
                            placeholder="Total Btc" required prepend-icon="mdi-currency-btc"
                            />
                        </v-row>
                    </v-col>
                    <v-col md="12" cols="12">
                        <v-row align="center" class="mr-0">
                            <v-col class="align-center justify-space-between" cols="6" >
                              <v-row align="center" class="mr-0">
                                  <v-autocomplete  clearable placeholder="Seleccione"
                                    v-model="sale.operation_method" prepend-icon="mdi-bank-outline"
                                      :items="methods" :filter="methodFilter"
                                      :rules="rules" hide-details="auto"
                                      color="white" item-text="name" @change="operation()"
                                      item-value="method" label="Seleccione metodo de pago"
                                    ></v-autocomplete>
                                </v-row>
                            </v-col>
                            <v-col v-show="sale.operation_method == 'deposit' " cols="6">
                                <v-text-field type="number" v-model="sale.agency_num" placeholder="N° cajero"/>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="6">
                      <v-file-input v-model="file" show-size filled
                            :rules="images" accept="image/png, image/jpeg, image/bmp"
                            placeholder="Insertar imagen JPG / PNG / BMP" prepend-icon="mdi-camera"
                            label="Imagen - Captura de Trasferencia o Deposito "
                        ></v-file-input>
                    </v-col>

                    <v-col cols="6" md="6">
                        <v-row align="center" class="mr-0">
                            <v-icon large>
                                mdi-wallet
                            </v-icon>
                            <v-text-field type="text" v-model="agentWallet"
                            placeholder="Wallet a usar para el agente" required disabled label="Wallet a Depositar"
                            />
                        </v-row>
                    </v-col>

                    <v-col cols="6">
                      <v-text-field type="text" prepend-icon="mdi-account-card-details-outline" placeholder="Breve descripcion" v-model="sale.description"/>
                    </v-col>
                  </v-row>
                </v-container>
                <v-card-actions>
                    <router-link :to="{ name: 'sales'}">
                        <v-btn  text > Cancel</v-btn>
                    </router-link>

                  <v-btn color="primary" :loading="saving" @click="createSale(sale)" >Save</v-btn>
                </v-card-actions>
              </v-card>
        </v-container>
    </v-layout>

</template>

<script>
import apis from '../../helpers/sale.js'
export default {
        data() {
            return {
                id:0,
                agent_id:0,
                client_id:0,
                bank_id:0,
                user_id:0,
                price: {},
                price_btc:0.0,
                prices:[],
                total_btc:0.0,
                file:null,
                agency_num:0,
                banks:[],
                bank:'',
                agents:[],
                clients:[],
                percent:{},
                percents:[],
                percent_amount:0.0,
                amount:0.0,
                wallet_num:'',
                operation_method:'',
                description:'',
                date:'',
                method:'',
                dialog_title:'',
                sales: [],
                sale: {},
                search: null,
                searchAgent:null,
                loading:false,
                transfer:false,
                deposit:false,
                dialog:false,
                saving: false,
                errorSale:0,
                errorListSale:[],
                arrayDetail: [],
                rules: [
                    value => !!value || 'Required.',
                    value => (value && value.length >= 3) || 'Min 3 characters',
                ],
                rulemoney: [
                    value => !!value || 'Required.',
                    value => (value && value.length >= 2) || 'Min 1 characters',
                ],
                images: [
                    value => !value || value.size < 1000000 || 'El tamaño del archivo debe ser menor a 1 MB!',
                ],
                methods: [
                    {
                        name:'Deposito cajero',
                        method: 'deposit',
                        id: 0,
                    },
                    {
                        name:'Transferencia',
                        method: 'transf',
                        id: 1,
                    },
                ],


            }
        },
        computed: {
            searchClient: function(){
                let me = this;
                if (me.sale.client_id !== 0) {
                    me.agentClient(me.sale.agent_id);
                }else{
                    me.indexClient();
                }
            },
            calcBtc: function(){
                this.total_btc= parseFloat(this.amount/this.price.amount_calc).toFixed(8);
            },
            clientAmount: function(){
                var client_id = this.sale.client_id;
                var arr = this.clients;
                for (let i = 0; i < arr.length; i++) {
                    if (arr[i].id == client_id) {
                        return arr[i].accumulated;
                    }
                }

            },
            agentWallet: function(){
                var agent_id = this.sale.agent_id;
                var agent = this.agents;
                // console.log(agent);
                for (let a = 0; a < agent.length; a++) {
                    if (agent[a].id == agent_id) {
                        return agent[a].wallet_num;
                    }
                }

            },

        },
        methods: {
            showDialog() {
                let me = this;
                me.sale.agent_id=0;
                me.sale={};
                me.clients=[];
                me.banks=[];
                me.id=0;
                me.file=null;
                me.user_id=0;
                me.order_num=0;
                me.amount=0.0;
                me.prices=[];
                me.percents = {};
                me.price_btc= 0.0;
                me.total_btc= 0.0;
                me.percent_amount= 0.0;
                me.description='';
                me.date='';
                me.operation_method='';
                me.indexPercent();
                me.indexBank();
                me.indexAgent();
                me.getEur();
                me.dialog_title='Guardar Cobro';
                me.dialog = true;

            },
            indexPercent() {
                let me = this;
                me.axios
                    .get('/api/percents')
                    .then(response => {
                        me.percents = response.data.percents;
                });
            },
            indexBank() {
                let me = this;
                me.axios
                    .get('/api/banks')
                    .then(response => {
                        me.banks = response.data.banks;
                })
                .catch(error => console.log(error))
                .finally(() => this.loading = false);
            },
            getEur(){
                let me =this;
                me.axios.get('/api/price/eur').then(response=>{
                    me.price = response.data.price;
                    me.price.calc_formated = 0.0;
                })
                .catch(error => console.log(error))
            },
            indexAgent() {
                let me = this;
                me.axios
                    .get('/api/agents')
                    .then(response => {
                        me.agents = response.data.agents;
                })
                .catch(error => console.log(error));
            },
            indexClient() {
                let me = this;
                me.axios
                    .get('/api/clients')
                    .then(response => {
                        me.clients = response.data.clients;
                });
            },
            agentClient() {
                let me = this;
                me.clients=[];
                me.axios
                    .get(`/api/clients/agent-clients/${me.sale.agent_id}`)
                    .then(response => {
                        me.clients = response.data;
                })
                .catch(error => console.log(error))
                .finally(() => this.loading = false);
            },
            bankFilter (item, queryText, itemText) {
              const textOne = item.name.toLowerCase()
              const textTwo = item.account_holder.toLowerCase()
              const searchText = queryText.toLowerCase()

               return textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(searchText) > -1

            },
            clientFilter (item, queryText, itemText) {
              const textOne = item.name.toLowerCase()
              const textTwo = item.dni.toLowerCase()
              const searchText = queryText.toLowerCase()
              const clientresult = textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(searchText) > -1;
               return clientresult;

            },
            agentFilter (item, queryText, itemText) {
              const textOne = item.username.toLowerCase()
              const searchText = queryText.toLowerCase()

               return textOne.indexOf(searchText) > -1

            },
            methodFilter (item, queryText, itemText) {
              const textOne = item.name.toLowerCase()
              const searchText = queryText.toLowerCase()

               return textOne.indexOf(searchText) > -1

            },
            createSale() {
                let me = this;
                if (me.validateSale()) {
                    return;
                }
                me.operation;
                let formData = new FormData();
                if (me.sale.agency_num) {
                    formData.append('agency_num', me.sale.agency_num);
                }

                if (me.file) {
                    formData.append('file', me.file);
                }
                formData.append('agent_id', me.sale.agent_id);
                formData.append('client_id', me.sale.client_id);
                formData.append('bank_id', me.sale.bank_id);
                formData.append('description', me.sale.description);
                formData.append('amount', me.amount);
                formData.append('operation_method', me.sale.operation_method);
                formData.append('price_btc', me.price_btc);
                formData.append('total_btc', me.total_btc);
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                me.saving = true;
                axios
                    .post('/api/sales/store', formData, config)
                    .then(response => {
                        Swal.fire({
                            position:'top-end',
                            icon: 'success',
                            title: `${response.data.message}`,
                            timer: 3000
                        });
                        me.file = null;
                        this.operation='';
                        this.$router.push({name: 'sales'});
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.saving = false);
            },
            validateSale(){
                let me=this;
                me.errorSmsS=0;
                me.errorSmsListS =[];

                if (!me.sale.client_id) me.errorSmsListS.push("Por favor Selecione un cliente");
                if (!me.amount)me.errorSmsListS.push("Por favor ingrese Monto");
                if (!me.percent_amount)me.errorSmsListS.push("Por favor Seleccione un porcentaje");
                if (!me.sale.bank_id)me.errorSmsListS.push("Por favor Seleccione Banco");
                if (!me.price_btc)me.errorSmsListS.push("Por favor Seleccione tasa y porcentaje de operacion");
                if (!me.sale.operation_method)me.errorSmsListS.push("Por favor Seleccione un metodo de Pago");
                if (me.errorSmsListS.length) me.errorSmsS = 1;
                if (me.errorSmsListS.length >= 1) {
                    Swal.fire({
                        title:'Hey!! Nos falta(n) Datos',
                        icon: 'info',
                        confirmButtonText: 'Aceptar!',
                        confirmButtonColor: '#3085d6',
                        html: `${me.errorSmsListS.map( er =>`<br><span style="color:red;" class="mb-3"><i class="mdi mdi-minus-circle-outline mdi-spin mr-3"></i> ${er}</span>`)}`,
                        showCancelButton: false
                    });
                };
                return me.errorSmsS;
            },
            operation(){
                let me = this;
                if (me.sale.operation_method == 'transf') {
                    me.sale.agency_num = '';
                }
            },
            calcPrice(){
                let calculated = ((parseFloat(this.price.amount)*this.percent_amount/100)+parseFloat(this.price.amount)).toFixed(2);
                this.price.amount_calc = calculated;
                this.price_btc = calculated;
                let val = (calculated/1).toFixed(2).replace('.', ',')
                this.price.calc_formated = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
        },
        mounted() {
            this.showDialog();
        }
    }
</script>
