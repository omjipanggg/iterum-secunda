<form action="{{ route('user.update', $user->id) }}" method="POST">
	@method('PUT')
	@csrf

	<div class="d-flex flex-wrap flex-column gap-3">
		<input type="text" name="idModal" value="{{ $user->id }}" disabled="" class="form-control">

		<div class="form-floating">
			<input type="text" name="name" placeholder="Name" class="form-control" required="" id="nameModal" value="{{ $user->name }}" autocomplete="off">
			<label for="nameModal">Name</label>
		</div>

		<div class="label-select position-relative mb-2">
			<select name="roles[]" id="rolesModal" class="form-control form-select select2multipleModal" multiple="" required="" aria-label="Floating roles has been initialized">
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
			<label for="rolesModal" class="text-muted">Roles</label>
		</div>
	</div>
	<button type="submit" class="btn btn-color d-none" id="btnSubmitOnModal">Submit</button>
</form>