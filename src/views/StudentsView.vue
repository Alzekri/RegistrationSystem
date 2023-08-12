
<template>
  <div class="addnew modal-dialog">
    <div class="modal-content content">
      <!-- Modal Header -->
      <h4 class="text-center text-info">LOG IN</h4>
      <hr />
      <!-- Modal body -->
      <div class="modal-body">
        <form action="#" method="post" @click.prevent>
          <div class="form-floating m-2">
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder=" email"
              name="email"
              v-model.trim="adminemail"
            />
            <label for="email">
              <FIcons class="me-3" :icon="['fas', 'envelope']" />Email</label
            >
          </div>
          <div class="form-floating m-2 mt-4">
            <input
              type="password"
              class="form-control"
              id="tel"
              placeholder=" password"
              name="tel"
              v-model.trim="adminPass"
            />
            <label for="emaiql">
              <FIcons class="me-3" :icon="['fas', 'lock']" />PassWord</label
            >
          </div>
          <hr />
          <div class="w-100 bb">
            <button class="px-5 btn btn-info" @click="LoginInsuper()">
              Log in as super admin
            </button>
          </div>

          <div class="w-100 bb">
            <button class="px-5 btn btn-info mt-3" @click="LoginIn()">
              Log in as manager
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  <script setup lang="ts">
let adminemail: string;
let adminPass: string;
function LoginIn(): boolean {
  return true;
}
function LoginInsuper(): boolean {
  return true;
}
</script>
  <style scoped lang="scss">
.addnew {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.content {
  padding: 2em;
  background-color: rgb(199, 199, 188);
  border-radius: 1%;
  width: 40%;
  //tablet
  @media only screen and (max-width: 992px) {
    width: 70%;
  }
}
.bb {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>