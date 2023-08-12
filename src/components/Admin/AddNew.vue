
<template>
  <!--Button Add new-->
  <div class="text-center mt-3">
    <button class="px-3 btn btn-info" @click="addnew = true">
      <FIcons class="icon me-4" :icon="['fas', 'user']" />Add New Admin
    </button>
  </div>
  <hr />
  <!-- Model Add New  -->
  <div class="modal-dialog addnew p-2" v-if="addnew">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header justify-content-between">
        <h4 class="modal-title text-info">Add New Admin</h4>
        <button
          type="button"
          class="btn-close"
          @click.prevent="addnew = false"
        ></button>
        <hr />
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="#" method="post" @click.prevent>
          <div class="form-floating m-2">
            <input
              type="text"
              class="form-control"
              id="name"
              placeholder="Name"
              name="name"
              v-model.trim="addnewadmin.name"
            />

            <label for="name"> <FIcons :icon="['fas', 'user']" />Name</label>
          </div>
          <div class="form-floating m-2">
            <input
              type="email"
              class="form-control"
              id="email"
              placeholder=" email"
              name="email"
              v-model.trim="addnewadmin.email"
            />
            <label for="email">
              <FIcons :icon="['fas', 'envelope']" />Email</label
            >
          </div>
          <div class="form-floating m-2">
            <input
              type="tel"
              class="form-control"
              id="tel"
              placeholder=" Phone"
              name="tel"
              v-model.trim="addnewadmin.phone"
            />
            <label for="emaiql">
              <FIcons :icon="['fas', 'phone']" />Phone</label
            >
          </div>

          <div class="form-floating m-2">
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder=" password"
              name="password"
              v-model.trim="addnewadmin.password"
            />
            <label for="emaiql">
              <FIcons :icon="['fas', 'lock']" />password</label
            >
          </div>

          <hr />
          <div class="d-grid">
            <button class="btn btn-info" @click="AddNewAdmin()">
              Add New Admin
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
    <script setup lang="ts">
import { useDataStore } from "@/store/students";
import { ref } from "vue";

const { fetchAdminsData } = useDataStore();

let addnew = ref(false);
let addnewadmin = {
  name: "",
  email: "",
  phone: "",
  password: "",
};

function toFormData(obj: any) {
  var fd = new FormData();
  for (var i in obj) {
    fd.append(i, obj[i]);
  }
  return fd;
}
// add new Admin
async function AddNewAdmin() {
  let formCreateAdminData = toFormData(addnewadmin);
  const { createAdmin } = useDataStore();
  await createAdmin(formCreateAdminData);
  fetchAdminsData();
  addnew.value = false;
}
</script>
    <style scoped lang="scss">
.addnew {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  width: 30vw;
  background-color: rgb(241, 241, 233);
  //tablet
  @media only screen and (max-width: 992px) {
    width: 70vw;
    margin: auto;
  }
}
</style>