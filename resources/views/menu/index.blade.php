
    

              @extends('layouts.template')

@section('konten')
{{-- Star Data --}}
<div class="d-flex justify-content-center align-items-center my-3">
   
    <form class="d-flex" action="" method="get">
    </form>
</div>
</div>
    <div class=" p-3 bg-body rounded shadow-sm">        
    
    {{-- tombol tambah data --}}
    <div class="pb-3">
        <a href='{{url('menu/create')}}' class="btn btn-dark">+ Tambah Data</a>
    </div>

<hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-1">No Menu</th>
                <th class="col-md-3">Nama Menu</th>
                <th class="col-md-4">deskripsi</th>
                <th class="col-md-2">harga</th>
                <th class="col-md-2">gambar</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
  
            @foreach ($menu as $item)
            
            
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->no_menu}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->price}}</td>
                <td> <img style="max-width:2cm;" src="{{ asset("menu-images/$item->image") }}" </td>

      
                <td>
                    <a href="{{ route('menu.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form  onsubmit="return confirm ('yakin nih mau hapus?')" class="d-inline" action="{{ route('menu.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
                </td>                
            </tr>
        
            @endforeach
        </tbody>
    </table>
 
    
</div>

<!-- AKHIR DATA --> 
@endsection
