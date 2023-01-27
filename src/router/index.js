import { createRouter, createWebHistory } from 'vue-router'
import MainLayout from '../layouts/MainLayout.vue'
import HomeView from '../views/HomeView.vue'
import LoginView from "../views/LoginView.vue"

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
    {
      path: '',
      name: 'home',
      component: HomeView
    },
    {
      path: 'about',
      name: 'about',
      component: function () {
        return import('../views/AboutView.vue')
      }
    },
    {
      path: 'user',
      name: 'user',
      component: function () {
        return import('../views/UserView.vue')
      }
    }
    ]
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
