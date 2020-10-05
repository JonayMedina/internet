
import Login from './components/Login.vue';
import Home from './components/Home';
import AdminHome from './components/admin/Home';
import Banks from './components/banks/Index';

import Charges from './components/charges/index';
import Plans from './components/plans/index';
import CreatePlan from './components/plans/create';
import CreateCharge from './components/charges/Create';
import HistoryCharge from './components/charges/History';

import Customers from './components/customers/index';

export const routes = [
    {
        path : '/administracion/login',
        name : 'login',
        component : Login,
    },
    {
        path : '/administracion/bancos',
        name : 'banks',
        component : Banks,
        meta:{
            requireAuth:true
          }
    },
    {
        path : '/administracion/planes',
        name : 'plans',
        component : Plans,
        meta:{
            requireAuth:true
          }
    },
    {
        path : '/administracion/planes/crear',
        name : 'create-plan',
        component : CreatePlan,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/administracion/clientes',
        name : 'customers',
        component : Customers,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/administracion/cobros',
        name : 'charges',
        component : Charges,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/administracion/cobros/crear',
        name : 'create-charge',
        component : CreateCharge,
        meta:{
            requireAuth:true
          }
    },
    {
        path : '/administracion/cobros/historial',
        name : 'history-charge',
        component : HistoryCharge,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/administracion/home',
        name : 'home',
        component : Home,
        meta:{
            requireAuth:true
        }
    },

];


