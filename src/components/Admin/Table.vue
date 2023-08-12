
<template>
  <!--Table-->
  <div class="px-3">
    <h6>Admin List( {{ admins.length }} )</h6>
    <table class="table table-striped table-dark">
      <!--  <table class="table table-striped ">-->
      <thead class="bg-success text-light">
        <tr class="text-start">
          <th><FIcons class="pe-3" :icon="['fas', 'id-badge']" />ID</th>
          <th><FIcons class="pe-3" :icon="['fas', 'user']" />Name</th>
          <th><FIcons class="pe-3" :icon="['fas', 'phone']" />Phone</th>
          <th><FIcons class="pe-3" :icon="['fas', 'envelope']" />Email</th>
          <th><FIcons class="pe-3" :icon="['fas', 'lock']" />Password</th>
          <th><FIcons class="pe-3" :icon="['fas', 'user-gear']" />Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-start" v-for="(admin, index) in admins" :key="index">
          <td>{{ index + 1 }}</td>
          <td>{{ admin["name"] }}</td>
          <td>{{ admin["phone"] }}</td>
          <td>{{ admin["email"] }}</td>
          <td>{{ admin["password"] }}</td>

          <td>
            <button
              class="btn btn-warning"
              @click="
                update = true;
                selectAdmin(admin);
              "
            >
              <FIcons :icon="['fas', 'user-edit']" />
            </button>
            <button
              class="btn btn-danger m-sm-0 m-md-2"
              @click="
                deleted = true;
                selectAdmin(admin);
              "
            >
              <FIcons :icon="['fas', 'user-times']" />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!--Update-->
  <div class="modal-dialog addnew p-2" v-if="update">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header justify-content-between">
        <h4 class="modal-title text-warning">Update Admin</h4>
        <button
          type="button"
          class="btn-close"
          @click="update = false"
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
              v-model.trim="currentAdmin.name"
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
              v-model.trim="currentAdmin.email"
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
              v-model.trim="currentAdmin.phone"
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
              placeholder=" Phone"
              name="password"
              v-model.trim="currentAdmin.password"
            />
            <label for="emaiql">
              <FIcons :icon="['fas', 'phone']" />Password</label
            >
          </div>

          <hr />
          <div class="d-grid">
            <button class="btn btn-warning" @click="updateAdmin()">
              Update Admin
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--Delete One-->
  <div class="modal-dialog addnew p-2" v-if="deleted">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header justify-content-between">
        <h4 class="modal-title text-danger">Delete Current Admin</h4>
        <button
          type="button"
          class="btn-close"
          style="margin-left: 42%"
          @click="deleted = false"
        ></button>
        <hr />
      </div>

      <!-- Modal body -->
      <div class="modal-body text-center">
        <form action="#" method="post" @click.prevent>
          <hr />

          <h6 class="text-danger">Are You Sure ?</h6>
          <p>
            <span>ID:- {{ currentAdmin.id }}</span
            ><br />

            <span>Email:- {{ currentAdmin.email }}</span
            ><br />
            <span>Name:- {{ currentAdmin.name }}</span
            ><br />
            <span>Phone:- {{ currentAdmin.phone }}</span
            ><br />
            <span>Password:- {{ currentAdmin.password }}</span
            ><br />
          </p>
          <div class="d-grid m-2">
            <button class="btn btn-danger" @click="deleteAdmin()">
              Yes, sure...
            </button>
          </div>
          <div class="d-grid m-2">
            <button class="btn btn-success" @click="deleted = false">
              No...
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
let update = ref(false);
let deleted = ref(false);
const { fetchAdminsData } = useDataStore();
fetchAdminsData();
const { admins } = storeToRefs(useDataStore());
let currentAdmin: {
  id: String;
  email: String;
  password: String;
  name: String;
  phone: String;
};
function selectAdmin(obj: any) {
  currentAdmin = obj;
}

function toFormData(obj: any) {
  var fd = new FormData();
  for (var i in obj) {
    fd.append(i, obj[i]);
  }
  return fd;
}
async function updateAdmin() {
  let formUpdateAdminData = toFormData(currentAdmin);
  const { updateAdmin } = useDataStore();
  await updateAdmin(formUpdateAdminData);
  fetchAdminsData();
  update.value = false;
}
async function deleteAdmin() {
  let formdeleteAdminData = toFormData(currentAdmin);

  const { deleteAdmin } = useDataStore();
  await deleteAdmin(formdeleteAdminData);
  fetchAdminsData();

  deleted.value = false;
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