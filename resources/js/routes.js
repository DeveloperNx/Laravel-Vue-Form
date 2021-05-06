import UserList from './components/UserList.vue';
import RegistrationForm from './components/RegistrationForm.vue';
 
export const routes = [
    // {
    //     path: '/',
    //     name: 'DataTableComponent',
    //     component: () => import( "./components/DataTableComponent.vue") ,
    // },
    {
        path: '/',
        name: 'UserList',
        component: () => import( "./components/UserList.vue") ,
    },
    {
        path: '/registration',
        name: 'RegistrationForm',
        component: () => import( "./components/RegistrationForm.vue") ,
    },
    {
        name: 'EditUserData',
        path: '/edit/:id',
        component: () => import( "./components/EditUserData.vue") ,
    }
];
