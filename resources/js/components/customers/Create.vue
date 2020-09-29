<template>
    <v-layout row wrap>

        <v-container>
            <v-flex xs6>
                <v-subheader>Clientes</v-subheader>
            </v-flex>

          <v-stepper v-model="step" vertical>
            <v-row>
                <v-col cols="6" class="py-0">
                    <v-stepper-step step="1" :complete="step > 1" class="pt-4">Información del Cliente</v-stepper-step>
                </v-col>
                <v-col cols="5" class="mr-1">
                    <v-layout justify-end>
                        <router-link :to="{ name: 'clients-agent'}">
                            <v-btn> Cancelar</v-btn>
                        </router-link>
                    </v-layout>
                </v-col>
            </v-row>
            <v-stepper-content step="1">

                <v-row class="mx-2" >
                    <v-col cols="12" md="6" class="pt-0 pl-0">
                        <v-text-field type="text" v-model="client.name"
                            placeholder="Nombre" required cols="12" md="6"
                            prepend-inner-icon="mdi-account-circle"
                        />
                    </v-col>
                        <!-- <v-col cols="2">
                            <template>
                                <v-select v-model="client.type" :options="types" :reduce="types => types.id"
                                label="name" required
                                ></v-select>
                            </template>

                        </v-col> -->
                    <v-col cols="12" md="6" class="pt-0 pl-0">
                        <span style="color:red;" v-show="dni">Documento Ya se encuentra Registrato, venifique si el Cliente esta registrado Cuando realize un Pago.</span>
                        <span style="color:blue;" v-show="!dni">Iingrese Documento valido (Sera Verificado!).</span>
                        <v-text-field type="text" required label="N° de Dni, Pasaporte, Nie, Etc..."
                        prepend-inner-icon="mdi-card-account-details-outline"
                        placeholder="ingrese Dni" v-model="client.dni"
                        @change="vDni(client.dni)"
                        />
                    </v-col>
                    <v-col cols="12" md="4" sm="6" class="pt-0 pl-0">
                        <span style="color:red;" v-show="email">Email se encuentra en Registrado</span>
                        <span style="color:blue;" v-show="!email">Email valido (Sera Verificado).</span>
                        <v-text-field type="text" required label="Ingrese Email valido (Sera Verificado)"
                        prepend-inner-icon="mdi-email"
                        placeholder="Ingrese Email" v-model="client.email"
                        @change="vEmail(client.email)"
                        />
                    </v-col>
                    <v-col cols="12" md="4" sm="6" class="pt-0 pl-0">
                        <span style="color:red;" v-show="phone">Ya se encuentra Registrado, por favor inserte Otro!</span>
                        <span style="color:blue;" v-show="!phone">Telefono valido (Sera Verificado).</span>
                        <v-text-field type="text" required label="Numero de Telefono Valido"
                        prepend-inner-icon="mdi-card-account-phone-outline"
                        placeholder="Ingrese Numero telefonico" v-model="client.phone"
                        @change="vPhone(client.phone)"
                        />
                    </v-col>
                    <v-col cols="12" md="4" sm="6" class="pt-0 pl-0">
                        <span style="color:blue;" v-show="!client.birthdate">Fecha de nacimiento del Cliente.</span>
                        <v-text-field type="date" required
                        prepend-inner-icon="mdi-account-card-details-outline"
                        Label="Ingrese una fecha de nacimiento" v-model="client.birthdate"
                        />
                    </v-col>
                    <v-col cols="12" md="6" class="pt-0 pl-0">
                        <v-textarea v-model="client.notes" rows="1"
                        auto-grow filled
                        color="deep-purple" label="Infomacion del cliente"
                        prepend-icon="mdi-account-card-details-outline"
                        ></v-textarea>
                    </v-col>
                </v-row>

                <v-btn color="primary" @click.native="step = 2">Siguiente</v-btn>
            </v-stepper-content>
            <v-stepper-step step="2">Fotos / Capturas del Cliente</v-stepper-step>
            <v-stepper-content step="2">
                <v-row class="mx-2">
                    <v-col cols="12" md="6" class="pt-0 pl-0">
                        <v-file-input required  show-size
                            v-model="client.id_f"
                            placeholder="Cargar Foto Frontal"
                            label="Foto 1 Dni / Pasaporte / Id / Nie"
                            prepend-icon="mdi-camera"
                        >
                        <template v-slot:selection="{ text }">
                            <v-chip small label color="primary"> {{ text }} </v-chip>
                        </template>
                        </v-file-input>
                    </v-col>
                    <v-col cols="12" md="6" >
                        <v-file-input
                            v-model="client.id_b"
                            placeholder="Cargar Foto Posterior"
                            label="Foto 2 Dni / Pasaporte / id / Nie / Licencia de conducir" show-size
                            prepend-icon="mdi-camera"
                        >
                            <template v-slot:selection="{ text }">
                                <v-chip small label color="primary"> {{ text }} </v-chip>
                            </template>
                        </v-file-input>
                    </v-col>
                    <v-col cols="12" md="6" >
                        <v-file-input
                            v-model="client.auth_image"
                            placeholder="Foto de Aceptar Terminos."
                            label="Foto de terminos Aceptados Junto con Identificacion Usada" show-size
                            prepend-icon="mdi-camera"
                        >
                            <template v-slot:selection="{ text }">
                                <v-chip small label color="primary"> {{ text }} </v-chip>
                            </template>
                        </v-file-input>
                    </v-col>
                    <v-col cols="12" md="6" >
                        <v-file-input
                            v-model="client.term_selfie"
                            placeholder="Foto Selfie con Documentos"
                            label="Foto Selfie con documentos de Identificacion y terminos aceptados." show-size
                            prepend-icon="mdi-camera"
                        >
                            <template v-slot:selection="{ text }">
                                <v-chip small label color="primary"> {{ text }} </v-chip>
                            </template>
                        </v-file-input>
                    </v-col>
                </v-row>
                <v-divider></v-divider>
                <v-row class="mx-2">
                    <v-col cols="6" class="py-0">
                        <v-btn text @click.native="step = 1">Anterior</v-btn>
                    </v-col>
                    <v-col cols="5" class="mr-1">
                        <v-layout justify-end>
                            <v-btn text color="primary" :loading="saving" right @click="createClient(client)" >Registrar</v-btn>
                        </v-layout>
                    </v-col>
                </v-row>
            </v-stepper-content>
          </v-stepper>
        </v-container>
    </v-layout>

