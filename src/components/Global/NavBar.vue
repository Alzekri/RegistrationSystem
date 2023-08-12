
<template>
  <!-- NavBar -->
  <div class="row text-center pt-3 d1">
    <h1 class="col-8 text-end">ADMIN DASHBOARD</h1>
    <div class="col-4 text-end pe-5">
      <div class="bb">
        <button class="btn btn-info" @click="logout()">Log out</button>
      </div>
    </div>
  </div>
</template>
    <script setup lang="ts">
import { useRouter } from "vue-router";
const { push } = useRouter();

function logout() {
  push("/");
}
</script>
    <style scoped lang="scss">
.d1 {
  background-color: rgb(59, 81, 81);
  color: white;
  height: 13vh;
}
</style>