<template>
    <v-layout mx-2 my-3>
        <v-flex xs12>
            <v-card>
                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">Bienvenid@</h3>
                    </div>
                </v-card-title>
                <v-card-text>
                    <h5>Portal de genstion de Cobros</h5>
                </v-card-text>
                <v-card-actions>


                </v-card-actions>
            </v-card>
            <v-row>
                <v-col lg="4" cols="sm" class="pb-2">
                    <v-card>
                        <v-row class="no-gutters">
                            <div class="col-auto">
                                <div class="cyan fill-height">&nbsp;</div>
                            </div>
                            <div class="col pa-3 py-4 cyan--text">
                                <h5 class="text-truncate text-uppercase">Pagos ultimos 30 dias.</h5>
                                <h1 v-text="count"></h1>
                            </div>
                        </v-row>
                    </v-card>
                </v-col>
                <v-col lg="4" cols="sm" class="pb-2">
                    <v-card>
                        <v-row class="no-gutters">
                            <div class="col-auto">
                                <div class="primary fill-height">&nbsp;</div>
                            </div>
                            <div class="col pa-3 py-4 primary--text">
                                <h5 class="text-truncate text-uppercase">Clientes Registrados</h5>
                                <h1 v-text="customer"></h1>
                            </div>
                        </v-row>
                    </v-card>
                </v-col>
                <v-col lg="4" cols="sm" class="pb-2">
                    <v-card>
                        <v-row class="no-gutters">
                            <div class="col-auto">
                                <div class="success fill-height">&nbsp;</div>
                            </div>
                            <div class="col pa-3 py-4 success--text">
                                <h5 class="text-truncate text-uppercase">Planes Registrados</h5>
                                <h1 v-text="plan"></h1>
                            </div>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <v-card class="mx-auto text-center">
                        <v-card-title class="primary--text">
                            Cobros
                        </v-card-title>
                        <v-sparkline
                            :value="values"
                            :labels="labels"
                            padding="18"
                            label-size="4"
                            color="cyan"
                            :gradient="['#007bff','cyan']"
                            :line-width="2"
                            :stroke-linecap="'round'">
                        </v-sparkline>
                    </v-card>
                </v-col>
            </v-row>
        </v-flex>

    </v-layout>

</template>
<script>
    import { mapState} from 'vuex';
    export default {
        data() {
            return{
                user:{},
                name: '',
                email: '',
                plan: '',
                count: 0,
                customer: 0,
                total: [],
                days: [],
            }
        },
        computed:{
            values() {
                return Object.values(this.total);
            },
            labels() {
                return Object.keys(this.days);
            }
        },
        methods: {
            index(){
                let me = this
                me.charges();
                me.customers()
                me.plans()
            },
            charges(){
                let me = this
                axios.get('/api/charges/count')
                .then(response => {
                    var res = response.data;
                    me.count = res.count;
                    // me.total = Object.values( response.data.total);
                    me.total = res.total;
                    me.days = res.days;

                });
            },
            customers(){
                let me = this;
                axios.get('/api/customers/count')
                .then(response => {
                    me.customer = response.data.customers;
                });
            },
            plans(){
                let me = this;
                axios.get('/api/plans/count')
                    .then(response => {
                        me.plan = response.data.plans;
                });
            }
        },
        mounted() {
            if(localStorage.user) this.user = JSON.parse(localStorage.user);
            this.index();
        },

    }
</script>
