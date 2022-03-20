@extends('template.sidebar') @section('judul', 'Profil') @section('active',
'Profil') @section('container')
<div class="card ">
    <div class="card-body card-block">
        <div class="row">
            <div class="col">
                <img
                    src="/images/{{$distributor->ds_gambar}}"
                    alt=""
                    class=""
                    style="max-height: 15em; object-fit: scale-down;"
                />
            </div>
            <div class="col-9">
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_kode" class=" form-control-label"
                            >Kode</label
                        >
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$distributor->ds_kode}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_nama" class=" form-control-label"
                            >Nama</label
                        >
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$distributor->ds_nama}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_alamat" class=" form-control-label"
                            >Alamat</label
                        >
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">
                            : {{$distributor->ds_alamat}}
                        </p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_telp" class=" form-control-label"
                            >Telp</label
                        >
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$distributor->ds_telp}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_email" class=" form-control-label"
                            >Email</label
                        >
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">: {{$distributor->ds_email}}</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_deskripsi" class=" form-control-label"
                            >Deskripsi</label
                        >
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">
                            : {{$distributor->ds_deskripsi}}
                        </p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label for="ds_active" class=" form-control-label"
                            >Status</label
                        >
                    </div>
                    <div class="col-md-9">
                        <p style="color: black">
                            : {{$distributor->ds_active}}
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/distributor/{{$distributor->id}}/edit">
                        <button class="btn btn-warning" style="color: white">
                            Ubah
                        </button>
                    </a>
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"
                    >
                        Reset Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('modal-backdrop','data-bs-backdrop=static')
@section('modal-title', "Reset Password") @section('modal-body')
<div class="my-2 mb-4">
    <div class="px-2" id="errorsPlaceholder">
        @foreach($errors->all() as $err)
        <div class="alert alert-danger" alert-dismissable role="alert">
            {{ $err }}
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        </div>
        @endforeach
    </div>
    <form action="/password/reset" method="post" enctype="multipart/form-data">
        @csrf
        <div class="px-4">
            <label class="form-control-label" for="currentPassword"
                >Password Sekarang</label
            >
            <input
                id="currentPassword"
                type="password"
                class="form-control"
                name="current_password"
            />

            <label class="form-control-label" for="newPassword"
                >Password Baru</label
            >
            <input
                type="password"
                class="form-control"
                name="new_password"
                id="newPassword"
            />

            <label class="form-control-label" for="newPasswordConfirm"
                >Konfirmasi Password Baru</label
            >
            <input
                type="password"
                class="form-control"
                name="new_password_confirm"
                id="newPasswordConfirm"
            />
        </div>

        <div class="modal-footer">
            <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                onclick="dismissModal()"
            >
                Batal
            </button>
            <button type="submit" class="btn btn-danger">Reset</button>
        </div>
    </form>
</div>

@endsection @section('script')
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

<script src="/theme/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/theme/vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>
<script>
    const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
    const alertTrigger = document.getElementById('liveAlertBtn')

    function alert(message, type) {
      var wrapper = document.createElement('div')
      wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'

      alertPlaceholder.append(wrapper)
    }

    if (alertTrigger) {
      alertTrigger.addEventListener('click', function () {
        alert('Nice, you triggered this alert message!', 'success')
      })
    }
        const modalOptions = {
            keyboard: false,
            backdrop: 'static'
        }
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), modalOptions);

        function dismissModal() {
            document.querySelector('#errorsPlaceholder').innerHTML = ""
            myModal.hide();

        }
        document.addEventListener('DOMContentLoaded', function() {

            const errors = {{ count($errors->all()) }};
            console.log("ERRORSSS ~~~~~~~~~~~~~~~", errors);
            if(errors > 0)
            {

                myModal.show()
            }
        });
</script>

@endsection
