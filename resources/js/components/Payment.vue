<template>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-50">
                <div class="card">
                    <div class="card-header">Realizar Busqueda por su numero de Cedula</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="dni">Por favor ingrese su Cedula</label>
                            <input type="number" name="dni" class="form-control" v-model="dni">

                            <p class="mt-2" style="color:red;" v-show="errC" v-text="errC"></p>
                        </div>
                        <button class="boxed-btn mt-3 w-100" @click="searchCustomer(dni)"
                        :disabled="loading">
                            <div class="spinner-border spinner-border-sm" v-show="loading">
                            </div>
                        Buscar Cliente</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-50">
                <div class="hero-cap hero-cap2 text-left" v-if="customer.name">
                    <h2 class="card-top" v-text="customer.name"></h2>
                    <span>E-mail: <h2 class="card-top" v-text="customer.email"></h2></span>
                    <span>Nro de Telefono: <h2 class="card-top" v-text="customer.phone"></h2></span>
                    <span>Monto del plan: <h2 class="card-top" v-text="plan.cost"></h2></span>
                    <span>Numero de Contrato: <h2 class="card-top" v-text="contract.id"></h2></span>

                </div>
                <div class="" v-else>
                    <h3>Consulte sus datos y Mantengase al dia.</h3>
                    <img :src="'./img/gallery/home-blog2.png'" class="img-reponsive w-100" alt="">
                </div>
            </div>
            <div class="col-md-12" v-if="customer.name" id="pay">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group form-group-default">
                            <label for="bank">Seleccione Banco donde Realizo el pago</label>
                            <select name="bank" v-model="payment.bank_id">
                                <option v-for="bank in banks" v-bind:value="bank.id">
                                    {{ bank.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group form-group-default">
                            <label for="type">Seleccione un metodo de Pago</label>
                            <select name="type" v-model="payment.type">
                                <option v-for="type in types" v-bind:value="type">
                                    {{ type }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group form-group-default">
                            <label for="payment_num">Ingrese Numero de Operacion</label>
                            <input type="text" name="payment_num" v-model="payment.num">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group form-group-default">
                            <label for="amount">Ingrese Monto Pagado</label>
                            <input type="text" name="amount" v-model="payment.amount">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group form-group-default">
                            <label for="payment_date">Cual mes desea Cancelar ? </label>
                            <input type="month" name="payment_date" v-model="d">
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" @click="storePayment()">Conformar Pago</button>
                    </div>

                </div>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                dni: '',
                banks: {},
                contact: {},
                d:'',
                customer: {
                    name:'',

                },
                plan:{
                    cost:0
                },
                types: [
                    'Transferencia','Deposito','Efectivo'
                ],
                contract:{},
                payment:{},
                errC:'',
                errP:'',
                errPl:[],
                loading: false,
                saving: false,
            }
        },
        methods: {
            searchCustomer(dni){
                let me = this;
                me.loading= true;
                me.customer={};
                me.errC= '';
                var url = `customer/find/${dni}`;
                axios.get(url).then(response =>{
                    var res = response.data
                    me.customer = res.customer;
                    me.plan = res.plan
                    me.contract = res.contract
                    me.getBanks()
                    let a = document.getelementbyid('panel');

                    a.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
                })
                .catch((error)=>{
                    if (error) {
                        me.errC = error.response.data.error
                    }
                })
                .finally(() => {
                    me.loading = false;
                })

            },
            getBanks(){
                let me = this
                axios.get('/api/banks')
                    .then(response => {
                        me.banks = response.data.banks;
                        var result = Array.isArray(me.banks);
                        console.log(result);
                    })
                    .catch((error)=>{
                        console.log(error);
                    })
            },
            storePayment(){
                let me = this

                if(me.validPayment()){
                    return
                }
                me.saving = true
                me.payment.customer_id = me.customer.id;
                me.payment.date = me.d;
                var url = 'payment/store';
                axios.post(url, me.payment)
                    .then(res =>{
                    me.dni=''
                    me.payment = {};
                    me.customer = { name:''};
                    Swal.fire({
                        position:'top-end',
                        icon: 'success',
                        title: res.data.message,
                        timer: 4000
                    });
                })
                .catch((error)=>{
                    console.log(error);
                })
                .finally(() => {
                    me.saving = false;
                })
            },
            validPayment(){
                let me=this;
                me.errP=0;
                me.errPl =[];

                if (!me.customer.id) me.errPl.push("por favor verifique sus datos");
                if (!me.payment.bank_id)me.errPl.push("Por favor Seleccione Banco.");
                if (!me.payment.num)me.errPl.push("Ingrese un numero de transacción.");
                if (!me.payment.amount)me.errPl.push("Por favor ingrese Monto.");
                if (!me.payment.type)me.errPl.push("Seleccione un metodo de Pago.");
                if (!me.d)me.errPl.push("Por favor Seleccione el mes a cancelar!");
                if (me.errPl.length) me.errP = 1;
                if (me.errPl.length >= 1) {
                    Swal.fire({
                        title:'Hey!! Nos falta(n) Datos',
                        icon: 'info',
                        confirmButtonText: 'Aceptar!',
                        confirmButtonColor: '#3085d6',
                        html: `${me.errPl.map( er =>`<br><span style="color:red;" class="mb-3"><i class="mdi mdi-minus-circle-outline mdi-spin mr-3"></i> ${er}</span>`)}`,
                        showCancelButton: false
                    });
                };
                return me.errP;
            },
            formattedDate() {
                var d = new Date
                var month = String(d.getMonth() + 1);
                var year = String(d.getFullYear());

                if (month.length < 2) month = '0' + month;

                this.d = `${year}-${month}`;

            }
        },
        mounted() {
            this.formattedDate();
        }
    }
</script>
