@extends('template.sidebar')

@section('judul', 'User')
@section('active', 'User')

@section('path')
<li class="active">Data User</li>
@endsection

@section('container')
<div class="card ">
    <div class="card-body">
        <table id="bootstrap-data-table-export" class="table">
            <thead class="table-secondary">
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users as $user)
                @if ( $user->roles == 'distributor')
                <tr>
                    <td class="{{$user->userable->ds_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->userable->ds_nama}}</td>
                    <td class="{{$user->userable->ds_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->userable->ds_alamat}}</td>
                    <td class="{{$user->userable->ds_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->roles}}</td>
                    <td>
                        <span class="{{$user->userable->ds_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->userable->ds_active}}</span>
                    </td>
                    <td>
                        <a href="/distributor/{{$user->id}}" class="badge badge-info">Detail</a>
                    </td>
                </tr>
                @elseif ( $user->roles == 'toko')
                <tr>
                    <td class="{{$user->userable->tk_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->userable->tk_nama}}</td>
                    <td class="{{$user->userable->tk_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->userable->tk_alamat}}</td>
                    <td class="{{$user->userable->tk_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->roles}}</td>
                    <td>
                        <span class="{{$user->userable->tk_active == 'tolak' ? 'text-secondary' : ''}}">{{$user->userable->tk_active}}</span>
                    </td>
                    <td>
                        <a href="/distributor/{{$user->id}}" class="badge badge-info">Detail</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@section('script')
<script src="/theme/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/theme/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/theme/vendors/jszip/dist/jszip.min.js"></script>
<script src="/theme/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="/theme/vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/theme/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="/theme/assets/js/init-scripts/data-table/datatables-init.js"></script>
@endsection