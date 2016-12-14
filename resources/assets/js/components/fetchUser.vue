<template>
    <div id="UserController" style="padding-top: 2em;">

		<div class="alert alert-danger" v-if="!isValid">
			<ul>
				<li v-show="!validation.name">Name field is required</li>
				<li v-show="!validation.email">Input a valid email address</li>
				<li v-show="!validation.address">Address field is required</li>
			</ul>
		</div>

		<form action="#" @submit.prevent="AddNewUser()" method="POST">
			<div class="form-group">
				<label for="name">Name</label>
				<input v-model="newUser.name" type="text" name="name" id="name" class="form-control">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input v-model="newUser.email" type="email" name="email" id="email" class="form-control">
			</div>

			<div class="form-group">
				<label for="address">Address</label>
				<input v-model="newUser.address" type="text" name="address" id="address" class="form-control">
			</div>

			<div class="form-group">
				<button :disabled="!isValid" type="submit" class="btn btn-default">Add New User</button>
			</div>
		</form>

		<table class="table">
			<thead>
				<th>ID</th>
				<th>NAME</th>
				<th>EMAIL</th>
				<th>ADDRESS</th>
				<th>CREATED_AT</th>
				<th>UPDATED_AT</th>
			</thead>

			<tbody>
				<tr v-for="user in users">
					<td>{{ user.id }}</td>
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td>{{ user.address }}</td>
					<td>{{ user.created_at }}</td>
					<td>{{ user.updated_at }}</td>
				</tr>
			</tbody>
		</table>

	</div>
</template>

<script>
var emailRE = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
export default {
    name: 'fetch-users',

	data() {
		return {
            users: [],
            newUser: {
    			name: '',
    			email: '',
    			address: ''
    		}
        }
	},

    mounted() {
		this.fetchUser()
	},

	methods: {

		fetchUser() {
			this.$http.get('/api/users')
                .then(response => this.users = response.data)
		},

		AddNewUser() {
			// User input
			var user = this.newUser

			// clear form input
			this.newUser = { name:'', email:'', address:'' }

			// send post request
			this.$http.post('/api/users/', user)
                .then(response => this.users.push(response.data))
                .catch(error => console.error(error))
		},

	},

	computed: {

		validation() {
			return {
				// convert the right value into boolean type
				name: !!this.newUser.name.trim(),
				// test() = test for match in string, return = true : false
				email: emailRE.test(this.newUser.email),
				address: !!this.newUser.address.trim()
			}
		},

		isValid() {
			var validation = this.validation
			// Object.keys() = returns an array whose elements are strings corresponding to the enummerable properties found directly upon object
			// [] every(callback) = if callback returned a true value for all elements, every will return true
			return Object.keys(validation).every(function(key) {
				return validation[key]
			})
		}

	}
}
</script>
