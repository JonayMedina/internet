<template>
    <v-layout row wrap>
        <v-container>
            <v-flex xs6>
                <v-subheader>Bancos</v-subheader>
            </v-flex>

            <v-flex xs12>
                <v-card>
                    <status-alert ref="statusAlert"></status-alert>
                </v-card>
                <v-data-table :headers="headers" :items="banks" :items-per-page="10" class="elevation-1" >
                    <template >
                        <v-toolbar flat color="white">
                            <v-toolbar-title>Cuentas Registradas</v-toolbar-title>
                            <v-divider class="mx-4" inset vertical></v-divider>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                    </template>
                    <template v-slot:item.actions="{ item }">
                      <v-btn @click="editBank(item)"
                        color="blue-grey darken-4" x-small
                        class="ma-1 white--text"
                        > Editar
                            <v-icon right small dark>  mdi-pencil </v-icon>
                        </v-btn>
                      <v-btn v-if="item.active ==1" x-small
                        @click="desactiveBank(item.id)"
                        color="blue-grey"
                        class="ma-1 white--text"
                        > Desactivar
                            <v-icon small right dark>  mdi-eye-off-outline </v-icon>
                      </v-btn>
                        <v-btn v-if="item.active ==0 || item.active ==null" @click="activeBank(item.id)"
                        color="green darken-2" x-small
                        class="ma-1 white--text"
                        > Activar
                            <v-icon small right dark>mdi-check-circle-outline </v-icon>
                        </v-btn>
                        <v-btn v-if="item.active ==0 || item.active ==null" @click="deleteBank(item.id)"
                        color="deep-orange" x-small
                        class="ma-1 white--text"
                        > Eliminar
                            <v-icon small right dark>  mdi-close-outline </v-icon>
                        </v-btn>
                    </template>

                </v-data-table>

            </v-flex>

            <v-btn bottom color="pink" dark fab fixed right @click="showDialog()" >
              <v-icon>mdi-plus</v-icon>
            </v-btn>
            <v-row class="mx-2">
                <v-dialog v-model="dialog" cols="10">
                  <v-card>
                    <v-card-title class="grey darken-2" v-text="dialog_title">

                    </v-card-title>
                    <v-container>
                      <v-row class="mx-2">
                        <v-col class="align-center justify-space-between" cols="12">
                          <v-row align="center" class="mr-0">
                            <v-avatar size="40px" class="mx-3">
                              <img src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png" alt="">
                            </v-avatar>
                            <v-col cols="3">
                                <v-text-field type="text" v-model="bank.name"
                                  placeholder="Nombre del Banco"
                                />
                            </v-col>
                            <v-col cols="3">
                                <v-text-field type="text" v-model="bank.account_number"
                                  placeholder="Numero de cuenta"
                                />
                            </v-col>
                            <v-col cols="3">
                                <v-text-field type="text" v-model="bank.holder"
                                  placeholder="Nombre del Titular de la cuenta a utilizar sino es de la empresa"
                                />
                            </v-col>
                          </v-row>
                        </v-col>

                      </v-row>
                    </v-container>
                    <v-card-actions>
                      <v-btn  text color="primary"
                        @click="dialog = false" > Cancelar</v-btn>
                      <v-btn text v-if="turn == 1" @click="createBank(bank)" >Guardar</v-btn>
                      <v-btn text v-if="turn == 2" @click="updateBank(bank)" >Actualizar</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
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
            name:'',
            account_number:'',
            holder:'',
            active:0,
            banks: [],
            bank: {},
            dialog:false,
            dialog_title:'',
            turn:0,
            saving: false,
            headers: [
                {
                    text:'id',
                    align: 'right',
                    value: 'id',
                    sortable: false
                },
                {
                    text:'Banco',
                    align: 'center',
                    value: 'name',
                    sortable: false
                },
                {
                    text:'N° de Cuenta',
                    align: 'center',
                    value: 'account_number',
                    sortable: false
                },
                {
                    text:'titular de Cuenta',
                    align: 'right',
                    value: 'holder',
                    sortable: false
                },
                { text: 'Opciones', value: 'actions', sortable: false }
            ],

        }
    },

    methods: {
        index() {
            let me = this;
            axios.get('/api/banks')
                .then(response => {
                    me.banks = response.data.banks;
            });
        },
        showDialog() {
            let me = this;
            me.bank={};
            me.turn = 1;
            me.id=0;
            me.name='';
            me.account_holder='';
            me.account_code='';
            me.description='';
            me.dialog_title='Guardar Cuenta';
            me.dialog = true;

        },
        createBank() {

            // console.log(this.bank.id);
            this.saving = true
            this.axios
                .post('/api/banks/store', this.bank)
                .then(response => {
                    this.index();
                    this.dialog = false;
                    Swal.fire({
                        position:'top-end',
                        type: 'success',
                        title: 'Banco Guardado',
                        timer: 3000
                    });
                })
                .catch(error => console.log(error))
                .finally(() => this.loading = false,this.saving = false)

        },
        desactiveBank(id){
            let me = this
            const data = {
                'url':'/api/banks/desactive/'+id,
                'title' :'Esta seguro de inactivar este Banco ?',
            }
            fire.desactiveF(data)
            .then((res)=>{
                me.index();
                me.alert(2,res)
            })
            .catch((error)=>{
                // statusAlert.alert(4,error)
            })
        },
        activeBank(id){
            let me = this;
            const data = {
                'url':'/api/banks/activate/'+id,
                'title' :'Activar Cuenta Bancaria?',
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
        editBank (item) {
            let me = this;
            me.turn = 2;
            me.dialog_title='Actualizar';
            me.bank = me.banks.indexOf(item);
            me.bank = Object.assign({}, item);
            me.dialog = true;
        },
        updateBank(bank) {
            let me =this;
            me.saving = true
            bank._method = 'put'
            axios.post('/api/banks/update/'+bank.id,bank)
            .then((res)=>{
                me.bank={};
                me.turn = 1;
                me.dialog_title='Guardar Cuenta';
                me.index();
                me.dialog = false;
                me.alert(1,res)
            })
            .catch((error)=>{
                me.alert(4,error)
            })
        },

        deleteBank (id) {
            let me = this;
            const data = {
                'url':'/api/banks/destroy/'+id,
                'title' :'Eliminar Plan',
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
        alert: function (display,res){
            this.$refs.statusAlert.showAlert(display, res);
        },
    },
    mounted() {
        this.index();
    }
}
</script>
