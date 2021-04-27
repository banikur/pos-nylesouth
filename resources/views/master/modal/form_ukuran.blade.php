<form id="formAdd" method="post" action="">
    @csrf
    <div class="modal-body">
        <div class="card">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                    </h3>
                </div>
            </div>
            <div class="form-group row" style="display: none;">
                <label class="col-2 col-form-label">Jenis Ukuran</label>
                <div class="col-10">
                    <input class="form-control" type="hidden" id="id_ukuran" name="id_ukuran" />
                    <input class="form-control" type="text" value="" id="ukuran" name="ukuran" placeholder="Ukuran" maxlength="2" />
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="tb_basic1">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode Ukuran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <?php $uk = get_master_ukuran();
                        $no = 1; ?>
                        <tbody>
                            @foreach($uk as $d)
                            <tr style="text-align: center;vertical-align: middle;">
                                <td style="width: 2%;">{{$no++}}</td>
                                <td>{{$d->nama_ukuran}}</td>
                                <td>
                                    <button class="btn btn-light btn-icon btn-circle btn-sm" data-toggle="tooltip" title="Ubah"><i class="flaticon2-edit text-warning"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold" onclick="reset()" data-dismiss="modal">Tutup</button>
        <!-- <button type="submit" onclick="confirm()" class="btn btn-primary font-weight-bold">Simpan</button> -->
    </div>
</form>

<script>
    $('#tb_basic1').DataTable();
</script>