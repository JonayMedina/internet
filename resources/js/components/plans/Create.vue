<template>
    <v-layout row wrap>
        <v-container>
              <v-card>
                <v-card-title class="grey darken-2" color="white" >
                  <div style="color:white"> Crear Plan de Servicio</div>
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
                    <router-link :to="{ name: 'plans'}">
                        <v-btn  text > Cancelar</v-btn>
                    </router-link>

                  <v-btn color="primary" :loading="saving" @click="createPlan(plan)" >Guardar Plan</v-btn>
                </v-card-actions>
              </v-card>
        </v-container>
    </v-layout>

</template>

<script>
import fire from '../../helpers/swalfire.js'
export default {
        data() {
            return {
                plan: {},
                search: null,
                searchAgent:null,
                loading:false,
                dialog:false,
                saving: false,
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
        methods: {
            showDialog() {
                let me = this;
                me.plan={
                    cost:0.0
                };

                me.dialog_title='Guardar Cobro';
                me.dialog = true;

            },
            createPlan(plan) {
                let me = this;
                if (me.validatePlan()) {
                    return;
                }
                me.saving = true;
                axios.post('/api/plans/store', plan)
                    .then(response => {
                        Swal.fire({
                            position:'top-end',
                            icon: 'success',
                            title: `${response.data.message}`,
                            timer: 3000
                        });
                        this.$router.push({name: 'plans'});
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
        },
        mounted() {
            this.showDialog();
        }
    }
</script>