</template>

<script>
// import apis from '../../helpers/client.js'
export default {
        data() {
            return {
                dni:'',
                email:'',
                phone:'',
                client: {},
                dialog_title:'',
                step: 1,
                turn:0,
                saving: false,

            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            },
        },
        methods: {
            data(){
                let me = this
                let data =new FormData();
                if (me.client.id_b) {
                    data.append('id_b', me.client.id_b);
                }
                if (me.client.notes) {
                    data.append('notes', me.client.notes);
                }
                data.append('name', me.client.name);
                data.append('dni', me.client.dni);
                data.append('phone', me.client.phone);
                data.append('birthdate', me.client.birthdate);
                data.append('email', me.client.email);
                data.append('agent_id', me.currentUser.agent_id);
                data.append('id_f', me.client.id_f);
                data.append('auth_image', me.client.auth_image);
                data.append('term_selfie', me.client.term_selfie);
                return data
            },
            createClient() {
                let me = this
                if (me.validateClient()) {
                    return;
                }
                me.saving = true
                const data = me.data();
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                axios.post('/api/clients/store', data)
                    .then(response => {

                        Swal.fire({
                            position:'top-end',
                            icon: 'success',
                            title: `${response.data.message}`,
                            timer: 3000
                        });
                        me.$router.push({name: 'clients-agent'});
                    })
                    .catch(error => console.log(error))
                    .finally(() => me.saving = false);

            },
            validateClient(){
                let me=this;
                me.eClient=0;
                me.errListC =[];

                if (!me.client.name)me.errListC.push("Por favor ingrese nombre completo");
                if (!me.client.dni)me.errListC.push("Por favor ingrese su usuario de LocalBitcoin!.");
                if (!me.client.phone)me.errListC.push("Ingrese un numero telefonico valido");
                if (!me.client.email)me.errListC.push("Ingrese un email valido");
                // if (!me.client.id_b)me.errListC.push("Por favor ingrese una contraseña");
                if (!me.client.id_f)me.errListC.push("Por favor cargue una Foto DNI/PASAPORTE/NIE");

                if (!me.client.auth_image)me.errListC.push("Por favor cargue una Foto de los Terminos y Condiciones Aceptados");

                if (!me.client.term_selfie)me.errListC.push("Por favor cargue una Foto Selfie con la Hoja de Terminos aceptados, Firmada.");

                if (me.email)me.errListC.push("E-mail Registrado, por favor introduzca otro");
                if (me.phone)me.errListC.push("Telefono registrado, por favor introduzca otro");
                if (me.dni)me.errListC.push("Documento registrado, venifique si el Cliente esta registrado Cuando realize un Pago.");
                if (me.errListC.length) me.eClient = 1;
                if (me.errListC.length >= 1) {
                    Swal.fire({
                        title:'Falta(n) Datos',
                        icon: 'error',
                        confirmButtonText: 'Aceptar!',
                        confirmButtonColor: '#3085d6',
                        html: `${me.errListC.map( er =>`<br><span style="color:red;" class="mb-3"><i class="mdi mdi-minus-circle-outline mdi-spin mr-3"></i> ${er}</span>`)}`,
                        showCancelButton: false
                    });
                };
                return me.eClient;
            },
            vEmail(email){
                let me = this;
                axios.get('/api/clients/email-verify/'+email)
                .then(response => {
                    me.email =response.data.email;
                })
                .catch(error => console.log(error));
            },
            vDni(dni){
                let me = this;
                axios.get('/api/clients/dni-verify/'+dni)
                .then(response => {
                    me.dni =response.data.dni;
                })
                .catch(error => console.log(error));
            },
            vPhone(phone){
                let me = this;
                axios.get('/api/clients/phone-verify/'+phone)
                .then(response => {
                    me.phone =response.data.phone;
                })
                .catch(error => console.log(error));
            },
            getAgent(){
                if (this.currentUser) {
                    let me = this;
                    axios.get(`/api/agents/get/${this.currentUser.agent_id}`)
                        .then(response => {
                            me.agent = response.data;
                    });
                }
            }
        }
    }
</script>
<style>
    .v-col {
        padding-top: 0;
    }
    .v-stepper--vertical .v-stepper__content {
        padding-top: 0px;
    }
</style>
