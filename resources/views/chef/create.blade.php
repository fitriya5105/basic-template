@extends('layouts.template')

@section('konten')

  
    <!-- Navbar -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">   
    <!-- End Navbar -->
    
    <hr class="dark horizontal my-0">
            <hr class="dark horizontal my-0">
       
      
    </div>
  </main>
  
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
        
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <div class="container">
                        <div class="d-flex flex-column">                            
                
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                
                                <form action="{{ route('chef.store') }}" method="post" enctype="multipart/form-data">
                                    
                
                                @csrf
                                <h5 style="color: black; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">nama</h5>
                                <input type="text" name="nama" id="image_name" class="w-50 mb-3 text-gray-900 outline-primary " value="{{old('nama')}}">
                                <h5 style="color: black; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">Image</h5>
                                <img class="img-preview img-fluid mb-3 col-sm-1">
                                <input type="file" name="image" id="image" class="mb-3 w-25" onchange="previewImage()" style="background-color: black">
                                <div class="d-flex justify-content-between">                                   
                                    <div>
                                        <button type="submit" class="btn btn-dark" style="background-color:black;">
                                          Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    
           

 
  <!--   Core JS Files   -->
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