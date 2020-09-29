<template>
  <v-app id="inspire">
        <v-row
          align="center"
          justify="center"
        >
          <v-col cols="12" sm="6" md="8">
            <v-card class="elevation-12">
              <v-toolbar
                color="primary" dark
              >
                <v-toolbar-title>Iniciar sesion</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <form submit.prevent="authenticate">
                  <v-text-field v-model="form.email"
                    label="Ingrese Email" name="email"
                    prepend-icon="person" type="email"
                  />

                  <v-text-field  v-model="form.password"
                    id="password" label="Password"
                    name="password" prepend-icon="lock"
                    type="password"
                  />
                </form>
                <span style="color:red;" v-show="error" v-text="error"></span>
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn :loading="loader" @click="authenticate()" color="primary">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
  </v-app>
</template>

<script>
  import {login} from '../helpers/auth.js';

  export default {
    props: {
      source: String,
    },
    data:()=> ({
      drawer: null,
      loader:false,
      error: '',
      form: new Form({
        email: '',
        password: '',
      })
    }),
    computed:{
    },
    methods: {
      authenticate(){
        let me  = this;
        me.loader = true;
        me.$store.dispatch("login");
        login(me.$data.form)
        .then((res)=>{
          me.$store.commit('loginSuccess',res);
          me.$router.push({name: 'home'})
        })
        .catch((rej)=>{
          me.error = rej.error;
        })
        me.loader = false
      }
    }
  }
</script>
