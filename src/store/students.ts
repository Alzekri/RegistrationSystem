import { defineStore } from "pinia";
import axios from "axios";
const URL = "http://localhost/projects/phpapi/api/student.php?action=";

export const useDataStore = defineStore("data-store", {
  state: () => ({
    students: [],
    admins: [],
    superAdmins: [],
    studentsFilter: {},
  }),
  actions: {
    async fetchStudentsData() {
      await axios
        .get(URL + "read-students")
        .then((response) => (this.students = response.data.students))
        .catch((err) => Promise.reject(err));
    },

    async fetchAdminsData() {
      await axios
        .get(URL + "read-admins")
        .then((response) => (this.admins = response.data.admins))
        .catch((err) => Promise.reject(err));
    },

    async fetchSuperAdminsData() {
      await axios
        .get(URL + "read-super")
        .then((response) => (this.superAdmins = response.data.superadmin))
        .catch((err) => Promise.reject(err));
    },
    async fetchstudentsFilterData(formData: FormData) {
      await axios
        .post(URL + "filter", formData)
        .then((response) => (this.studentsFilter = response.data))
        .catch((err) => Promise.reject(err));
    },

    async createStudent(formData: FormData) {
      await axios
        .post(URL + "create-student", formData)
        .then((response) => console.log(response))
        .catch((err) => Promise.reject(err));
    },
    async updateStudent(formData: FormData) {
      await axios
        .post(URL + "update-student", formData)
        .then((response) => console.log(response))
        .catch((err) => Promise.reject(err));
    },
    async deleteStudent(formData: FormData) {
      await axios
        .post(URL + "delete-student", formData)
        .then((response) => console.log(response))
        .catch((err) => Promise.reject(err));
    },
    async createAdmin(formData: FormData) {
      await axios
        .post(URL + "create-admin", formData)
        .then((response) => console.log(response))
        .catch((err) => Promise.reject(err));
    },

    async updateAdmin(formData: FormData) {
      await axios
        .post(URL + "update-admin", formData)
        .then((response) => console.log(response))
        .catch((err) => Promise.reject(err));
    },
    async deleteAdmin(formData: FormData) {
      await axios
        .post(URL + "delete-admin", formData)
        .then((response) => console.log(response))
        .catch((err) => Promise.reject(err));
    },
  },
});

export default useDataStore;
