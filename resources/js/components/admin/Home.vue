<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header"><h5>Bienvenid@</h5></div>
            <div class="card-body">
                <h5>Portal de genstion de Cobros</h5>
            </div>
            <div class="card-footer">
                <h3 class="" style="color: darkgoldenrod">Pagos</h3 >
            </div>
        </div>
        <!-- <v-card>
            <v-card-title primary-title>
                <div>
                    <h3 class="headline mb-0">head</h3>
                </div>
            </v-card-title>
            <v-card-actions>
                <v-btn color="primary">Text</v-btn>

            </v-card-actions>
        </v-card> -->
        <!-- <div class="about">
            <h2 v-for="(item, index) in currentUser" :key="index"> {{item}}</h2>
        </div> -->
    </div>

</template>
<script>
    import { mapState} from 'vuex';
    export default {
        data() {
            return{
                user:{},
                name: '',
                email: '',
            }
        },
        computed:{
          currentUser() {
                return this.$store.getters.currentUser
            },
        },
        methods: {
            getUser(){
                let me = this;
                axios
                    .get('/api/auth/me')
                    .then(response => {
                        me.user = response.data;
                });
            }
        },
        mounted() {
            if(localStorage.user) this.user = JSON.parse(localStorage.user);
            // this.getPrices();
            this.getUser();
        },

    }
</script>
