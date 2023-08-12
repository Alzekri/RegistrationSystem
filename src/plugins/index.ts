import { createPinia } from "pinia";
import router from "../router";
import type { App } from "vue";
import "bootstrap/dist/css/bootstrap.min.css";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { far } from "@fortawesome/free-regular-svg-icons";
import { fas } from "@fortawesome/free-solid-svg-icons";
library.add(far, fas);

const pinia = createPinia();
export function registerPlugins(app: App) {
  app.use(router).use(pinia);
  app.component("FIcons", FontAwesomeIcon);
}
