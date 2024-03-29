import App from "./App.vue";
import { createApp } from "vue";
import { registerPlugins } from "@/plugins";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { far } from "@fortawesome/free-regular-svg-icons";
import { fas } from "@fortawesome/free-solid-svg-icons";

library.add(far, fas);
const app = createApp(App);
registerPlugins(app);
app.mount("#app");
