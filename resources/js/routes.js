
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
    },
    {
        path : '/administracion/planes',
        name : 'plans',
        component : Plans,
    },
    {
        path : '/administracion/planes/crear',
        name : 'create-plan',
        component : CreatePlan,
    },
    {
        path : '/administracion/clientes',
        name : 'customers',
        component : Customers,
    },
    {
        path : '/administracion/cobros',
        name : 'charges',
        component : Charges,
    },
    {
        path : '/administracion/cobros/crear',
        name : 'create-charge',
        component : CreateCharge,
    },
    {
        path : '/administracion/cobros/historial',
        name : 'history-charge',
        component : HistoryCharge,
    },
    {
        path : '/administracion/home',
        name : 'home',
        component : Home,
    },

];


