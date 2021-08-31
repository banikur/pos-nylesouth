<form id="formAdd" method="post" action="{{route('transaksi.update_modal_return')}}">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="kode_pelanggan" value="{{$kode_pelanggan}}">
        <div class="row">
            <div class="col-sm-12">
                <select id="produkReturn" name="produkReturn" class="form-control select2">
                    <option value="" selected>--Pilih BARANG--</option>
                    @foreach($pemesanan as $p)
                    <?php $produk = get_master_produk_id(base64_encode($p->kode_produk)) ?>
                    <option value="{{$p->kode_produk}}"> {{$produk->nama_produk}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div id="DeskripsiReturn">
                
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger font-weight-bold" onclick="refresh()" data-dismiss="modal">Batal</button>
        <button type="button" onclick="update_modal()" class="btn btn-primary font-weight-bold">Return</button>
    </div>
</form>


<script>
    $('#produkReturn').on('change', function() {
        var kode_produk = $(this).val();
        var kode_pelanggan = '{{$kode_pelanggan}}';
        if(kode_produk != ''){
            $.ajax({
                url: "{{route('transaksi.get_produk_in_keranjang')}}",
                data: {
                    kode_pelanggan: kode_pelanggan,
                    kode_produk: kode_produk,
                },
                success: function(data) {
                    $('#DeskripsiReturn').html(data);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }else{
            $('#DeskripsiReturn').hide();
        }
    });

    function update_modal() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        var produkReturn = $('#produkReturn').text();
        Swal.fire({
            title: 'Ingin Return Barang?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            var produk =  $('#produkReturn').val();
            var kode_warna = $('#kode_warna').val();
            var kode_ukuran = $('#kode_ukuran').val();
            var alasan = $('#alasan').val();
            if (result.value) {
                if(produk == ''){
                    Swal.fire({
                        title: "Belum Pilih Produk",
                        type: "error",
                        allowOutsideClick: false,
                    })
                }else if(kode_warna == ''){
                    Swal.fire({
                        title: "Belum Pilih Warna",
                        type: "error",
                        allowOutsideClick: false,
                    })
                }else if(kode_ukuran == ''){
                    Swal.fire({
                        title: "Belum Pilih Ukuran",
                        type: "error",
                        allowOutsideClick: false,
                    })
                }else if(alasan == ''){
                    Swal.fire({
                        title: "Belum isi Alasan",
                        type: "error",
                        allowOutsideClick: false,
                    })
                }else{
                    form.submit();
                }
            } else {
                Swal.fire({
                    title: "Batal Ubah Data",
                    type: "error",
                    allowOutsideClick: false,
                })
                // refresh();
            }
        })

    }
</script>