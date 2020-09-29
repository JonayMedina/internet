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
                    <!-- <v-btn color="primary">Text</v-btn> -->

                </v-card-actions>
            </v-card>
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
            }
        },
        computed:{
        },
        methods: {
        },
        mounted() {
            if(localStorage.user) this.user = JSON.parse(localStorage.user);

        },

    }
</script>
