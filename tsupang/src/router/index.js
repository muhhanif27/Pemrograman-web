import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    { path: '/ikan', name: 'ikan.index', component: () => import('../views/ikan/index.vue') },
    { path: '/ikan/create', name: 'ikan.create', component: () => import('../views/ikan/create.vue') },
    { path: '/ikan/edit/:id', name: 'ikan.edit', component: () => import('../views/ikan/edit.vue') },
    { path: '/aquarium', name: 'aquarium.index', component: () => import('../views/aquarium/index.vue') },
    { path: '/aquarium/create', name: 'aquarium.create', component: () => import('../views/aquarium/create.vue') },
    { path: '/aquarium/edit/:id', name: 'aquarium.edit', component: () => import('../views/aquarium/edit.vue') },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
