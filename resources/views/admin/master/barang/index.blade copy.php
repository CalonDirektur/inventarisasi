@extends('layouts.app')
@section('title', __("goods"))
@section('content')
<x-head-datatable />
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-header row">
                    <div class="d-flex justify-content-end align-items-center w-100">
                        @if(Auth::user()->role->name != 'staff')
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#TambahData" id="modal-button"><i class="fas fa-plus"></i> {{ __("add data") }}</button>
                        @endif
                    </div>
                </div>


                <!-- Modal tambah data -->
                 <!-- Modal -->
                <div class="modal fade" id="TambahData" tabindex="-1" aria-labelledby="TambahDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TambahDataModalLabel">{{ __("add goods") }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="kode" class="form-label">{{ __("code of goods") }} <span class="text-danger">*</span></label>
                                            <input type="text" name="kode" readonly class="form-control">
                                            <input type="hidden" name="id" />
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="form-label">{{ __("name of goods") }} <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" class="form-control">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="jenisbarang" class="form-label">{{ __("types of goods") }} <span class="text-danger">*</span></label>
                                            <select name="jenisbarang" class="form-control">
                                                <option value="">-- {{ __("select category") }} --</option>
                                                @foreach ($jenisbarang as $jb)
                                                <option value="{{$jb->id}}">{{$jb->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="merk" class="form-label">{{ __("brand of goods") }} <span class="text-danger">*</span></label>
                                            <select name="merk" class="form-control">
                                                <option value="">-- {{ __("select brand") }} --</option>
                                                @foreach ($merk as $m)
                                                <option value="{{$m->id}}">{{$m->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="serial_number" class="form-label">{{ __("Nomor Serial") }} <span class="text-danger">*</span></label>
                                            <input type="text" name="serial_number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="model_barang" class="form-label">{{ __("Model Barang") }} <span class="text-danger">*</span></label>
                                            <input type="text" name="model_barang" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi_barang" class="form-label">{{ __("Lokasi Barang") }} <span class="text-danger">*</span></label>
                                            <select name="lokasi_barang" class="form-control">
                                                <option value="">-- {{ __("Pilih Lokasi") }} --</option>
                                                <option value="Ruang GM">Ruang GM</option>
                                                <option value="Ruang Manager">Ruang Manager</option>
                                                <option value="Ruang Karyawan (unit BSRM)">Ruang Karyawan (unit BSRM)</option>
                                                <option value="Ruang Karyawan (unit Marsalsol)">Ruang Karyawan (unit Marsalsol)</option>
                                                <option value="Ruang Karyawan (unit P&D)">Ruang Karyawan (unit P&D)</option>
                                                <option value="Ruang Karyawan (unit Operation)">Ruang Karyawan (unit Operation)</option>
                                                <option value="Sekretatis">Sekretatis</option>
                                                <option value="RBOC">RBOC</option>
                                                <option value="Ruang Rapat (samping ruang manager)">Ruang Rapat (samping ruang manager)</option>
                                                <option value="Ruang Rapat (depan RBOC)">Ruang Rapat (depan RBOC)</option>
                                                <option value="Pantry">Pantry</option>
                                                <option value="Musholla">Musholla</option>
                                                <option value="Toilet Pria">Toilet Pria</option>
                                                <option value="Toilet Wanita">Toilet Wanita</option>
                                                <option value="Library / Ruang Bilyard">Library / Ruang Bilyard</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pengguna_barang" class="form-label">{{ __("Pengguna Barang") }} <span class="text-danger">*</span></label>
                                            <select name="pengguna_barang" class="form-control" id="pengguna_barang_select">
                                                <option value="">-- {{ __("Pilih Pengguna") }} --</option>
                                                <option value="Karyawan All">Karyawan All</option>
                                                <option value="Karyawan unit BSRM">Karyawan unit BSRM</option>
                                                <option value="Karyawan unit Marsalsol">Karyawan unit Marsalsol</option>
                                                <option value="Karyawan unit P&D">Karyawan unit P&D</option>
                                                <option value="Karyawan unit Operation">Karyawan unit Operation</option>
                                                <option value="Manager">Manager</option>
                                                <option value="GM">GM</option>
                                                <option value="Housekeeper">Housekeeper</option>
                                            </select>
                                            <input type="text" name="pengguna_barang_input" class="form-control mt-2" placeholder="Atau masukkan pengguna baru" style="display:none;">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="pengguna_barang" class="form-label">{{ __("Pengguna Barang") }} <span class="text-danger">*</span></label>
                                            <select name="pengguna_barang" class="form-control" id="pengguna_barang_select">
                                                <option value="">-- {{ __("Pilih Pengguna") }} --</option>
                                                <option value="Karyawan All">Karyawan All</option>
                                                <option value="Karyawan unit BSRM">Karyawan unit BSRM</option>
                                                <option value="Karyawan unit Marsalsol">Karyawan unit Marsalsol</option>
                                                <option value="Karyawan unit P&D">Karyawan unit P&D</option>
                                                <option value="Karyawan unit Operation">Karyawan unit Operation</option>
                                                <option value="Manager">Manager</option>
                                                <option value="GM">GM</option>
                                                <option value="Housekeeper">Housekeeper</option>
                                            </select>
                                        </div> -->


                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="kondisi_barang" class="form-label">{{ __("Kondisi Barang") }} <span class="text-danger">*</span></label>
                                                <select name="kondisi_barang" class="form-control">
                                                    <option value="">-- {{ __("Pilih Kondisi") }} --</option>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Bermasalah namun masih difungsikan">Bermasalah namun masih difungsikan</option>
                                                    <option value="Rusak">Rusak</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="estimasi_tahun" class="form-label">{{ __("Estimasi Tahun Penggunaan") }} <span class="text-danger">*</span></label>
                                                <select name="estimasi_tahun" class="form-control">
                                                    <option value="">-- {{ __("Pilih Tahun") }} --</option>
                                                    @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="harga" class="form-label">{{ __("price of goods") }} <span class="text-danger">*</span></label>
                                                <input type="text" id="harga" name="harga" class="form-control" placeholder="RP. 0">
                                            </div>
                                            <div class="form-group">
                                                <label for="satuan" class="form-label">{{ __("unit of goods") }} <span class="text-danger">*</span></label>
                                                <select name="satuan" class="form-control">
                                                    <option value="">-- {{ __("select unit") }} --</option>
                                                    @foreach ($satuan as $s)
                                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="title" class="form-label">{{ __("photo") }}</label>
                                                <img src="{{asset('default.png')}}" width="80%" alt="profile-user" id="outputImg" class="text-center">
                                                <input class="form-control mt-5" id="GetFile" name="photo" type="file" accept=".png,.jpeg,.jpg,.svg">
                                            </div> -->
                                            <div class="form-group">
                                                <label for="title" class="form-label">{{ __("photo") }}</label>
                                                <img src="{{ asset('default.png') }}" width="80%" alt="Item Image" id="outputImg" class="text-center">
                                                <input class="form-control mt-5" id="GetFile" name="photo" type="file" accept=".png,.jpeg,.jpg,.svg">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="kembali">{{ __("back") }}</button>
                                <button type="button" class="btn btn-success" id="simpan">{{ __("save") }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="modal fade" id="TambahData" tabindex="-1" aria-labelledby="TambahDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TambahDataModalLabel">{{ __("add goods") }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="kode" class="form-label">{{ __("code of goods") }} <span class="text-danger">*</span></label>
                                            <input type="text" name="kode" readonly class="form-control">
                                            <input type="hidden" name="id" />
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="form-label">{{ __("name of goods") }} <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenisbarang" class="form-label">{{ __("types of goods") }} <span class="text-danger">*</span></label>
                                            <select name="jenisbarang" class="form-control">
                                                <option value="">-- {{ __("select category") }} --</option>
                                                @foreach ($jenisbarang as $jb)
                                                <option value="{{$jb->id}}">{{$jb->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan" class="form-label">{{ __("unit of goods") }} <span class="text-danger">*</span></label>
                                            <select name="satuan" class="form-control">
                                                <option value="">-- {{ __("select unit") }} --</option>
                                                @foreach ($satuan as $s)
                                                <option value="{{$s->id}}">{{$s->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="merk" class="form-label">{{ __("brand of goods") }} <span class="text-danger">*</span></label>
                                            <select name="merk" class="form-control">
                                                <option value="">-- {{ __("select brand") }} --</option>
                                                @foreach ($merk as $m)
                                                <option value="{{$m->id}}">{{$m->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group item-count" id="item-count">
                                            <label for="harga" class="form-label">{{ __("initial amount") }} <span class="text-danger">*</span></label>
                                            <input type="number" value="0" name="jumlah" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="harga" class="form-label">{{ __("price of goods") }} <span class="text-danger">*</span></label>
                                            <input type="text" id="harga" name="harga" class="form-control" placeholder="RP. 0">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="title" class="form-label">{{ __("photo") }}</label>
                                            <img src="{{asset('default.png')}}" width="80%" alt="profile-user" id="outputImg" class="text-center">
                                            <input class="form-control mt-5" id="GetFile" name="photo" type="file" accept=".png,.jpeg,.jpg,.svg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="kembali">{{ __("back") }}</button>
                                <button type="button" class="btn btn-success" id="simpan">{{ __("save") }}</button>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Detail Modal -->
                <!-- Detail Modal -->
                <!-- <div class="modal fade" id="DetailModal" tabindex="-1" aria-labelledby="DetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DetailModalLabel">{{ __("Item Details") }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div id="detail-content">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <img src="{{ asset('default.png') }}" id="detail-image" style="width:100%; max-width:240px; aspect-ratio:1; object-fit:cover; padding:1px; border:1px solid #ddd" alt="Item Image">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="modal fade" id="DetailModal" tabindex="-1" aria-labelledby="DetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="DetailModalLabel">{{ __("Item Details") }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div id="detail-content">
                                            <!-- Detailed information will be populated here -->
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <img src="{{ asset('default.png') }}" id="detail-image" style="width:100%; max-width:240px; aspect-ratio:1; object-fit:cover; padding:1px; border:1px solid #ddd" alt="Item Image">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-tabel" width="100%" class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" width="6%">{{ __("no") }}</th>
                                    <th class="border-bottom-0">{{ __("photo") }}</th>
                                    <th class="border-bottom-0">{{ __("code") }}</th>
                                    <th class="border-bottom-0">{{ __("name") }}</th>
                                    <th class="border-bottom-0">{{ __("type") }}</th>
                                    <th class="border-bottom-0">{{ __("unit") }}</th>
                                    <th class="border-bottom-0">{{ __("brand") }}</th>
                                    <!-- <th class="border-bottom-0">{{ __("initial stock") }}</th> -->
                                    <th class="border-bottom-0">{{ __("price") }}</th>
                                    @if(Auth::user()->role->name != 'staff')
                                    <th class="border-bottom-0" width="1%">{{ __("action") }}</th>
                                    @endif
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-data-table />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function harga() {
        this.value = formatIDR(this.value.replace(/[^0-9.]/g, ''));
    }


    // function formatIDR(angka) {
    //     // Ubah angka menjadi string dan hapus simbol yang tidak diperlukan
    //     var strAngka = angka.toString().replace(/[^0-9]/g, '');

    //     // Jika tidak ada angka yang tersisa, kembalikan string kosong
    //     if (!strAngka) return '';

    //     // Pisahkan angka menjadi bagian yang sesuai dengan ribuan
    //     var parts = strAngka.split('.');
    //     var intPart = parts[0];
    //     var decPart = parts.length > 1 ? '.' + parts[1] : '';

    //     // Tambahkan pemisah ribuan
    //     intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    //     // Tambahkan simbol IDR
    //     return 'RP.' + intPart + decPart;
    // }

    function formatIDR(angka) {
        // Ubah angka menjadi string dan hapus simbol yang tidak diperlukan
        var strAngka = angka.toString().replace(/[^0-9]/g, '');

        // Jika tidak ada angka yang tersisa, kembalikan string kosong
        if (!strAngka) return '';

        // Pisahkan angka menjadi bagian yang sesuai dengan ribuan
        var intPart = strAngka.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Add thousand separators

        // Tambahkan simbol IDR
        return 'RP. ' + intPart; // Return formatted price
    }


    function isi() {
        $('#data-tabel').DataTable({
            lengthChange: true,
            processing: true,
            serverSide: true,
            ajax: `{{route('barang.list')}}`,
            columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'img',
                    name: 'img'
                }, {
                    data: 'code',
                    name: 'code'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'unit_name',
                    name: 'unit_name'
                },
                {
                    data: 'brand_name',
                    name: 'brand_name'
                },
                // {
                //     data: 'quantity',
                //     name: 'quantity'
                // },
                // {
                //     data: 'price',
                //     name: 'price'
                // },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, row) {
                        return formatIDR(data); // Format the price for display
                    }
                },
                @if(Auth::user() -> role -> name != 'staff') {
                    data: 'tindakan',
                    name: 'tindakan'
                }
                @endif
            ]
        }).buttons().container();
    }

    // function simpan() {
    //     const name = $("input[name='nama']").val();
    //     const code = $("input[name='kode']").val();
    //     const image = $("#GetFile")[0].files;
    //     const category_id = $("select[name='jenisbarang']").val();
    //     const unit_id = $("select[name='satuan']").val();
    //     const brand_id = $("select[name='merk']").val();
    //     const price = $("input[name='harga']").val();
    //     // return console.log({name,code,category_id,unit_id,brand_id,price,quantity});
    //     const Form = new FormData();
    //     Form.append('image', image[0]);
    //     Form.append('code', code);
    //     Form.append('name', name);
    //     Form.append('category_id', category_id);
    //     Form.append('unit_id', unit_id);
    //     Form.append('brand_id', brand_id);
    //     Form.append('price', price);
    //     if (name.length == 0) {
    //         return Swal.fire({
    //             position: "center",
    //             icon: "warning",
    //             title: "nama tidak boleh kosong !",
    //             showConfirmButton: false,
    //             imer: 1500
    //         });
    //     }
    //     if (price.length == 0) {
    //         return Swal.fire({
    //             position: "center",
    //             icon: "warning",
    //             title: "harga tidak boleh kosong !",
    //             showConfirmButton: false,
    //             imer: 1500
    //         });
    //     }
    //     $.ajax({
    //         url: `{{route('barang.save')}}`,
    //         type: "post",
    //         processData: false,
    //         contentType: false,
    //         dataType: 'json',
    //         data: Form,
    //         success: function(res) {
    //             Swal.fire({
    //                 position: "center",
    //                 icon: "success",
    //                 title: res.message,
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });
    //             $('#kembali').click();
    //             $("input[name='nama']").val(null);
    //             $("input[name='kode']").val(null);
    //             $("#GetFile")[0].files = null;
    //             $("select[name='jenisbarang']").val(null);
    //             $("select[name='satuan']").val(null);
    //             $("select[name='merk']").val(null);
    //             $("input[name='jumlah']").val(0);
    //             $("input[name='harga']").val(null);
    //             $('#data-tabel').DataTable().ajax.reload();
    //         },
    //         error: function(err) {
    //             console.log(err);
    //         },

    //     });
    // }
    
    function simpan() {
        const name = $("input[name='nama']").val();
        const code = $("input[name='kode']").val();
        const serialNumber = $("input[name='serial_number']").val();
        const modelBarang = $("input[name='model_barang']").val();
        const lokasiBarang = $("select[name='lokasi_barang']").val();
        const penggunaBarang = $("select[name='pengguna_barang']").val() || $("input[name='pengguna_barang_input']").val();
        const kondisiBarang = $("select[name='kondisi_barang']").val();
        const estimasiTahun = parseInt($("select[name='estimasi_tahun']").val()); // Ensure this is an integer
        const image = $("#GetFile")[0].files;
        const category_id = parseInt($("select[name='jenisbarang']").val()); // Ensure this is an integer
        const unit_id = parseInt($("select[name='satuan']").val()); // Ensure this is an integer
        const brand_id = parseInt($("select[name='merk']").val()); // Ensure this is an integer
        // const price = $("input[name='harga']").val();
        const price = parseFloat($("input[name='harga']").val().replace(/RP\.|\.|[^0-9]/g, "").trim()); // Remove 'RP.', dots, and non-numeric characters
        const quantity = $("input[name='jumlah']").val();

        // Validation checks
        if (!name) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Nama tidak boleh kosong!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!code) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Kode barang tidak boleh kosong!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!serialNumber) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Nomor serial tidak boleh kosong!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!modelBarang) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Model barang tidak boleh kosong!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!lokasiBarang) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Lokasi barang harus dipilih!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!penggunaBarang) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Pengguna barang harus dipilih!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!kondisiBarang) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Kondisi barang harus dipilih!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!estimasiTahun) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Estimasi tahun penggunaan harus dipilih!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!category_id) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Jenis barang harus dipilih!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!unit_id) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Satuan barang harus dipilih!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!brand_id) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Merek barang harus dipilih!",
                showConfirmButton: false,
                timer: 1500
            });
        }
        if (!price) {
            return Swal.fire({
                position: "center",
                icon: "warning",
                title: "Harga tidak boleh kosong!",
                showConfirmButton: false,
                timer: 1500
            });
        }

        const Form = new FormData();
        Form.append('image', image[0]);
        Form.append('code', code);
        Form.append('name', name);
            Form.append('serial_number', serialNumber);
            Form.append('model_barang', modelBarang);
            Form.append('lokasi_barang', lokasiBarang);
            Form.append('pengguna_barang', penggunaBarang);
            Form.append('kondisi_barang', kondisiBarang);
            Form.append('estimasi_tahun', estimasiTahun);
            Form.append('category_id', category_id);
            Form.append('unit_id', unit_id);
            Form.append('brand_id', brand_id);
            Form.append('price', price);

            $.ajax({
                url: `{{ route('barang.save') }}`,
                type: "POST",
                processData: false,
                contentType: false,
                dataType: 'json',
                data: Form,
                success: function(res) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#kembali').click();
                    // Reset fields
                    $("input[name='nama']").val(null);
                    $("input[name='kode']").val(null);
                    $("input[name='serial_number']").val(null);
                    $("input[name='model_barang']").val(null);
                    $("select[name='lokasi_barang']").val(null);
                    $("select[name='pengguna_barang']").val(null);
                    $("input[name='pengguna_barang_input']").val(null);
                    $("select[name='kondisi_barang']").val(null);
                    $("select[name='estimasi_tahun']").val(null);
                    $("#GetFile")[0].files = null;
                    $("select[name='jenisbarang']").val(null);
                    $("select[name='satuan']").val(null);
                    $("select[name='merk']").val(null);
                    $("input[name='jumlah']").val(0);
                    $("input[name='harga']").val(null);
                    $('#data-tabel').DataTable().ajax.reload();
                },
                error: function(err) {
                    console.error(err);
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Terjadi kesalahan saat menyimpan data!",
                        text: err.responseJSON.message || "Silakan coba lagi.",
                        showConfirmButton: true
                    });
                },
            });
    }


   



    //function ubah awal
    // function ubah() {
    //     const name = $("input[name='nama']").val();
    //     const code = $("input[name='kode']").val();
    //     const image = $("#GetFile")[0].files;
    //     const category_id = $("select[name='jenisbarang']").val();
    //     const unit_id = $("select[name='satuan']").val();
    //     const brand_id = $("select[name='merk']").val();
    //     const price = $("input[name='harga']").val();
    //     const quantity = $("input[name='jumlah']").val();
    //     // return console.log({name,code,category_id,unit_id,brand_id,price,quantity});
    //     const Form = new FormData();
    //     Form.append('id', $("input[name='id']").val());
    //     Form.append('image', image[0]);
    //     Form.append('code', code);
    //     Form.append('name', name);
    //     Form.append('category_id', category_id);
    //     Form.append('unit_id', unit_id);
    //     Form.append('brand_id', brand_id);
    //     Form.append('quantity', quantity);
    //     Form.append('price', price);
    //     $.ajax({
    //         url: `{{route('barang.update')}}`,
    //         type: "post",
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         data: Form,
    //         success: function(res) {
    //             Swal.fire({
    //                 position: "center",
    //                 icon: "success",
    //                 title: res.message,
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });
    //             $('#kembali').click();
    //             $("input[name='id']").val(null);
    //             $("input[name='nama']").val(null);
    //             $("input[name='kode']").val(null);
    //             $("#GetFile").val(null);
    //             $("select[name='jenisbarang']").val(null);
    //             $("select[name='satuan']").val(null);
    //             $("select[name='merk']").val(null);
    //             $("input[name='jumlah']").val(0);
    //             $("input[name='harga']").val(null);
    //             $('#data-tabel').DataTable().ajax.reload();
    //         },
    //         error: function(err) {
    //             console.log(err);
    //         },


    //     });
    // }
    
    //berfungsi namun error ketika tekan tombol simpan, error pada image dan harga
    // function ubah() {
    //     const name = $("input[name='nama']").val();
    //     const code = $("input[name='kode']").val();
    //     const serialNumber = $("input[name='serial_number']").val();
    //     const modelBarang = $("input[name='model_barang']").val();
    //     const lokasiBarang = $("select[name='lokasi_barang']").val();
    //     const penggunaBarang = $("select[name='pengguna_barang']").val() || $("input[name='pengguna_barang_input']").val();
    //     const kondisiBarang = $("select[name='kondisi_barang']").val();
    //     const estimasiTahun = $("select[name='estimasi_tahun']").val();
    //     const image = $("#GetFile")[0].files;
    //     const category_id = $("select[name='jenisbarang']").val();
    //     const unit_id = $("select[name='satuan']").val();
    //     const brand_id = $("select[name='merk']").val();
    //     const price = $("input[name='harga']").val();
    //     const quantity = $("input[name='jumlah']").val();

    //     const Form = new FormData();
    //     Form.append('id', $("input[name='id']").val());
    //     Form.append('image', image[0]); // Optional, can be null
    //     Form.append('code', code);
    //     Form.append('name', name);
    //     Form.append('serial_number', serialNumber);
    //     Form.append('model_barang', modelBarang);
    //     Form.append('lokasi_barang', lokasiBarang);
    //     Form.append('pengguna_barang', penggunaBarang);
    //     Form.append('kondisi_barang', kondisiBarang);
    //     Form.append('estimasi_tahun', estimasiTahun);
    //     Form.append('category_id', category_id);
    //     Form.append('unit_id', unit_id);
    //     Form.append('brand_id', brand_id);
    //     Form.append('quantity', quantity);
    //     Form.append('price', price);

    //     $.ajax({
    //         url: `{{ route('barang.update') }}`,
    //         type: "post",
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         data: Form,
    //         success: function(res) {
    //             Swal.fire({
    //                 position: "center",
    //                 icon: "success",
    //                 title: res.message,
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });
    //             $('#kembali').click();
    //             // Reset fields
    //             $("input[name='id']").val(null);
    //             $("input[name='nama']").val(null);
    //             $("input[name='kode']").val(null);
    //             $("input[name='serial_number']").val(null);
    //             $("input[name='model_barang']").val(null);
    //             $("select[name='lokasi_barang']").val(null);
    //             $("select[name='pengguna_barang']").val(null);
    //             $("input[name='pengguna_barang_input']").val(null);
    //             $("select[name='kondisi_barang']").val(null);
    //             $("select[name='estimasi_tahun']").val(null);
    //             $("#GetFile").val(null);
    //             $("select[name='jenisbarang']").val(null);
    //             $("select[name='satuan']").val(null);
    //             $("select[name='merk']").val(null);
    //             $("input[name='jumlah']").val(0);
    //             $("input[name='harga']").val(null);
    //             $('#data-tabel').DataTable().ajax.reload();
    //         },
    //         error: function(err) {
    //             console.log(err);
    //             Swal.fire({
    //                 position: "center",
    //                 icon: "error",
    //                 title: "Terjadi kesalahan saat memperbarui data!",
    //                 text: err.responseJSON.message || "Silakan coba lagi.",
    //                 showConfirmButton: true
    //             });
    //         },
    //     });
    // }

    function ubah() {
        const name = $("input[name='nama']").val();
        const code = $("input[name='kode']").val();
        const serialNumber = $("input[name='serial_number']").val();
        const modelBarang = $("input[name='model_barang']").val();
        const lokasiBarang = $("select[name='lokasi_barang']").val();
        const penggunaBarang = $("select[name='pengguna_barang']").val() || $("input[name='pengguna_barang_input']").val();
        const kondisiBarang = $("select[name='kondisi_barang']").val();
        const estimasiTahun = $("select[name='estimasi_tahun']").val();
        const image = $("#GetFile")[0].files; // Get the file input
        const category_id = $("select[name='jenisbarang']").val();
        const unit_id = $("select[name='satuan']").val();
        const brand_id = $("select[name='merk']").val();
        
        // Clean and convert the price input
        const price = parseFloat($("input[name='harga']").val().replace(/RP\.|\.|[^0-9]/g, "").trim()); // Remove 'RP.', dots, and non-numeric characters
        const quantity = $("input[name='jumlah']").val();

        const Form = new FormData();
        Form.append('id', $("input[name='id']").val());
        
        // Only append the image if a new file is selected
        if (image.length > 0) {
            Form.append('image', image[0]);
        }

        Form.append('code', code);
        Form.append('name', name);
        Form.append('serial_number', serialNumber);
        Form.append('model_barang', modelBarang);
        Form.append('lokasi_barang', lokasiBarang);
        Form.append('pengguna_barang', penggunaBarang);
        Form.append('kondisi_barang', kondisiBarang);
        Form.append('estimasi_tahun', estimasiTahun);
        Form.append('category_id', category_id);
        Form.append('unit_id', unit_id);
        Form.append('brand_id', brand_id);
        Form.append('quantity', quantity);
        Form.append('price', price); // Append the cleaned price

        $.ajax({
            url: `{{ route('barang.update') }}`,
            type: "post",
            contentType: false,
            processData: false,
            dataType: 'json',
            data: Form,
            success: function(res) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: res.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#kembali').click();
                // Reset fields
                $("input[name='id']").val(null);
                $("input[name='nama']").val(null);
                $("input[name='kode']").val(null);
                $("input[name='serial_number']").val(null);
                $("input[name='model_barang']").val(null);
                $("select[name='lokasi_barang']").val(null);
                $("select[name='pengguna_barang']").val(null);
                $("input[name='pengguna_barang_input']").val(null);
                $("select[name='kondisi_barang']").val(null);
                $("select[name='estimasi_tahun']").val(null);
                $("#GetFile").val(null);
                $("select[name='jenisbarang']").val(null);
                $("select[name='satuan']").val(null);
                $("select[name='merk']").val(null);
                $("input[name='jumlah']").val(0);
                $("input[name='harga']").val(null);
                $('#data-tabel').DataTable().ajax.reload();
            },
            error: function(err) {
                console.log(err);
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Terjadi kesalahan saat memperbarui data!",
                    text: err.responseJSON.message || "Silakan coba lagi.",
                    showConfirmButton: true
                });
            },
        });
    }



    $(document).ready(function() {
        $("#harga").on("input", harga);
        isi();

        $('#simpan').on('click', function() {
            if ($(this).text() === 'Simpan Perubahan') {
                ubah();
            } else {
                simpan();
            }
        });

        // $("#modal-button").on("click", function() {
        //     $("#item-count").hide();
        //     $("input[name='nama']").val(null);
        //     $("input[name='id']").val(null);
        //     $("input[name='kode']").val(null);
        //     $("#GetFile").val(null);
        //     $("select[name='jenisbarang']").val(null);
        //     $("select[name='satuan']").val(null);
        //     $("select[name='merk']").val(null);
        //     $("input[name='jumlah']").val(0);
        //     $("input[name='harga']").val(null);
        //     $("#simpan").text("Simpan");
        //     id = new Date().getTime();
        //     $("input[name='kode']").val("BRG-" + id);
        // });

        $("#modal-button").on("click", function() {
            $("#item-count").hide();
            $("input[name='nama']").val(null);
            $("input[name='id']").val(null);
            $("input[name='kode']").val(null);
            $("#GetFile").val(null);
            $("select[name='jenisbarang']").val(null);
            $("select[name='satuan']").val(null);
            $("select[name='merk']").val(null);
            $("input[name='jumlah']").val(0);
            $("input[name='harga']").val(null);
            $("#simpan").text("Simpan");
            
            // Set the image to default when adding new data
            $("#outputImg").attr("src", "{{ asset('default.png') }}");
            
            id = new Date().getTime();
            $("input[name='kode']").val("BRG-" + id);
        });


    });

    //yang awal kode-nya
    // $(document).on("click", ".ubah", function() {
    //     let id = $(this).attr('id');
    //     $("#modal-button").click();
    //     $("#item-count").show();
    //     $("#simpan").text("Simpan Perubahan");
    //     $.ajax({
    //         url: "{{route('barang.detail')}}",
    //         type: "post",
    //         data: {
    //             id: id,
    //             "_token": "{{csrf_token()}}"
    //         },
    //         success: function({
    //             data
    //         }) {
    //             $("input[name='id']").val(data.id);
    //             $("input[name='nama']").val(data.name);
    //             $("input[name='kode']").val(data.code);
    //             $("select[name='jenisbarang']").val(data.category_id);
    //             $("select[name='satuan']").val(data.unit_id);
    //             $("select[name='merk']").val(data.brand_id);
    //             $("input[name='jumlah']").val(data.quantity);
    //             $("input[name='harga']").val(data.price);
    //         }
    //     });


    // });

    // $(document).on("click", ".ubah", function() {
    //     let id = $(this).attr('id'); // Get the ID of the item to edit
    //     $("#modal-button").click(); // Open the modal
    //     $("#item-count").show(); // Show item count if needed
    //     $("#simpan").text("Simpan Perubahan"); // Change button text to indicate update

    //     $.ajax({
    //         url: "{{ route('barang.detail') }}", // Adjust the route as necessary
    //         type: "POST",
    //         data: {
    //             id: id,
    //             "_token": "{{ csrf_token() }}"
    //         },
    //         success: function({ data }) {
    //             // Populate the modal fields with the data returned from the server
    //             $("input[name='id']").val(data.id);
    //             $("input[name='nama']").val(data.name);
    //             $("input[name='kode']").val(data.code);
    //             $("input[name='serial_number']").val(data.serial_number); // New field
    //             $("input[name='model_barang']").val(data.model_barang); // New field
    //             $("select[name='lokasi_barang']").val(data.lokasi_barang); // New field
    //             $("select[name='pengguna_barang']").val(data.pengguna_barang); // New field
    //             $("select[name='kondisi_barang']").val(data.kondisi_barang); // New field
    //             $("select[name='estimasi_tahun']").val(data.estimasi_tahun); // New field
    //             $("select[name='jenisbarang']").val(data.category_id);
    //             $("select[name='satuan']").val(data.unit_id);
    //             $("select[name='merk']").val(data.brand_id);
    //             $("input[name='jumlah']").val(data.quantity);
    //             $("input[name='harga']").val(data.price);

    //             // Set the image source
    //             const imageUrl = data.image ? '{{ asset('storage/barang/') }}/' + data.image : '{{ asset('default.png') }}';
    //             $("#detail-image").attr("src", imageUrl);
    //         },
    //         error: function(err) {
    //             console.error(err);
    //             Swal.fire({
    //                 position: "center",
    //                 icon: "error",
    //                 title: "Terjadi kesalahan saat memuat data!",
    //                 text: "Silakan coba lagi.",
    //                 showConfirmButton: true
    //             });
    //         }
    //     });
    // });
    // $(document).on("click", ".ubah", function() {
    //     let id = $(this).attr('id'); // Get the ID of the item to edit
    //     $("#modal-button").click(); // Open the modal
    //     $("#item-count").show(); // Show item count if needed
    //     $("#simpan").text("Simpan Perubahan"); // Change button text to indicate update

    //     $.ajax({
    //         url: "{{ route('barang.detail') }}", // Adjust the route as necessary
    //         type: "POST",
    //         data: {
    //             id: id,
    //             "_token": "{{ csrf_token() }}"
    //         },
    //         success: function({ data }) {
    //             // Populate the modal fields with the data returned from the server
    //             $("input[name='id']").val(data.id);
    //             $("input[name='nama']").val(data.name);
    //             $("input[name='kode']").val(data.code);
    //             $("input[name='serial_number']").val(data.serial_number); // New field
    //             $("input[name='model_barang']").val(data.model_barang); // New field
    //             $("select[name='lokasi_barang']").val(data.lokasi_barang); // New field
    //             $("select[name='pengguna_barang']").val(data.pengguna_barang); // New field
    //             $("select[name='kondisi_barang']").val(data.kondisi_barang); // New field
    //             $("select[name='estimasi_tahun']").val(data.estimasi_tahun); // New field
    //             $("select[name='jenisbarang']").val(data.category_id);
    //             $("select[name='satuan']").val(data.unit_id);
    //             $("select[name='merk']").val(data.brand_id);
    //             $("input[name='jumlah']").val(data.quantity);
    //             $("input[name='harga']").val(data.price);

    //             // Set the image source
    //             const imageUrl = data.image ? '{{ asset('storage/barang/') }}/' + data.image : '{{ asset('default.png') }}';
    //             $("#outputImg").attr("src", imageUrl); // Show existing image
    //             $("#GetFile").val(null); // Reset file input
    //         },
    //         error: function(err) {
    //             console.error(err);
    //             Swal.fire({
    //                 position: "center",
    //                 icon: "error",
    //                 title: "Terjadi kesalahan saat memuat data!",
    //                 text: "Silakan coba lagi.",
    //                 showConfirmButton: true
    //             });
    //         }
    //     });
    // });

    $(document).on("click", ".ubah", function() {
        let id = $(this).attr('id'); // Get the ID of the item to edit
        $("#modal-button").click(); // Open the modal
        $("#item-count").show(); // Show item count if needed
        $("#simpan").text("Simpan Perubahan"); // Change button text to indicate update

        $.ajax({
            url: "{{ route('barang.detail') }}", // Adjust the route as necessary
            type: "POST",
            data: {
                id: id,
                "_token": "{{ csrf_token() }}"
            },
            success: function({ data }) {
                // Populate the modal fields with the data returned from the server
                $("input[name='id']").val(data.id);
                $("input[name='nama']").val(data.name);
                $("input[name='kode']").val(data.code);
                $("input[name='serial_number']").val(data.serial_number); // New field
                $("input[name='model_barang']").val(data.model_barang); // New field
                $("select[name='lokasi_barang']").val(data.lokasi_barang); // New field
                $("select[name='pengguna_barang']").val(data.pengguna_barang); // New field
                $("select[name='kondisi_barang']").val(data.kondisi_barang); // New field
                $("select[name='estimasi_tahun']").val(data.estimasi_tahun); // New field
                $("select[name='jenisbarang']").val(data.category_id);
                $("select[name='satuan']").val(data.unit_id);
                $("select[name='merk']").val(data.brand_id);
                $("input[name='jumlah']").val(data.quantity);
                $("input[name='harga']").val(data.price);

                // Set the image source
                const imageUrl = data.image ? '{{ asset('storage/barang/') }}/' + data.image : '{{ asset('default.png') }}';
                $("#outputImg").attr("src", imageUrl); // Show existing image
                $("#GetFile").val(null); // Reset file input
            },
            error: function(err) {
                console.error(err);
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Terjadi kesalahan saat memuat data!",
                    text: "Silakan coba lagi.",
                    showConfirmButton: true
                });
            }
        });
    });





    $(document).on("click", ".hapus", function() {
        let id = $(this).attr('id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success m-1",
                cancelButton: "btn btn-danger m-1"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Anda Yakin ?",
            text: "Data Ini Akan Di Hapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya,Hapus",
            cancelButtonText: "Tidak, Kembali!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{route('barang.delete')}}",
                    type: "delete",
                    data: {
                        id: id,
                        "_token": "{{csrf_token()}}"
                    },
                    success: function(res) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#data-tabel').DataTable().ajax.reload();
                    }
                });
            }
        });


    });

    // $(document).ready(function() {
        
    //     // Initialize Select2
    //     $('#pengguna_barang_select').select2({
    //         placeholder: "-- Pilih Pengguna --",
    //         ajax: {
    //             url: "{{ route('customer.names') }}", // Use the route to fetch customer names
    //             dataType: 'json',
    //             processResults: function(data) {
    //                 // Process the results into the format expected by Select2
    //                 return {
    //                     results: data.map(function(customer) {
    //                         return {
    //                             id: customer.name,
    //                             text: customer.name
    //                         };
    //                     })
    //                 };
    //             }
    //         }
    //     });


  

    //     // Show input field for new user
    //     $('#pengguna_barang_select').on('select2:select', function(e) {
    //         const selectedValue = e.params.data.id;
    //         if (selectedValue === "new") {
    //             $("input[name='pengguna_barang_input']").show();
    //         } else {
    //             $("input[name='pengguna_barang_input']").hide();
    //         }
    //     });
    // });


    
    
