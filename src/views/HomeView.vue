<template>
  <!--Title-->
  <div class="modal-dialog addnew p-2" style="margin-top: 10%" v-if="logginn">
    <div class="modal-content">
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
              <FIcons :icon="['fas', 'envelope']" />Email</label
            >
          </div>
          <div class="form-floating m-2">
            <input
              type="password"
              class="form-control"
              id="tel"
              placeholder=" password"
              name="tel"
              v-model.trim="adminPass"
            />
            <label for="emaiql">
              <FIcons :icon="['fas', 'lock']" />PassWord</label
            >
          </div>
          <hr />
          <div class="d-grid">
            <button
              class="btn btn-info"
              @click="
                getStudents();
                LoginInsuper();
              "
            >
              Log in as super admin
            </button>
          </div>

          <div class="d-grid">
            <button
              class="btn btn-info mt-3"
              @click="
                getStudents();
                LoginIn();
              "
            >
              Log in as manager
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Admin-->
  <div v-if="!logginn && user == 'super'">
    <div class="text-center d1">
      <h1 class="">ADMIN DASHBOARD</h1>
      <button
        class="btn btn-success"
        style="margin-left: 90%; margin-top: -7%"
        @click="logginn = !loggin"
      >
        Log Out
      </button>
    </div>
    <!--Button Add new-->
    <div class="container">
      <div class="row d-flex justify-content-between">
        <button class="btn btn-info col-2" @click="addnew = true">
          <FIcons class="icon" :icon="['fas', 'user']" />Add New Admin
        </button>
      </div>
    </div>
    <hr />

    <!--Table-->

    <div class="container">
      <caption class="row">
        Admin List({{
          students_data.length
        }})
      </caption>

      <table class="table table-striped table-dark">
        <!--  <table class="table table-striped ">-->
        <thead class="bg-success text-light">
          <tr class="text-center">
            <th><FIcons :icon="['fas', 'id-badge']" />ID</th>
            <th><FIcons :icon="['fas', 'user']" />Name</th>
            <th><FIcons :icon="['fas', 'phone']" />Phone</th>
            <th><FIcons :icon="['fas', 'envelope']" />Email</th>
            <th><FIcons :icon="['fas', 'lock']" />Password</th>
            <th><FIcons :icon="['fas', 'user-gear']" />Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center" v-for="(ad, index) in adminData" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ ad.name }}</td>
            <td>{{ ad.phone }}</td>
            <td>{{ ad.email }}</td>
            <td>{{ ad.password }}</td>

            <td>
              <button
                class="btn btn-warning"
                @click="
                  update = true;
                  selectAdmin(ad);
                "
              >
                <FIcons :icon="['fas', 'user-edit']" />Update
              </button>
              <button
                class="btn btn-danger"
                style="margin-left: 10px"
                @click="
                  deleted = true;
                  selectAdmin(ad);
                "
              >
                <FIcons :icon="['fas', 'user-times']" />Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!--Add New Student-->
    <!-- The Modal -->

    <div class="modal-dialog addnew p-2" v-if="addnew">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header justify-content-between">
          <h4 class="modal-title text-info">Add New Admin</h4>
          <button
            type="button"
            class="btn-close"
            style="margin-left: 54%"
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

    <!--Update-->

    <div class="modal-dialog addnew p-2" v-if="update">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header justify-content-between">
          <h4 class="modal-title text-warning">Update Admin</h4>
          <button
            type="button"
            class="btn-close"
            style="margin-left: 54%"
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
                v-model.trim="currentadmin.name"
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
                v-model.trim="currentadmin.email"
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
                v-model.trim="currentadmin.phone"
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
                v-model.trim="currentadmin.password"
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
              <span>ID:- {{ currentadmin.id }}</span
              ><br />

              <span>Email:- {{ currentadmin.email }}</span
              ><br />
              <span>Name:- {{ currentadmin.name }}</span
              ><br />
              <span>Phone:- {{ currentadmin.phone }}</span
              ><br />
              <span>Password:- {{ currentadmin.password }}</span
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

    <!--Title-->
  </div>
  <!--Student-->
  <div v-if="!logginn && user == 'manager'">
    <div class="text-center d1">
      <h1 class="">Students Rigestration</h1>
      <button
        class="btn btn-success"
        style="margin-left: 90%; margin-top: -7%"
        @click="logginn = !loggin"
      >
        Log Out
      </button>
    </div>
    <!--Button and Filtering-->
    <div class="container">
      <div class="row d-flex justify-content-between">
        <button
          class="btn btn-danger col-2"
          v-if="students_data.length"
          @click="deleteAll = true"
        >
          <FIcons class="icon" :icon="['fas', 'user']" />Delete All Students
        </button>
        <div class="dropdown col-2 divdrdropdown">
          <button
            type="button"
            class="btn btn-primary dropdown-toggle"
            data-bs-toggle="dropdown"
          >
            {{ Dropdown_Major }}
          </button>
          <ul class="dropdown-menu">
            <li
              v-for="(major, index) in Majors"
              :key="index"
              @click="slected_major(major)"
            >
              <a class="dropdown-item" href="#">{{ major }}</a>
            </li>
          </ul>
        </div>
        <div class="dropdown col-2 divdrdropdown">
          <button
            type="button"
            class="btn btn-primary dropdown-toggle"
            data-bs-toggle="dropdown"
          >
            {{ Dropdown_Semester }}
          </button>
          <ul class="dropdown-menu">
            <li
              v-for="(semester, index) in Semesters"
              :key="index"
              @click="
                slected_semester(semester);
                intailization_filtering();
                // filltter();
              "
            >
              <a class="dropdown-item" href="#">{{ semester }}</a>
            </li>
          </ul>
        </div>
        <button class="btn btn-info col-2" @click="addnew = true">
          <FIcons class="icon" :icon="['fas', 'user']" />Add New Student
        </button>
      </div>
    </div>
    <hr />
    <!--Success Message-->
    <div
      class="alert alert-success alert-dismissible alretdiv"
      v-if="success_message"
    >
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      Successs
    </div>
    <!-- Error Messege-->

    <div
      class="alert alert-danger alert-dismissible alretdiv"
      v-if="error_mssage"
    >
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      Deleted All
    </div>
    <!--Table-->

    <div class="container">
      <caption class="row">
        Students List({{
          students_data.length
        }})
      </caption>

      <table class="table table-striped table-dark">
        <!--  <table class="table table-striped ">-->
        <thead class="bg-success text-light">
          <tr class="text-center">
            <th><FIcons :icon="['fas', 'id-badge']" />ID</th>
            <th><FIcons :icon="['fas', 'user']" />Name</th>
            <th><FIcons :icon="['fas', 'hashtag']" />UniversityID</th>
            <th><FIcons :icon="['fas', 'building-columns']" />Major</th>
            <th><FIcons :icon="['fas', 'hashtag']" />Semester</th>
            <th><FIcons :icon="['fas', 'phone']" />Phone</th>
            <th><FIcons :icon="['fas', 'envelope']" />Email</th>
            <th><FIcons :icon="['fas', 'user-gear']" />Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="text-center"
            v-for="(st, index) in students_data"
            :key="index"
          >
            <td>{{ index + 1 }}</td>
            <td>{{ st.name }}</td>
            <td>{{ st.universityId }}</td>
            <td>{{ st.major }}</td>
            <td>{{ st.semester }}</td>
            <td>{{ st.phone }}</td>
            <td>{{ st.email }}</td>
            <td>
              <button
                class="btn btn-warning"
                @click="
                  update = true;
                  selectStudent(st);
                "
              >
                <FIcons :icon="['fas', 'user-edit']" />Update
              </button>
              <button
                class="btn btn-danger"
                style="margin-left: 10px"
                @click="
                  deleted = true;
                  selectStudent(st);
                "
              >
                <FIcons :icon="['fas', 'user-times']" />Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!--Add New Student-->
    <!-- The Modal -->

    <div class="modal-dialog addnew p-2" v-if="addnew">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header justify-content-between">
          <h4 class="modal-title text-info">Add New Student</h4>
          <button
            type="button"
            class="btn-close"
            style="margin-left: 54%"
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
                v-model.trim="addnewstudent.name"
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
                v-model.trim="addnewstudent.email"
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
                v-model.trim="addnewstudent.phone"
              />
              <label for="emaiql">
                <FIcons :icon="['fas', 'phone']" />Phone</label
              >
            </div>
            <div class="form-floating" style="margin-left: 36%">
              <div class="dropdown divdrdropdown">
                <button
                  type="button"
                  class="btn btn-primary dropdown-toggle"
                  data-bs-toggle="dropdown"
                >
                  {{ Dropdown_Majordb }}
                </button>
                <ul class="dropdown-menu">
                  <li
                    v-for="(major, index) in Majorsdb"
                    :key="index"
                    @click="slected_majordb(major)"
                  >
                    <a class="dropdown-item" href="#">{{ major }}</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="form-floating" style="margin-left: 34%; margin-top: 1%">
              <div class="dropdown divdrdropdown">
                <button
                  type="button"
                  class="btn btn-primary dropdown-toggle"
                  data-bs-toggle="dropdown"
                >
                  {{ Dropdown_Semesterdb }}
                </button>
                <ul class="dropdown-menu">
                  <li
                    v-for="(semester, index) in Semestersdb"
                    :key="index"
                    @click="slected_semesterdb(semester)"
                  >
                    <a class="dropdown-item" href="#">{{ semester }}</a>
                  </li>
                </ul>
              </div>
            </div>
            <hr />
            <div class="d-grid">
              <button class="btn btn-info" @click="AddNewStudent()">
                Add New Student
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--Update-->

    <div class="modal-dialog addnew p-2" v-if="update">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header justify-content-between">
          <h4 class="modal-title text-warning">Update Student</h4>
          <button
            type="button"
            class="btn-close"
            style="margin-left: 54%"
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
                v-model.trim="currentstudent.name"
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
                v-model.trim="currentstudent.email"
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
                v-model.trim="currentstudent.phone"
              />
              <label for="emaiql">
                <FIcons :icon="['fas', 'phone']" />Phone</label
              >
            </div>
            <div class="form-floating" style="margin-left: 36%">
              <div class="dropdown divdrdropdown">
                <button
                  type="button"
                  class="btn btn-primary dropdown-toggle"
                  data-bs-toggle="dropdown"
                >
                  {{ Dropdown_Majordb }}
                </button>
                <ul class="dropdown-menu">
                  <li
                    v-for="(major, index) in Majorsdb"
                    :key="index"
                    @click="slected_majordb(major)"
                  >
                    <a class="dropdown-item" href="#">{{ major }}</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="form-floating" style="margin-left: 34%; margin-top: 1%">
              <div class="dropdown divdrdropdown">
                <button
                  type="button"
                  class="btn btn-primary dropdown-toggle"
                  data-bs-toggle="dropdown"
                >
                  {{ Dropdown_Semesterdb }}
                </button>
                <ul class="dropdown-menu">
                  <li
                    v-for="(semester, index) in Semestersdb"
                    :key="index"
                    @click="slected_semesterdb(semester)"
                  >
                    <a class="dropdown-item" href="#">{{ semester }}</a>
                  </li>
                </ul>
              </div>
            </div>
            <hr />
            <div class="d-grid">
              <button class="btn btn-warning" @click="updateStudent()">
                Update Student
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
          <h4 class="modal-title text-danger">Delete Current Student</h4>
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
              <span>universityId:{{ currentstudent.universityId }}</span
              ><br />
              <span>{{ currentstudent.name }}</span
              ><br />
              <span>{{ currentstudent.major }}</span
              ><br />
              <span>semester:{{ currentstudent.semester }}</span
              ><br />
            </p>
            <div class="d-grid m-2">
              <button class="btn btn-danger" @click="deleteStudent()">
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

    <!--Delete All Students-->
    <div class="modal-dialog addnew p-2" v-if="deleteAll">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header justify-content-between">
          <h4 class="modal-title text-danger">Delete All Students</h4>
          <button
            type="button"
            class="btn-close"
            style="margin-left: 42%"
            @click="deleteAll = false"
          ></button>
          <hr />
        </div>

        <!-- Modal body -->
        <div class="modal-body text-center">
          <form action="#" method="post" @click.prevent>
            <hr />
            <h6 class="text-danger">Are You Sure ?</h6>
            <div class="d-grid m-2">
              <button class="btn btn-danger" @click="delete_All()">
                Yes, sure...
              </button>
            </div>
            <div class="d-grid m-2">
              <button class="btn btn-success" @click="deleteAll = false">
                No...
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Title-->
  </div>
