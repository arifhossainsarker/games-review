import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      alias: "/login",
      name: "login",
      component: () => import("./components/Login")
    },
    {
      path: "/sign-up",
      alias: "/sign-up",
      name: "SignUp",
      component: () => import("./components/SignUp")
    },
    {
      path: "/admin/games-list",
      alias: "/games-list",
      name: "GamesList",
      component: () => import("./components/GamesList")
    },
     {
      path: "/admin/add-games-list",
      alias: "/add-games-list",
      name: "AddGames",
      component: () => import("./components/AddGames")
    },
    {
      path: "/admin/comments-list",
      alias: "/comments-list",
      name: "CommentsList",
      component: () => import("./components/CommentsList")
    },
  ]
});
