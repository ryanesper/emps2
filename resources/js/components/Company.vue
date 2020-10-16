<template>
	<div>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<h1>Company</h1>
				</div>
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card">
						<div class="card-body">
							<form>
								<div class="form-group">
									<label for="company">Company</label>
									<input type="text" id="company" name="company" class="form-control" v-model:value="company.name">
								</div>
								<button class="btn btn-primary" @click.prevent="saveCompany">Save</button>
							</form>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th>Company Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="company in companies.data">
										<td>{{ company.name }}</td>
										<td>
											<button class="btn btn-warning"
													@click="editCompany(company)">Edit</button>
											<button class="btn btn-danger" 
													@click="deleteCompany(company.id)">Delete</button>
										</td>
									</tr>
								</tbody>
							</table>			
						</div>
						<div class="card-footer">
							<pagination :data="companies" @pagination-change-page="getResults"></pagination>
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
				company: {
					id: '',
					name: ''
				}
			}
		},
		created() {
			this.getCompanies();
		},
 		methods: {
			getResults(page = 1) {
				axios.get('api/companies?page=' + page)
					.then(response => {
						this.companies = response.data;
					});
			},
			getCompanies() {
				axios.get('/api/companies')
				.then(res => {
					this.companies = res.data;
				})
			},
			saveCompany() {
				if(this.edit) {
					axios.put('/api/company', this.company)
					.then(res => {
						this.company.id = '',
						this.company.name = '',
						this.getCompanies();
						this.edit = false;
					})
				} else {
					axios.post('/api/company', this.company)
					.then(res => {
						this.getCompanies();
						this.company.name = '';
					})	
				}
			},
			editCompany(company) {
				this.edit = true;
				this.company.id = company.id;
				this.company.name = company.name;
			},
			deleteCompany(id) {
				axios.delete('/api/company/' + id)
				.then(res => {
					this.getCompanies();
				})
			}
		}
	}
</script>