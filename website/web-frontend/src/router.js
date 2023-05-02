import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      alias: "/home",
      name: "Home",
      component: () => import("./components/Home")
    },
    {
      path: "/games-review",
      alias: "/games-review",
      name: "GamesReview",
      component: () => import("./components/GamesReview")
    },
    
  ]
});
