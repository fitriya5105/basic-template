@extends('layouts.template')
@section('konten')

@if ($errors->any())
<div class="pt-8">
    <div class="alert alert-danger">
        <ul>
            @foreach ($data as $item)
            <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
</div>

@endif
<!-- START FORM --> 
<form action="{{url('siswa/'.$data->nis)}}" method='post'>
    @csrf
    @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{url('siswa')}}" class="btn btn-secondary"> Kembali </a>
            
            <div class="mb-3 row">
                <label for="nis" class="col-sm-2 col-form-label" >NIS</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name='nis' value="{{$data->nis}}" id="nis" readonly>
                  </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" name="nama" class="col-sm-2 col-form-label" value="{{$data->nama}}">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama' value="{{$data->nama}}" id="nama" >
                   </div>
                </div>
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='jurusan' value="{{$data->jurusan}}" id="jurusan">
                    </div>
                </div>    
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
                 </div>
               </form>
              </div>
              <!-- AKHIR FORM --> 
@endsection