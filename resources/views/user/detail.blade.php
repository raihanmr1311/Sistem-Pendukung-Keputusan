@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users-cog"></i> Data User</h1>

	<a href="{{ url('User') }}" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-fw fa-edit"></i> Detail Data User</h6>
    </div>
	
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<tr>
					<th class="bg-light">E-Mail</th>
					<td>{{ $user->email }}</td>
				</tr>
				<tr>
					<th class="bg-light">Username</th>
					<td>{{ $user->username }}</td>
				</tr>
				<tr>
					<th class="bg-light">Password</th>
					<td>{{ $user->password }}</td>
				</tr>
				<tr>
					<th class="bg-light">Nama Lengkap</th>
					<td>{{ $user->nama }}</td>
				</tr>
				<tr>
					<th class="bg-light">Level</th>
					<td>
					@foreach($user_level as $k)
						@if($k->id_user_level == $user->id_user_level)
							{{ $k->user_level }}
						@endif
					@endforeach
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

@include('layouts.footer_admin')