</script>


<script>
    // $(document).on("click", ".detail", function() {
    //     let id = $(this).attr('id');
    //     $.ajax({
    //         url: "{{ route('barang.detail') }}",
    //         type: "post",
    //         data: {
    //             id: id,
    //             "_token": "{{ csrf_token() }}"
    //         },
    //         success: function({ data }) {
    //             // Populate the modal with item details
    //             let detailHtml = `
    //                 <h5>${data.name}</h5>
    //                 <p><strong>${translations.code}: </strong>${data.code}</p>
    //                 <p><strong>${translations.category}: </strong>${data.category.name}</p>
    //                 <p><strong>${translations.unit}: </strong>${data.unit.name}</p>
    //                 <p><strong>${translations.brand}: </strong>${data.brand.name}</p>
    //                 <p><strong>${translations.initial_stock}: </strong>${data.quantity}</p>
    //                 <p><strong>${translations.price}: </strong>${data.price}</p>
    //             `;
    //             $("#detail-content").html(detailHtml);
    //             // Set the image source
    //             $("#detail-image").attr("src", data.image ? '{{ asset('storage/barang/') }}/' + data.image : '{{ asset('default.png') }}');

    //             // $("#detail-image").attr("src", data.image ? '{{ asset('storage/barang/') }}' + data.image : '{{ asset('default.png') }}');
    //             $("#DetailModal").modal('show'); // Show the modal
    //         },
    //         error: function(err) {
    //             console.log(err);
    //         }
    //     });
    // });

    // KODE YANG BERFGUNGSI 
    //     $(document).on("click", ".detail", function() {
    //     let id = $(this).attr('id'); // Get the ID of the item to view details
    //     $.ajax({
    //         url: "{{ route('barang.detail') }}", // Adjust the route as necessary
    //         type: "POST",
    //         data: {
    //             id: id,
    //             "_token": "{{ csrf_token() }}"
    //         },
    //         success: function({ data }) {
    //             // Populate the detail content
    //             let detailHtml = `
    //                 <h5>${data.name}</h5>
    //                 <p><strong>${translations.code}: </strong>${data.code}</p>
    //                 <p><strong>${translations.category}: </strong>${data.category.name}</p>
    //                 <p><strong>${translations.unit}: </strong>${data.unit.name}</p>
    //                 <p><strong>${translations.brand}: </strong>${data.brand.name}</p>
    //                 <p><strong>${translations.serial_number}: </strong>${data.serial_number}</p>
    //                 <p><strong>${translations.model_barang}: </strong>${data.model_barang}</p>
    //                 <p><strong>${translations.lokasi_barang}: </strong>${data.lokasi_barang}</p>
    //                 <p><strong>${translations.pengguna_barang}: </strong>${data.pengguna_barang}</p>
    //                 <p><strong>${translations.kondisi_barang}: </strong>${data.kondisi_barang}</p>
    //                 <p><strong>${translations.estimasi_tahun}: </strong>${data.estimasi_tahun}</p>
    //                 <p><strong>${translations.price}: </strong>${data.price}</p>
    //             `;
    //             $("#detail-content").html(detailHtml);
    //             // Set the image source
    //             $("#detail-image").attr("src", data.image ? '{{ asset('storage/barang/') }}/' + data.image : '{{ asset('default.png') }}');

    //             // Show the modal
    //             $("#DetailModal").modal('show');
    //         },
    //         error: function(err) {
    //             console.error(err);
    //             Swal.fire({
    //                 position: "center",
    //                 icon: "error",
    //                 title: "Terjadi kesalahan saat memuat detail!",
    //                 text: "Silakan coba lagi.",
    //                 showConfirmButton: true
    //             });
    //         }
    //     });
    // });

    $(document).on("click", ".detail", function() {
    let id = $(this).attr('id'); // Get the ID of the item to view details
    $.ajax({
        url: "{{ route('barang.detail') }}", // Adjust the route as necessary
        type: "POST",
        data: {
            id: id,
            "_token": "{{ csrf_token() }}"
        },
        success: function({ data }) {
            // Populate the detail content
            let detailHtml = `
                <h5>${data.name}</h5>
                <p><strong>${translations.code}: </strong>${data.code}</p>
                <p><strong>${translations.category}: </strong>${data.category.name}</p>
                <p><strong>${translations.unit}: </strong>${data.unit.name}</p>
                <p><strong>${translations.brand}: </strong>${data.brand.name}</p>
                <p><strong>${translations.serial_number}: </strong>${data.serial_number || 'N/A'}</p>
                <p><strong>${translations.model_barang}: </strong>${data.model_barang || 'N/A'}</p>
                <p><strong>${translations.lokasi_barang}: </strong>${data.lokasi_barang || 'N/A'}</p>
                <p><strong>${translations.pengguna_barang}: </strong>${data.pengguna_barang || 'N/A'}</p>
                <p><strong>${translations.kondisi_barang}: </strong>${data.kondisi_barang || 'N/A'}</p>
                <p><strong>${translations.estimasi_tahun}: </strong>${data.estimasi_tahun || 'N/A'}</p>
                <p><strong>${translations.price}: </strong>${formatIDR(data.price)}</p>

            `;
            $("#detail-content").html(detailHtml);

            // Set the image source
            const imageUrl = data.image ? '{{ asset('storage/barang/') }}/' + data.image : '{{ asset('default.png') }}';
            $("#detail-image").attr("src", imageUrl);

            // Show the modal
            $("#DetailModal").modal('show');
        },
        error: function(err) {
            console.error(err);
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Terjadi kesalahan saat memuat detail!",
                text: "Silakan coba lagi.",
                showConfirmButton: true
            });
        }
    });
});

// $(document).ready(function() {
//     // Initialize Select2
//     $('#pengguna_barang_select').select2({
//         placeholder: "-- Pilih Pengguna --",
//         ajax: {
//             url: "{{ route('customer.names') }}", // Use the route to fetch customer names
//             dataType: 'json',
//             processResults: function(data) {
//                 // Process the results into the format expected by Select2
//                 return {
//                     results: data.map(function(customer) {
//                         return {
//                             id: customer.name,
//                             text: customer.name
//                         };
//                     })
//                 };
//             }
//         }
//     });
// });



</script>

<script>
    var translations = {
        code: "{{ __('Code') }}",
        serial_number : "{{ __('serial_number') }}",
        model_barang: "{{ __('model_barang') }}",
        lokasi_barang: "{{ __('lokasi_barang') }}",
        pengguna_barang : "{{ __('pengguna_barang') }}",
        kondisi_barang : "{{ __('kondisi_barang') }}",
        estimasi_tahun : "{{ __('estimasi_tahun') }}",
        category: "{{ __('Category') }}",
        unit: "{{ __('Unit') }}",
        brand: "{{ __('Brand') }}",
        // initial_stock: "{{ __('Initial Stock') }}",
        price: "{{ __('Price') }}",
        close: "{{ __('Close') }}",
        item_details: "{{ __('Item Details') }}"
    };
</script>

@endsection