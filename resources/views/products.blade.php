@extends('template')

@section('content_section')
<!-- Modal Add-->
<form action="{{ url('/product/add') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input required type="text" name="name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input required type="number" min="0" name="price" class="form-control" id="price">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input class="form-control" type="file" name="image" id="image" onchange="gambar1(this);" accept=".png,.jpeg,.jpg" required>
                </div>           
                <script>
                    function gambar1(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#G1')
                                    .attr('src', e.target.result)
                                    .attr('class', 'img-thumbnail')
                                    .width(150)
                                    .height(150);
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
                <img src="" id="G1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add-->

<!-- Modal Edit-->
<form action="{{ url('/product/update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="editId">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input required type="text" name="name" class="form-control" id="editName">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input required type="number" min="0" name="price" class="form-control" id="editPrice">
                </div>
                <div class="mb-3">
                    <input type="hidden" name="pictureOld" id="editPictureOld">
                    <label for="image" class="form-label">Gambar</label>
                    <input class="form-control" type="file" name="image" id="image" onchange="gambar2(this);" accept=".png,.jpeg,.jpg">
                </div>           
                <script>
                    function gambar2(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#editPicture')
                                    .attr('src', e.target.result)
                                    .attr('class', 'img-thumbnail')
                                    .width(150)
                                    .height(150);
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
                <div class="mb-3">
                    <img src="" id="editPicture" class="img-thumbnail" width="150" height="150">
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="show" id="show" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Show</label>
                </div>                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit-->

<div class="col-12">
    <?php if (session('msg_status')) : ?>
    <div class="alert alert-<?= session('msg_status') ?> alert-dismissible fade show" role="alert">
        <?= session('msg') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card full-height">
            <div class="card-header">
                <div class="card-title">
                    Data Menu
                    <!-- Button trigger modal -->
                    <button class="btn btn-primary float-end btn-round ml-auto" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        <i class="fa fa-plus"></i>
                        Tambah Menu
                    </button>
                </div>
            </div>
             <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables-default" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Show</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $d = 0;
                            foreach ($products as $product) {
                                $d++;
                            ?>
                                <tr>
                                    <td class='text-center'><?= $d ?></td>
                                    <td><?= $product->name ?></td>
                                    <td class='text-end'>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="text-center"><img height="50" width="100" src="{{ url('products/' . $product->picture) }}" class="" alt="{{ $product->name }}"></td>
                                    <td class="text-center">
                                        <?php if($product->show == 1) : ?>
                                            <i class="bi bi-check2 text-success"></i>
                                        <?php else : ?>
                                        <i class="bi bi-x text-danger"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class='text-center'>
                                        <a href="javascript:void(0)" onclick="editProduct('<?= url('products') . '/' .  $product->picture ?>','<?= $product->id ?>','<?= $product->name ?>','<?= $product->price ?>','<?= $product->show ?>','<?= $product->picture ?>')" title="Edit" data-bs-toggle="modal" data-bs-target="#modalEdit" class="btn btn-success btn-sm text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="<?= url('product/delete/' . $product->id); ?>" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm text-white" onclick="return confirm('Apakah anda yakin ingin menghapus menu : <?= $product->name ?> ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_section')
<script type="text/javascript">
    function editProduct(picture, id, name, price, show, picture_old) {
        $('#editPicture').attr('src', picture)
        $("#editId").val(id)
        $("#editName").val(name)
        $("#editPrice").val(price)
        if (show == 1) {
            $('#show').attr('checked', true)
        } else {
            $('#show').attr('checked', false)
        }
        $("#editPictureOld").val(picture_old)

    }
</script>
@endsection