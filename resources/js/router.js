const Home = () => import('./pages/Home');
const Login = () => import('./pages/Login');
const Register = () => import('./pages/Register');
const Dashboard = () => import('./pages/Dashboard');
const Invoices = () => import('./pages/Invoice');
const InvoiceDetails = () => import('./pages/InvoiceDetail');
const Purchases = () => import('./pages/Purchases');
const Pricing = () => import('./pages/Pricing');
const Forget = () => import('./pages/Forget');
const TestPayment = () => import('./pages/TestPayment');
const PageNotFound = () => import('./pages/PageNotFound');
const AddBilling = () => import('./pages/AddBilling');
const RecoverPassword = () => import('./pages/RecoverPassword');

import auth from './middleware/auth';


let home;
if(localStorage.getItem('token')){
    home = {
        name: 'dashboard',
        path: '/',
        component: Dashboard,
        meta: {
            middleware: auth,
          },
    }
} else {
    home = {
        name: 'login',
        path: '/',
        component: Login,
    }
}

export const routes = [
    home,
    {
        name: 'register',
        path: '/register',
        component: Register,
    },
    {
        name: 'invoices',
        path: '/invoices',
        component: Invoices,
        meta: {
            middleware: auth,
          },
    },
    {
        name: 'invoice-details',
        path: '/invoice-details',
        component: InvoiceDetails,
        meta: {
            middleware: auth,
          },
    },
    {
        name: 'pricing',
        path: '/pricing',
        component: Pricing,
        meta: {
            middleware: auth,
          },
    },
    {
        name: 'purchases',
        path: '/purchases',
        component: Purchases,
        meta: {
            middleware: auth,
          },
    },
    {
        name: 'forget',
        path: '/forget-password',
        component: Forget,
    },
    {
        name: 'test-payment',
        path: '/test-payment',
        component: TestPayment,
    },
    {
        name: 'pagenotfound',
        path: '/:pathMatch(.*)*',
        component: PageNotFound,
    },
    {
        name: 'recover-password',
        path: '/recoveryPassword/:token',
        component: RecoverPassword,
    },
    {
        name: 'add-billing',
        path: '/add-billing',
        component: AddBilling,
        meta: {
            middleware: auth,
          },
    },
]
