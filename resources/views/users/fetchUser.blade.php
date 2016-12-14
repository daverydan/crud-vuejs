@extends('layout')

@section('content')
	
	<div id="UserController" style="padding-top: 2em;">

		<div class="alert alert-danger" v-if="!isValid">
			<ul>
				<li v-show="!validation.name">Name field is required</li>
				<li v-show="!validation.email">Input a valid email address</li>
				<li v-show="!validation.address">Address field is required</li>
			</ul>
		</div>

		<form action="#" @submit="AddNewUser" method="POST">
			<div class="form-group">
				<label for="name">Name</label>
				<input v-model="newUser.name" type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input v-model="newUser.email" type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
			</div>

			<div class="form-group">
				<label for="address">Address</label>
				<input v-model="newUser.address" type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
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
					<td>@{{ user.id }}</td>
					<td>@{{ user.name }}</td>
					<td>@{{ user.email }}</td>
					<td>@{{ user.address }}</td>
					<td>@{{ user.created_at }}</td>
					<td>@{{ user.updated_at }}</td>
				</tr>
			</tbody>
		</table>

	</div>

@stop

@push('scripts')
	<script src="/js/script.js"></script>
@endpush