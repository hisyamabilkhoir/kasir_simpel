@extends('template')

@section('content_section')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Menu</h5>
                  <p class="card-text">Ini berisi tentang pengelolaan menu makanan/minuman</p>
                  <a href="{{ url('product') }}" class="btn btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Kasir</h5>
                  <p class="card-text">Ini Berisi mode kasir untuk pembelian menu makanan/minuman</p>
                  <a href="{{ url('cashier') }}" class="btn btn-primary">Lihat Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection