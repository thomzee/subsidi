@extends('backend.layouts.app')
@section('title', $menu)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">{{ $menu }}</h1>
        <form method="POST" action="{{ route($route.'.store') }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Kasir: {{ auth()->user()->name }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select id="search" class="form-control"
                                                data-placeholder="Cari nik, nama, atau kelompok tani ...">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="col-form-label">Nama</label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama" disabled>
                                            <input type="hidden" class="form-control" id="petani_id" name="petani_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="col-form-label">NIK</label>
                                            <input type="text" id="nik" class="form-control" placeholder="NIK" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="col-form-label">Kelompok</label>
                                            <input type="text" id="kelompok" class="form-control" placeholder="Kelompok" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <legend>Sisa Kuota MT {{ \App\Services\SettingService::currentMt() }} - {{ \App\Services\SettingService::currentTahun() }}</legend>
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Produk</th>
                                                            <th>Jumlah Quota (Kg)</th>
                                                            <th>Jumlah Penebusan (Kg)</th>
                                                            <th>Sisa Quota (Kg)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>UREA</td>
                                                            <td id="quota-urea" class="cells">0</td>
                                                            <td id="penebusan-urea" class="cells">0</td>
                                                            <td id="sisa-urea" class="cells">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>SP-36</td>
                                                            <td id="quota-sp-36" class="cells">0</td>
                                                            <td id="penebusan-sp-36" class="cells">0</td>
                                                            <td id="sisa-sp-36" class="cells">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>ZA</td>
                                                            <td id="quota-za" class="cells">0</td>
                                                            <td id="penebusan-za" class="cells">0</td>
                                                            <td id="sisa-za" class="cells">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>NPK</td>
                                                            <td id="quota-npk" class="cells">0</td>
                                                            <td id="penebusan-npk" class="cells">0</td>
                                                            <td id="sisa-npk" class="cells">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>ORGANIK</td>
                                                            <td id="quota-organik" class="cells">0</td>
                                                            <td id="penebusan-organik" class="cells">0</td>
                                                            <td id="sisa-organik" class="cells">0</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <legend>Penebusan</legend>
                                        <div class="row">
                                            @foreach (config('settings.produk') as $slug => $produk)
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">{{ $produk }}</label>
                                                        <input type="number" name="{{ $slug }}" id="input-{{$slug}}" class="form-control input-penebusan @error($slug) is-invalid @enderror" placeholder="{{ $produk }}" value="{{ old('input-'.$slug) }}">
                                                        @error($slug)
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <center>
                                        <button type="reset" class="btn btn-danger" id="btn-reset"><i class="fa fa-sync"></i> Reset</button>
                                        <button type="submit" class="btn btn-primary" id="btn-submit">{!! __('icon.save') !!}</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
    <script>
        $(function () {
            LOCAL.search();
        });

        $('#btn-submit').on('click', function (e) {
            let valid = true;
            let field = '';

            let inputUrea = $('#input-urea');
            let inputSp36 = $('#input-sp_36');
            let inputZa = $('#input-za');
            let inputNpk = $('#input-npk');
            let inputOrganik = $('#input-organik');

            let sisaUrea = $('#sisa-urea');
            let sisaSp36 = $('#sisa-sp-36');
            let sisaZa = $('#sisa-za');
            let sisaNpk = $('#sisa-npk');
            let sisaOrganik = $('#sisa-organik');

            inputUrea.val() === "" ? inputUrea.val(0) : '';
            inputSp36.val() === "" ? inputSp36.val(0) : '';
            inputZa.val() === "" ? inputZa.val(0) : '';
            inputNpk.val() === "" ? inputNpk.val(0) : '';
            inputOrganik.val() === "" ? inputOrganik.val(0) : '';

            if (parseInt(inputUrea.val()) > parseInt(sisaUrea.text())) {
                valid = false;
                field = 'UREA';
            }

            if (parseInt(inputSp36.val()) > parseInt(sisaSp36.text())) {
                valid = false;
                field = 'SP-36';
            }

            if (parseInt(inputZa.val()) > parseInt(sisaZa.text())) {
                valid = false;
                field = 'ZA';
            }

            if (parseInt(inputNpk.val()) > parseInt(sisaNpk.text())) {
                valid = false;
                field = 'NPK';
            }

            if (parseInt(inputOrganik.val()) > parseInt(sisaOrganik.text())) {
                valid = false;
                field = 'ORGANIK';
            }

            if (valid === false) {
                Swal.fire({
                    icon: 'error',
                    title: 'Melebihi Quota',
                    text: 'Penebusan ' + field + ' melebihi quota yang disediakan.',
                });
                e.preventDefault();
            }

            if ($('#nik').val() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Ada Data',
                    text: 'Pilih petani terlebih dahulu.',
                });
                e.preventDefault();
            }

            if (parseInt(inputUrea.val()) === 0
            && parseInt(inputSp36.val()) === 0
            && parseInt(inputZa.val()) === 0
            && parseInt(inputNpk.val()) === 0
            && parseInt(inputOrganik.val()) === 0
            ) {
                Swal.fire({
                    icon: 'error',
                    title: 'Penebusan Kosong',
                    text: 'Tidak ada penebusan. Harap masukan jumlah penebusan.',
                });
                e.preventDefault();
            }
        });

        function resetTable() {
            $.each($('.cells'), function (k, v) {
                $(v).text(0);
            });
        }

        function resetInputPenebusan() {
            $.each($('.input-penebusan'), function (k, v) {
                $(v).val('');
            });
        }

        $('#btn-reset').click(function() {
            resetTable();
            resetInputPenebusan();
            $('#petani_id').val('');
        });

        $(document).on('select2:select', '#search', function () {
            resetTable();
            resetInputPenebusan();
            $('#petani_id').val('');
            $.ajax({
                url: '{!! route($route.".selectPetani") !!}',
                data: {
                    'petani_id': $('#search option:selected').val()
                },
                method: 'POST',
                dataType: 'html',
                error: function (e) {
                    console.log(e);
                },
                success: function (response) {
                    response = $.parseJSON(response);
                    $('#petani_id').val(response.data.id);
                    $('#nama').val(response.data.nama);
                    $('#nik').val(response.data.nik);
                    $('#kelompok').val(response.data.kelompok);

                    response.quota.urea !== undefined ? $('#quota-urea').text(response.quota.urea) : $('#quota-urea').text(0);
                    response.quota["sp-36"] !== undefined ? $('#quota-sp-36').text(response.quota["sp-36"]) : $('#quota-sp-36').text(0);
                    response.quota.za !== undefined ? $('#quota-za').text(response.quota.za) : $('#quota-za').text(0);
                    response.quota.npk !== undefined ? $('#quota-npk').text(response.quota.npk) : $('#quota-npk').text(0);
                    response.quota.organik !== undefined ? $('#quota-organik').text(response.quota.organik) : $('#quota-organik').text(0);

                    response.penebusan.urea !== undefined ? $('#penebusan-urea').text(response.penebusan.urea) : $('#penebusan-urea').text(0);
                    response.penebusan["sp-36"] !== undefined ? $('#penebusan-sp-36').text(response.penebusan["sp-36"]) : $('#penebusan-sp-36').text(0);
                    response.penebusan.za !== undefined ? $('#penebusan-za').text(response.penebusan.za) : $('#penebusan-za').text(0);
                    response.penebusan.npk !== undefined ? $('#penebusan-npk').text(response.penebusan.npk) : $('#penebusan-npk').text(0);
                    response.penebusan.organik !== undefined ? $('#penebusan-organik').text(response.penebusan.organik) : $('#penebusan-organik').text(0);

                    response.sisa.urea !== undefined ? $('#sisa-urea').text(response.sisa.urea) : $('#sisa-urea').text(0);
                    response.sisa["sp-36"] !== undefined ? $('#sisa-sp-36').text(response.sisa["sp-36"]) : $('#sisa-sp-36').text(0);
                    response.sisa.za !== undefined ? $('#sisa-za').text(response.sisa.za) : $('#sisa-za').text(0);
                    response.sisa.npk !== undefined ? $('#sisa-npk').text(response.sisa.npk) : $('#sisa-npk').text(0);
                    response.sisa.organik !== undefined ? $('#sisa-organik').text(response.sisa.organik) : $('#sisa-organik').text(0);
                },
                complete: function () {
                    LOCAL.search();
                }
            });
        });

        let LOCAL = {
            search: function () {
                $("#search").val(null);
                $("#search").select2({
                    placeholder: 'Cari nik, nama, atau kelompok tani ...',
                    minimumInputLength: 2,
                    ajax: {
                        url: '{!! route($route.".search") !!}',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            // let excludes = $(".item-rows").map(function() {
                            //     return $(this).data("id");
                            // }).get();
                            return {
                                keyword: params.term
                                // excludes: excludes
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.nik + " - " + item.nama + " - " + item.kelompok,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            }
        };
    </script>
@endpush