</template>


<script>
//Validation
import axios from "axios";
export default {
  name: "HomeView",
  data() {
    return {
      //Validate
      user: "",
      update: false,
      addnew: false,
      deleted: false,
      deleteAll: false,
      adminemail: "",
      adminPass: "",
      logginn: true,
      adminData: [],
      superadminData: [],
      Dropdown_Major: "Select     Major",
      Dropdown_Semester: "Select Semester",
      Dropdown_Majordb: "Select     Major",
      Dropdown_Semesterdb: "Select Semester",
      error_mssage: "",
      success_message: "",
      students_data: [],
      addnewstudent: {
        name: "",
        email: "",
        phone: "",
        major: "",
        semester: "",
      },
      addnewadmin: {
        name: "",
        email: "",
        phone: "",
        password: "",
      },
      currentstudent: {},
      currentadmin: {},

      Majors: [
        "InformationTechnology",
        "InformationSystems",
        "Software",
        "Networks",
        "ComputerSciences",
      ],
      Semesters: [1, 2, 3, 4, 5, 6, 7, 8],
      Majorsdb: [
        "InformationTechnology",
        "InformationSystems",
        "Software",
        "Networks",
        "ComputerSciences",
      ],
      Semestersdb: [1, 2, 3, 4, 5, 6, 7, 8],
    };
  },

  //when do auto refresh for page
  mounted() {
    this.getStudents();
  },

  methods: {
    //for filtering
    slected_major(m) {
      this.Dropdown_Major = m;
    },
    slected_semester(m) {
      this.Dropdown_Semester = m;
    },
    //for add new student
    slected_majordb(m) {
      this.Dropdown_Majordb = m;
      this.currentstudent.major = m;
      this.addnewstudent.major = m;
    },
    slected_semesterdb(m) {
      this.Dropdown_Semesterdb = m;
      this.currentstudent.semester = m;
      this.addnewstudent.semester = m;
    },
    // add new student
    async AddNewStudent() {
      let formData = this.toFormData(this.addnewstudent);
      let resualts = await axios.post(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=create`,
        formData
      );
      const resualtData = resualts.data;
      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.success_message = "Success";
          this.addnewstudent = {};
          this.getStudents();
        }
      }
    },
    // add new Admin
    async AddNewAdmin() {
      let formData = this.toFormData(this.addnewadmin);
      let resualts = await axios.post(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=createadmin`,
        formData
      );
      const resualtData = resualts.data;
      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.success_message = "Success";
          this.addnewadmin = {};
          this.getStudents();
        }
      }
    },
    // validate for update //Update
    toFormDataUpdate(obj) {
      var fu = new FormData();
      for (var i in obj) {
        console.log(i + "=" + obj[i]);
        fu.append(i, obj[i]);
      }

      return fu;
    },
    //updateStudent
    async updateStudent() {
      let formData = this.toFormData(this.currentstudent);
      let resualts = await axios.post(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=update`,
        formData
      );
      const resualtData = resualts.data;
      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.update = false;
          this.currentstudent = {};
          this.getStudents();
        }
      }
      console.log(this.students_data);
    },

    //updateAdmin
    async updateAdmin() {
      let formData = this.toFormData(this.currentadmin);
      let resualts = await axios.post(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=updateadmin`,
        formData
      );
      const resualtData = resualts.data;
      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.update = false;
          this.currentadmin = {};
          this.getStudents();
        }
      }
    },
    // for show students(read)
    async getStudents() {
      let resualts = await axios.get(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=read`
      );
      const resualtData = resualts.data;

      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.students_data = resualtData.students;
          this.adminData = resualtData.admins;
          this.superadminData = resualtData.superadmin;
        }
      }
    },
    async intailization_filtering() {
      let resualts = await axios.get(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=read`
      );
      const resualtData = resualts.data;

      if (resualts.status == 200) {
        this.students_data = resualtData.students;
      }
      return (this.students_data = this.students_data.filter(
        (el) =>
          el.semester == this.Dropdown_Semester &&
          el.major == this.Dropdown_Major
      ));
    },
    //deleteAll
    async delete_All() {
      let resualts = await axios.get(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=deleteAll`
      );
      const resualtData = resualts.data;
      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.deleteAll = false;
          this.students_data = [];
          this.clearMess;
        }
      }
    },
    //clear Message
    clearMess() {
      this.error_mssage = "";
      this.success_message = "";
    },
    //Delete One Student
    //form data Delete
    toFormData(obj) {
      var fd = new FormData();
      for (var i in obj) {
        console.log(i + "=" + obj[i]);
        fd.append(i, obj[i]);
      }
      return fd;
    },

    async deleteStudent() {
      let formData = this.toFormData(this.currentstudent);
      let resualts = await axios.post(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=delete`,
        formData
      );
      const resualtData = resualts.data;
      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.deleted = false;
          this.currentstudent = [];
          this.getStudents();
        }
      }
    },
    async deleteAdmin() {
      let formData = this.toFormData(this.currentadmin);
      let resualts = await axios.post(
        `http://localhost/projects/vueandphp/registrationsystem/src/api/student.php?action=deleteadmin`,
        formData
      );
      const resualtData = resualts.data;
      if (resualts.status == 200) {
        if (resualtData.error) {
          this.error_mssage = resualtData.errormessage;
        } else {
          this.deleted = false;
          this.currentadmin = [];
          this.getStudents();
        }
      }
    },

    //selectStudent
    selectStudent(s) {
      this.currentstudent = s;
    },
    //selectAdmin
    selectAdmin(st) {
      this.currentadmin = st;
    },
    //Log in manager
    LoginIn() {
      for (let i = 0; i < this.adminData.length; i++) {
        if (
          this.adminData[i].email == this.adminemail &&
          this.adminData[i].password == this.adminPass
        ) {
          this.logginn = false;
          this.user = "manager";
        } else {
          this.error_mssage = "Email Or Password Not Correct";

        }
      }
    },
    //Log in SuperAdmin
    LoginInsuper() {
      for (let i = 0; i < this.superadminData.length; i++) {
        if (
          this.superadminData[i].email == this.adminemail &&
          this.superadminData[i].password == this.adminPass
        ) {
          this.logginn = false;
          this.user = "super";
        }
      }
    },
  },
};
</script>
<style scoped>
.d1 {
  background-color: rgb(59, 81, 81);
  color: white;
  padding: 0.1%;
  height: 79px;
  margin-bottom: 1%;
}
.icon {
  margin-right: 10px;
}
.alretdiv {
  margin-left: 10%;
  margin-right: 10%;
}
.addnew {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  width: 30%;
  background-color: rgb(241, 241, 233);
}
.form-error {
  color: red;
}
</style>