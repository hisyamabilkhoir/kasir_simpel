@extends('template')

@section('content_section')

<!-- Modal Charge-->
<div class="modal fade" id="chargeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Charge</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <h3 class="text-center">Total Pembelian : Rp <span id="pay_charge"></span></h3>
                </div>
                <hr>
                <div class="form-group mb-3">
                    <label for="pay" class="mb-2"> Masukan Jumlah Uang </label>
                    <input type="text" class="form-control" name="pay" id="pay"
                        placeholder="Masukan Jumlah Uang . . . " required autocomplete="off">
                </div>
                <hr>
                <div class="form-group">
                    <h5 class="text-danger text-end">Kembalian: Rp <span id="kembali">0</span></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Save Bill-->
<div class="modal fade" id="saveBillModal" tabindex="-1" aria-labelledby="saveBillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h1 class="modal-title fs-5" id="saveBillModalLabel">Berhasil</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Data Keranjang Berhasil Disimpan !
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  
<div class="row">
    <div class="col-12 p-0">
        @if(session('success'))
            <div class="alert alert-success text-center">
            {{ session('success') }}
            </div> 
        @endif
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3 pb-4">
                    <a href="{{ url('/cashier/add_to_cart/' . $product->id) }}" style="text-decoration: none">
                        <div class="card">
                            <img height="140" width="80" src="{{ url('products/' . $product->picture) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title m-0">{{ $product->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-4">
        <div class="row">
            <div class="col-2 text-center rounded-start-1"
                style="background-color: rgb(81, 149, 250); color: rgb(0, 84, 209);">
                <i class="bi bi-person-circle h1"></i>
                <br>
                <small>Customer</small>
            </div>
            <div class="col-8 text-center" style="background-color: rgb(160, 195, 247);">
                <h1 class="p-2">New Customer</h1>
            </div>
            <div class="col-2 text-center rounded-end-1"
                style="background-color: rgb(81, 149, 250); color: rgb(0, 84, 209);">
                <i class="bi bi-list-ul h1"></i>
                <br>
                <small>Bill List</small>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <div class="card p-0 m-0">
                    <div class="card-body text-center h6">
                        <select style="border: none;">
                            <option value="">Dine In</option>
                            <option value="">Lainya</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;" cellpadding="7">
                            <tr class="text-primary">
                                <th style="width: 50%;">1</th>
                                <th style="width: 20%;" class="text-end"></th>
                                <th style="width: 30%;" class="text-end">View Table</th>
                            </tr>
                            @php $total = 0 @endphp
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $product)
                                    <tr>
                                        <td>{{ $product['name'] }}</td>
                                        <?php
                                            if($product['quantity'] > 1) {
                                                $quantity = 'x ' . $product['quantity'];
                                            } else {
                                                $quantity = '';
                                            }
                                        ?>
                                        <td class="text-end">{{ $quantity }}</td>
                                        <td class="text-end">Rp. {{ number_format($product['price'], 0, ',', '.') }}</td>
                                    </tr>
                                    @php $total += $product['price'] * $product['quantity'] @endphp
                                @endforeach
                            @endif
                            <tr>
                                <td style="font-weight: bold">Sub-Total :</td>
                                <td class="text-end"></td>
                                <td style="font-weight: bold" class="text-end">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Total :</td>
                                <td class="text-end"></td>
                                <td style="font-weight: bold" class="text-end">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <form action="<?= url('/cashier/cart_remove'); ?>" method="post">
                    @method('delete')
                    @csrf
                    <div class="card">
                        <div class="card-body text-center">
                            <button style="background: none; border: none;outline: none; box-shadow: none;" onclick="return confirm('Apakah anda yakin ingin menghapus keranjang ?')">
                                <h6 class="text-danger">Clear Sale</h6>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-body text-center">
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6 pt-0" style="padding-left: 0; padding-right: 1px;">
                <div class="p-3 rounded-start-2" style="background-color: rgb(160, 195, 247);">
                    <div class="p-3-body">
                        <h4 type="button" data-bs-toggle="modal" data-bs-target="#saveBillModal">Save Bill</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 pt-0" style="padding-right: 0;  padding-left: 1px;">
                <a href="{{ url('/cashier/bill/print') }}" target="_blank" style="text-decoration: none">
                    <div class="p-3 rounded-end-2" style="background-color: rgb(160, 195, 247);">
                        <h4 class="text-black">Print Bill</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-0 text-center text-white">
            <div class="col-2" style="padding-left: 0; padding-right: 1px;">
                <div class="p-1 rounded-start-2" style="background-color: blue">
                    <i class="bi bi-cash h2"></i>
                    <br>
                    <small>Pay</small>
                </div>
            </div>
            <div class="col-10" style="padding-right: 0;  padding-left: 1px;">
                <div class="p-3 rounded-end-2" style="background-color: blue">
                    <div class="p-3-body">
                        <h4 type="button" data-bs-toggle="modal" onclick="charge('<?= $total ?>')"
                        data-bs-target="#chargeModal" >Charge Rp. {{ number_format($total, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_section')
<script type="text/javascript">
    function charge(total) {
        const element_pay_charge = document.getElementById("pay_charge");
        element_pay_charge.innerHTML = formatRupiah(String(total));

        let rupiah = document.getElementById('pay');
        let kembali = document.getElementById('kembali');

        rupiah.addEventListener('keyup', function(e) {
            // gunakan fungsi formatRupiah() untuk mengubah nominal angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value);
            let formatKembali = kembalian(rupiah.value, total);
            if (formatKembali > 0) {
                formatKembali = formatRupiah(String(formatKembali));
                kembali.innerHTML = formatKembali;
            } else {
                kembali.innerHTML = '0';
            }
        });

        function kembalian(angka, total) {
            let harga = angka.split(".");
            let bayar = '';
            for (let indeks = 0; indeks < harga.length; indeks++) {
                bayar += harga[indeks];
            }
            totalKembali = bayar - total;
            return totalKembali;
        }

        /* Fungsi formatRupiah */
        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }
    }
</script>
@endsection