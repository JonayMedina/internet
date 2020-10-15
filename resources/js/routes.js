
import Login from './components/Login.vue';
import Home from './components/Home';
import AdminHome from './components/admin/Home';
import Banks from './components/banks/Index';

import Charges from './components/charges/Index';
import Plans from './components/plans/Index';
import CreatePlan from './components/plans/Create';
import CreateCharge from './components/charges/Create';
import HistoryCharge from './components/charges/History';

import Customers from './components/customers/Index';

export const routes = [
    {
        path : '/admincnet/login',
        name : 'login',
        component : Login,
    },
    {
        path : '/admincnet/bancos',
        name : 'banks',
        component : Banks,
        meta:{
            requireAuth:true
          }
    },
    {
        path : '/admincnet/planes',
        name : 'plans',
        component : Plans,
        meta:{
            requireAuth:true
          }
    },
    {
        path : '/admincnet/planes/crear',
        name : 'create-plan',
        component : CreatePlan,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/admincnet/clientes',
        name : 'customers',
        component : Customers,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/admincnet/cobros',
        name : 'charges',
        component : Charges,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/admincnet/cobros/crear',
        name : 'create-charge',
        component : CreateCharge,
        meta:{
            requireAuth:true
          }
    },
    {
        path : '/admincnet/cobros/historial',
        name : 'history-charge',
        component : HistoryCharge,
        meta:{
            requireAuth:true
        }
    },
    {
        path : '/admincnet/home',
        name : 'home',
        component : Home,
        meta:{
            requireAuth:true
        }
    },

];


