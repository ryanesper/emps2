<template>
	<div>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<h1>Department</h1>
				</div>
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card">
						<div class="card-body">
							<form>
								<div class="form-group">
									<label for="department">Department</label>
									<input type="text" id="department" name="department" class="form-control" v-model:value="department.name">
								</div>
								<div class="form-group">
									<label for="department">Company</label>
									<select v-model="company" class="form-control">
										<option v-for="company in companies">
											{{ company.name }}
										</option>
									</select>
								</div>
								<button class="btn btn-primary" @click.prevent="saveDepartment">Save</button>
							</form>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th>Department Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="department in departments.data">
										<td>{{ department.name }}</td>
										<td>
											<button class="btn btn-warning"
													@click="editDepartment(department)">Edit</button>
											<button class="btn btn-danger" 
													@click="deleteDepartment(department.id)">Delete</button>
										</td>
									</tr>
								</tbody>
							</table>			
						</div>
						<div class="card-footer">
							<pagination :data="departments" @pagination-change-page="getResults"></pagination>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				edit: false,
				companies: {},
				company: '',
				departments: {},
				department: {
					id: '',
					name: ''
				}
			}
		},
		created() {
			this.getDepartments();
			this.getCompanies();
		},
 		methods: {
			getResults(page = 1) {
				axios.get('api/departments?page=' + page)
					.then(response => {
						this.departments = response.data;
					});
			},
			getDepartments() {
				axios.get('/api/departments')
				.then(res => {
					this.departments = res.data;
				})
			},
			saveDepartment() {
				console.log(this.department)
				if(this.edit) {
					axios.put('/api/deparment', this.deparment)
					.then(res => {
						this.deparment.id = '',
						this.deparment.name = '',
						this.getDepartments();
						this.edit = false;
					})
				} else {
					axios.post('/api/department', this.deparment)
					.then(res => {
						this.getDepartments();
						this.deparment.name = '';
					})	
				}
			},
			editDepartment(department) {
				this.edit = true;
				this.department.id = department.id;
				this.department.name = department.name;
			},
			deleteDepartment(id) {
				axios.delete('/api/department/' + id)
				.then(res => {
					this.getDepartments();
				})
			},
			getCompanies() {
				axios.get('/api/companies')
				.then(res => {
					this.companies = res.data.data;
				})
			},
		}
	}
</script>