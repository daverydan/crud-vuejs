var emailRE = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

var token = document.querySelector('meta[name=csrf-token]')

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', token.content);

    console.log(request.headers)

    next();
});

var vm = new Vue({

	el: '#UserController',

	data: {
		newUser: {
			name: '',
			email: '',
			address: ''
		}
	},

	methods: {

		fetchUser: function() {
			this.$http.get('/api/users', function(data) {
				this.$set('users', data)
			})
		},

		AddNewUser: function() {
			// User input
			var user = this.newUser

			// clear form input
			this.newUser = { name:'', email:'', address:'' }

			// send post request
			this.$http.post('/app/users/', user)
		},

	},

	computed: {
		
		validation : function() {
			return {
				// convert the right value into boolean type
				name: !!this.newUser.name.trim(),
				// test() = test for match in string, return = true : false
				email: emailRE.test(this.newUser.email),
				address: !!this.newUser.address.trim()
			}
		},

		isValid : function() {
			var validation = this.validation
			// Object.keys() = returns an array whose elements are strings corresponding to the enummerable properties found directly upon object
			// [] every(callback) = if callback returned a true value for all elements, every will return true
			return Object.keys(validation).every(function(key) {
				return validation[key]
			})
		},

	},

	ready: function() {
		this.fetchUser()
	}
});