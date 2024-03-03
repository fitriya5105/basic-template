@extends('layouts.template')

@section('konten')
<div class="container-fluid px-2 px-md-1">
    <div class="card-header p-0 position-relative mt-4 mx-3 z-index-2">
        <div class="bg-gradient-dark shadow-dark border-radius-md pt-4 pb-3">                  
            <h5 class="text-white text-capitalize ps-3 mt-2">Edit menu</h5>
        </div>
    </div>
    <div class="card card-body mx-3 mx-md-4 ">
        <div class="row gx-4 mb-2">
            <div class="col-lg-12">
                <div class="card-body px-0 pb-2">
                    <!-- ... Bagian sebelumnya ... -->
                    <div class="row justify-content-center">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('chef.update', $chef->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <h5 style="color: black; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">nama</h5>
                            <input type="text" name="nama" id="image_name" class="w-50 mb-3 text-gray-900 outline-primary" value="{{$chef->nama}}">
                            <h5 style="color: black; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">Image</h5>
                            <img class="img-preview img-fluid mb-3 col-sm-1">
                            <input type="file" name="image" id="image" class="mb-3 w-25" onchange="previewImage()" style="background-color: black">

                            <!-- Baris Tambahan untuk Image -->

                            <!-- Tombol Save -->
                            <div class="row ">
                                <div class="col-md-6 ">
                                    <button type="submit" class="btn btn-dark fw-bold w-50 mt-2" style="background-color: black; ">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Core JS Files -->
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';

        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);

        ofReader.onload = function (ofREvent){
            imgPreview.src = ofREvent.target.result;
        }
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>
@endsection
