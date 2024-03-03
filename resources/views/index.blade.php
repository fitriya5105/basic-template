
    

              @extends('layouts.template')

              @section('konten')
              <!-- START DATA --> 
              <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                    <form class="d-flex" action=""method="get">
                        <input class="form-control me-1" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}" placeholder="Masukan kata kunci" aria-label="Search">
                        <button class="btn btn-secondary"type="submit">Cari</button>
                    </form>
                   </div>

                   <!-- TOMBPL TAMBAH DATA -->
                   <div class="pb-3">
                    <a href="{{url('siswa/create')}}" class="btn btn-primary">+ Tambah Data</a>
                  </div>

                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">NO</th>
                            <th class="col-md-3">NIS</th>
                            <th class="col-md-4">NAMA</th>
                            <th class="col-md-2">Jurusan</th>
                            <th class="col-md-2">Aksi</th>
                          </tr>
                      </thead>
                    <tbody>
                        <?php $i =$data->firstItem()?>
                         @foreach($data as $item)
                           <tr>
                            <td>1</td>
                            <td>{{$item->nis}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->jurusan}}</td>
                            <td>
                                <a href="{{ url('siswa/'.$item->nis.'/edit') }}"
                                class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit ="return confirm ('Yakin akan menghapus data?')"
                                class='d-inline' action="{{ URL ('siswa/'.$item->nis) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                            </form>
                              </td>
                            </tr>
                            <?php $i++?>
                            @endforeach
                      </tbody>
                 </table>
             {{$data->withQueryString()->links()}}
            </div>
           <!-- AKHIR DATA --> 
@endsection
  