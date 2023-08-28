<form action="{{ route('user.update', $user->id) }}" method="POST">
	@method('PUT')
	@csrf
	<div class="d-flex flex-wrap flex-column gap-2">
		<input type="text" name="idModal" value="{{ Str::upper($user->id) }}" disabled="" class="form-control">
		<div class="form-floating">
			<input type="text" name="name" placeholder="Name" class="form-control" required="" id="nameModal" value="{{ $user->name }}" autocomplete="off">
			<label for="nameModal">Name</label>
		</div>
		<div class="form-select-defined-floating">
		<label for="roles-on-modal">Roles</label>
		<select name="roles[]" id="roles-on-modal" class="form-select select2-single-modal" multiple="" required="">
			@foreach ($roles as $role)
				@php($selected = false)
				@forelse ($user->roles as $each)
					@if ($role->id == $each->id)
						@php($selected = true)
					@endif
					@empty
				@endforelse
				<option value="{{ $role->id }}" @if($selected) selected="" @endif>{{ $role->name }}</option>
			@endforeach
		</select>
		</div>
	</div>
	<button type="submit" class="btn btn-color d-none" id="btn-modal">Submit</button>
</form>