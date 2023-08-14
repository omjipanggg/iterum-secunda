<form action="{{ route('master.destroyThem') }}" method="POST" id="vanisher">
	@csrf
	@method('DELETE')
	<button type="submit" class="btn btn-color d-none" id="btnVanisher">Hapus</button>
</form>