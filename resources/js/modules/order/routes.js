export default [{
  path: '/order',
  component: () => import('./module.vue'),
  children: [
    { path: '/', component: () => import('./pages/list/index.vue') },
    { props: true, path: 'create', component: () => import('./pages/editing/index.vue') },
    { props: true, path: 'edit/:id', component: () => import('./pages/editing/index.vue') }
  ],
}]