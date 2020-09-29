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
                            v-model="sale.bank_id"
                              :items="banks"
                              :filter="bankFilter"
                              color="white"
                              item-text="name"
                              item-value="id"
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
                        <v-icon>
                            mdi-account-box-outline
                        </v-icon>
                            <v-autocomplete clearable v-model="sale.client_id" :items="clients"
                              color="white" item-text="name" item-value="id" :filter="clientFilter"
                              label="Escriba nombre del Cliente y Seleccione">
                            </v-autocomplete>
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="6" md="4">
                        <v-row align="center" class="mr-0">
                            <v-icon large>
                                mdi-currency-eur
                            </v-icon>
                            <v-text-field type="number" v-model="clientAmount"
                            placeholder="Monto enviado" required disabled label="Monto enviado por el cliente"
                            />
                        </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="6" md="4">
                      <v-row align="center" class="mr-0">
                        <v-icon large>
                            mdi-currency-eur
                        </v-icon>
                        <v-text-field type="number" v-model="amount"
                          placeholder="Monto" required label="Monto Registrado"
                        />
                      </v-row>
                    </v-col>
                    <v-col class="align-center justify-space-between" cols="6" md="4">
                        <v-row align="center" class="mr-0">
                            <v-icon large>mdi-currency-eur</v-icon>
                            <v-text-field disabled type="number" @change="calcBtc" label="Precio BTC Registrado" v-model="price_btc"
                            placeholder="Precio Btc"
                            />
                        </v-row>
                    </v-col>

                    <v-col class="align-center justify-space-between" cols="6" md="4">
                        <v-row align="center" class="mr-0">
                            <v-icon large>mdi-currency-btc</v-icon>
                            <v-text-field disabled type="number" label="Total BTC transferir" v-model="total_btc"
                            placeholder="Total Btc" required
                            />
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="8">
                        <v-row align="center" class="mr-0">
                            <v-col class="align-center justify-space-between" cols="6">
                              <v-row align="center" class="mr-0">
                                <v-icon mx-2>
                                    mdi-bank-outline
                                </v-icon>
                                  <v-autocomplete clearable
                                    v-model="sale.operation_method"
                                      :items="methods"
                                      :filter="methodFilter"
                                      color="white"
                                      item-text="name"
                                      item-value="method"
                                      label="Seleccione metodo de pago"
                                    ></v-autocomplete>
                                </v-row>
                            </v-col>
                            <v-col v-if="sale.operation_method == 'deposit' " cols="6">
                                <v-text-field type="number" v-model="sale.agency_num" placeholder="N° cajero"/>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="7">
                        <v-row align="center" class="mr-0">
                            <v-icon large>
                                mdi-wallet
                            </v-icon>
                            <v-text-field type="text" v-model="agentWallet"
                            placeholder="Wallet a usar para el agente" required disabled label="Wallet a Depositar"
                            />
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="5">
                      <v-text-field type="text" prepend-icon="mdi-account-card-details-outline" placeholder="Breve descripcion" v-model="sale.description"/>
                    </v-col>
                  </v-row>
                </v-container>
                <v-card-actions>
                    <router-link :to="{ name: 'sales'}">
                        <v-btn  text> Cancel</v-btn>
                    </router-link>

                  <v-btn color="primary" @click="updateSale(sale)" >Actualizar</v-btn>
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
                client_amount:'',
                bank_id:0,
                user_id:0,
                lastprice: [],
                id_price:0,
                price_btc:0.0,
                total_btc:0.0,
                agency_num:0,
                banks:[],
                bank:'',
                agents:[],
                agent:0,
                clients:[],
                client:0,
                amount:'',
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
                ]

            }
        },
        computed: {
            operation: function(){
                var oper = this.sale.operation_method;

                if (oper = 'transf') {
                        this.sale.agency_num='';
                }
                return oper;

            },
            searchClient: function(){
                let me = this;
                if (me.sale.client_id !== 0) {
                    me.agentClient(me.sale.agent_id);
                }
            },
            calcBtc: function(){
                var result = parseFloat(this.amount/this.price_btc).toFixed(8);
                this.total_btc = result;
                return result;

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
            indexBank() {
                let me = this;
                me.axios
                    .get('/api/banks')
                    .then(response => {
                        me.banks = response.data.banks;
                });
            },
            indexAgent() {
                let me = this;
                me.axios
                    .get('/api/agents')
                    .then(response => {
                        me.agents = response.data.agents;
                });
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
                });
            },
            bankFilter (item, queryText, itemText) {
              const textOne = item.name.toLowerCase()
              const textTwo = item.id
              const searchText = queryText.toLowerCase()

               return textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(textTwo) > -1

            },
            clientFilter (item, queryText, itemText) {
              const textOne = item.name.toLowerCase()
              const textTwo = item.id
              const searchText = queryText.toLowerCase()

               return textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(textTwo) > -1

            },
            agentFilter (item, queryText, itemText) {
              const textOne = item.username.toLowerCase()
              const textTwo = item.id
              const searchText = queryText.toLowerCase()

               return textOne.indexOf(searchText) > -1 ||
                textTwo.indexOf(textTwo) > -1

            },
            methodFilter (item, queryText, itemText) {
              const textOne = item.name.toLowerCase()
              const searchText = queryText.toLowerCase()

               return textOne.indexOf(searchText) > -1

            },
            getPrice(){
                let me =this;
                axios.get('/api/price/last').then(response=>{
                    me.lastprice = response.data.price;
                    me.price_btc = me.lastprice.amount;
                });
            },
            editItem (item) {
                let me = this;

                axios.get(`/api/sales/edit/${me.$route.params.id}`)
                    .then(response => {
                        me.sale = response.data;
                        me.price_btc = me.sale.price_btc;
                        me.total_btc = me.sale.total_btc;
                        me.amount = me.sale.amount;
                        me.indexAgent();
                        me.indexClient();
                        me.indexBank();
                        // me.bankFilter(me.banks, me.sale.bank_id);
                        // me.agentFilter(me.agents, me.sale.agent_id);
                        me.clientFilter(me.clients, me.sale.client_id, me.sale.client.name);
                    });
                me.dialog_title='Actualizar';
            },
            updateSale() {

                let me =this;
                if (me.sale.client_id===undefined) {me.sale.client_id=null};
                if (me.sale.agent_id===undefined) {me.sale.agent_id=null};
                me.sale.price_btc= me.price_btc;
                me.sale.total_btc= me.total_btc;
                me.sale.amount= me.amount;
                me.sale._method= 'put'

                axios.post(`/api/sales/update/${me.$route.params.id}`, me.sale)
                    .then(response => {
                        me.sale={};
                        me.$router.push({name: 'sales'});
                        Swal.fire({
                            position:'top-end',
                            type: 'success',
                            title: 'Cobro Actualizado',
                            timer: 3000
                        });
                    });
            },
        },
        mounted() {
            this.editItem();
        }
    }
</script>
