
<template>
  <h1>This is an home page</h1>
  <p>{{ students }}</p>
  <br />

  <p>{{ admins }}</p>
  <br />

  <br />
  <p>{{ studentsFilter }}</p>
</template>
  <script setup lang="ts">
// import useDataStore from "@/store/students";
import useDataStore from "../store/students";
import { storeToRefs } from "pinia";
//students
const { fetchStudentsData } = useDataStore();
fetchStudentsData();
const { students } = storeToRefs(useDataStore());

//admins
const { fetchAdminsData } = useDataStore();
fetchAdminsData();
const { admins } = storeToRefs(useDataStore());

//filter
const formFilterData = new FormData();
formFilterData.append("major", "Software");
formFilterData.append("semester", "8");
const { fetchstudentsFilterData } = useDataStore();
fetchstudentsFilterData(formFilterData);
const { studentsFilter } = storeToRefs(useDataStore());

//create Student
const formCreateStudentData = new FormData();
formCreateStudentData.append("name", "kkk");
formCreateStudentData.append("major", "jjj");
formCreateStudentData.append("semester", "9");
formCreateStudentData.append("phone", "8554944");
formCreateStudentData.append("email", "eweekeer");
const { createStudent } = useDataStore();
createStudent(formCreateStudentData);

//update Student
const formUpdateStudentData = new FormData();
formUpdateStudentData.append("universityId", "39");
formUpdateStudentData.append("name", "kkk");
formUpdateStudentData.append("major", "jjj");
formUpdateStudentData.append("semester", "9");
formUpdateStudentData.append("phone", "85574944");
formUpdateStudentData.append("email", "eweejkeer");
const { updateStudent } = useDataStore();
updateStudent(formUpdateStudentData);

//delete Student
const formdeleteStudentData = new FormData();
formdeleteStudentData.append("universityId", "40");
const { deleteStudent } = useDataStore();
deleteStudent(formdeleteStudentData);

//create Admin
const formCreateAdminData = new FormData();
formCreateAdminData.append("email", "kkk");
formCreateAdminData.append("password", "jjj");
formCreateAdminData.append("phone", "8554944");
formCreateAdminData.append("name", "eweekeer");
const { createAdmin } = useDataStore();
createAdmin(formCreateAdminData);

//update Admin
const formUpdateAdminData = new FormData();
formUpdateAdminData.append("id", "25");
formUpdateAdminData.append("email", "gg");
formUpdateAdminData.append("password", "jjj");
formUpdateAdminData.append("phone", "8554944");
formUpdateAdminData.append("name", "ss");
const { updateAdmin } = useDataStore();
updateAdmin(formUpdateAdminData);

//delete Admin
const formdeleteAdminData = new FormData();
formdeleteAdminData.append("id", "1");
const { deleteAdmin } = useDataStore();
deleteAdmin(formdeleteAdminData);
</script>
   