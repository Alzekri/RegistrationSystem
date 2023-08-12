import {
  createRouter,
  createWebHistory,
  type RouteRecordRaw,
} from "vue-router";

const HomeView = () => import("../views/HomeView.vue");
const StudentsView = () => import("../views/StudentsView.vue");
const AdminsView = () => import("../views/AdminsView.vue");
const AboutView = () => import("../views/AboutView.vue");

const routes: RouteRecordRaw[] = [
  {
    path: "/",
    component: HomeView,
  },
  {
    path: "/student",
    component: StudentsView,
  },
  {
    path: "/admin",
    component: AdminsView,
  },
  {
    path: "/about",
    component: AboutView,
  },
];
export const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  scrollBehavior(to, from, savedPosition) {
    return {
      top: 0,
    };
  },
  routes,
});

export default router;
