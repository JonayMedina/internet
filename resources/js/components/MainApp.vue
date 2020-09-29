<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
      app v-if="currentUser"
    >
      <v-list dense >
            <template  v-for="item in items">

                <v-row v-if="item.heading"
                    :key="item.heading"  align="center"
                >

                </v-row>
                <v-list-item v-else
                    :key="item.text" link
                    :to="{name:item.to}"

                >
                    <v-list-item-action>
                    <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>
                        {{ item.text }}
                    </v-list-item-title>
                    </v-list-item-content>

                </v-list-item>
            </template>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      app color="blue darken-3" dark
      v-if="currentUser != null"
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title
        style="width: 300px"
        class="ml-0 pl-4"
      >
        <span class="hidden-sm-and-down title-header" link :to="{name: 'home'}" v-text="appName"></span> <v-icon>mdi-cash</v-icon>
      </v-toolbar-title>
      <v-spacer />
      <!-- <v-btn icon>
        <v-icon>mdi-apps</v-icon>
      </v-btn> -->
      <!-- <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn> -->
      <v-tooltip bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="primary" fixed right
            dark v-bind="attrs"
            v-on="on" @click="logout"
          >

            <v-icon color="white darken-1"> mdi-exit-to-app</v-icon>
          </v-btn>
        </template>
        <span>Salir</span>
      </v-tooltip>
    </v-app-bar>
    <v-app-bar v-else :clipped-left="$vuetify.breakpoint.lgAndUp"
      app color="blue darken-3" dark
      >
      <router-link :to="{name: 'home'}">
          <span class="hidden-sm-and-down title-header" style="color:white" v-text="appName"></span> <v-icon>mdi-speedometer</v-icon>
      </router-link>

      <v-spacer />
        <v-btn
          color="primary" class="ma-2 white--text"
          :to="{name:'login'}"
        >Login

            <v-icon right dark> mdi-account-check</v-icon>
        </v-btn>
    </v-app-bar>
    <v-main grid-list-xs>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    name: 'main-app',
    props: {
      loading: Boolean,
      source: String,
    },
    data: () => ({
      appName: '',
      dialog: false,
      drawer: true,
      items: [
        { to: 'home', icon: 'mdi-home', text: 'Home', },
        { to: 'customers', icon: 'mdi-account-multiple', text: 'Clientes' },
        { to: 'plans', icon: 'mdi-floor-plan', text: 'Planes Creados' },
        // { to: 'contract', icon: 'mdi-bank', text: 'Contratos' },
        { to: 'banks', icon: 'mdi-bank', text: 'Bancos' },
        { to: 'charges', icon: 'mdi-wallet', text: 'Registro de Pagos' },
        { to: 'history-charge', icon: 'mdi-history', text: 'Historial de Pagos' },
      ],
    }),
    computed:{
      currentUser() {
           return this.$store.getters.currentUser
      },

    },
    methods:{
      logout(){
        this.$store.commit('logout');
        this.$router.push({name:'login'});
      },
      app(){
          this.appName = window.config.appName;
      },

    },
    mounted(){
        this.app();
        this.currentUser;
    }
  }
</script>
<style>
  .theme--light.v-application {
      background-image: linear-gradient(to right top, #fbfbfb, #c7c7c7, #959596, #666668, #3b3b3d, #312e38, #2a2030, #261126, #451032, #670533, #86002a, #9f0815);
  }
  .container{
    width: 95%;
  }
  .v-subheader {
    font-size: 1.875rem;
    font-weight: bold;
    color: white !important;
  }

  .v-navigation-drawer {
    box-shadow: 0 0px 14px 10px rgba(0,0,0,.3), 0 7px 5px 0 rgba(0,0,0,.14), 0 4px 33px 0 rgba(0,0,0,.12);
  }
  .flex.xs12 {
    box-shadow: 0 0px 5px 2px rgba(0,0,0,.3), 0 4px 9px 0 rgba(0,0,0,.14), 0 4px 23px 0 rgba(0,0,0,.12);
  }
  .title-header {
    font-weight: bolder;

  }
  .v-application .blue.darken-3 {
    background-color: #1b1b1d!important;
  }
  .theme--light.v-label--is-disabled, .theme--light.v-input--is-disabled, .theme--light.v-input--is-disabled input, .theme--light.v-input--is-disabled textarea {
      color: rgba(0,0,0,.67);
  }
  .v-toolbar__extension {
    padding: 0px !important;
  }

  .v-progress-linear {
    -moz-transform: scale(1, -1);
    -webkit-transform: scale(1, -1);
    -o-transform: scale(1, -1);
    -ms-transform: scale(1, -1);
    transform: scale(1, -1);
  }

  .v-card__subtitle, .v-card__text, .v-card__title {
        padding: 5px;
    }

    .v-data-table td, .v-data-table th {
        padding: 0px 10px;
    }

  .fixed {
        position: fixed;
    }

  .zindex-1{
        z-index: 1;
    }
</style>
