
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
              v-model.trim="adminEmail"
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
              v-model.trim="adminPassword"
            />
            <label for="emaiql">
              <FIcons class="me-3" :icon="['fas', 'lock']" />PassWord</label
            >
          </div>
          <hr />
          <div
            class="alert alert-danger alert-dismissible alretdiv mx-5"
            v-if="hide"
          >
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              @click="hide = false"
            ></button>
            Email Or Password Incorrect
          </div>
          <div class="bb">
            <button
              class="px-5 btn btn-info"
              @click="loginAdmin(admins, 'student')"
            >
              Log in as manager
            </button>
          </div>

          <div class="bb">
            <button
              class="px-5 btn btn-info mt-3"
              @click="loginAdmin(superAdmins, 'admin')"
            >
              Log in as super admin
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  <script setup lang="ts">
import { storeToRefs } from "pinia";
import { useDataStore } from "@/store/students";
import { ref } from "vue";
import { useRouter } from "vue-router";

const { push } = useRouter();
let adminEmail: String;
let adminPassword: String;
let hide = ref(false);
const { fetchAdminsData, fetchSuperAdminsData } = useDataStore();
fetchAdminsData();
fetchSuperAdminsData();
const { admins, superAdmins } = storeToRefs(useDataStore());

function loginAdmin(adminsdata: any[], link: string) {
  let log = false;
  for (var i = 0; i < adminsdata.length; i++) {
    if (
      adminsdata[i]["email"] === adminEmail &&
      adminsdata[i]["password"] === adminPassword &&
      adminEmail != ""
    ) {
      push(`/${link}`);
      log = true;
      return;
    }
  }
  if (log == false) hide.value = true;
}
function loginSuperAdmin(): boolean {
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