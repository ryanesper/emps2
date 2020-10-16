import Vue from 'vue'
import VueRouter from 'vue-router'
import CompanyComponent from './components/Company.vue'
import DepartmentComponent from './components/Department.vue'
import EmployeeComponent from './components/Employee.vue'

Vue.use(VueRouter)

export default new VueRouter({
	routes: [
		{ path: '/companies', component: CompanyComponent },
		{ path: '/departments', component: DepartmentComponent },
		{ path: '/employees', component: EmployeeComponent },
	],
	mode: 'history'
})