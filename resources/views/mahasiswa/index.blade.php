
@extends('layout.template')     
        <!-- START DATA -->
@section('konten')
<div id="demo">
    <h2>The XMLHttpRequest Object</h2>
    <button type="button" onclick="loadDoc()">Change Content</button>
    </div>
<div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
        <div class="pb-3">
          <form class="d-flex" action="" method="get">
              <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
              <button class="btn btn-secondary" onclick="cari()" type="submit">Cari</button>
          </form>
        </div>
<livewire:counter />
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
          <a href='{{url('mahasiswa/create')}}' class="btn btn-primary">+ Tambah Data</a>
        </div>
  
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">NIM</th>
                    <th class="col-md-4">Nama</th>
                    <th class="col-md-2">Jurusan</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $data->firstItem() ?>
                @foreach ($data as $item)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$item->nim}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->jurusan}}</td>
                    <td>
                        <a href='{{url('mahasiswa/'.$item->nim.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                        <form onsubmit="return confirm('Yakin Akan Menghapus Data ?')" class='d-inline' action="{{url('mahasiswa/'.$item->nim)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        {{$data->withQueryString()->links()}}
       
  </div>
  <!-- AKHIR DATA -->
@endsection

@push('scripts')
<script>
    function loadDoc() {
  const xhttp = new XMLHttpRequest();
  xhttp.responseType = 'json';
  xhttp.onload = function() {
    document.getElementById("demo").innerHTML =
    this.respon.nama;
  }
  xhttp.open("GET", "/getmsg");
  xhttp.send();
}

    function cari() {
        event.preventDefault();
        katakunci = document.querySelector('input[name=katakunci]').value;

        const xhttp = new XMLHttpRequest();
        xhttp.responseType = 'json';
        xhttp.onload = function() {
            data = this.response;
            tbody = document.getElementByTagName("tbody");
            tbody.innerHTML = populateTable(data);
        }
        xhttp.open('GET',"/mahasiswa/cari/" + katakunci, true);
        xhttp.send();

        return false;
    }

    function populateTable(jsonData){
        var table = document.querySelector('table');

        var tableBody = table.querySelector('tbody');
        tableBody.innerHTML = '';

        var i = 1;
        jsonData.forEach(item)=>{
            var row = document.createElement('tr');

            barisData(item, i, row);
            tableBody.appendChild(row);
        }

    }

    function barisData(item,i,row){
        var noCell = document.createElement('td');
        noCell.textContent = i++;
        row.appendChild(noCell);
        
        var nimCell = document.createElement('td');
        nimCell.textContent = item.nim;
        row.appendChild(nimCell);
        
        var namaCell = document.createElement('td');
        namaCell.textContent = item.nim;
        row.appendChild(namaCell);

        var jurusanCell = document.createElement('td');
        jurusanCell.textContent = item.nim;
        row.appendChild(jurusanCell);
        
        var aksiCell = document.createElement('td');
        aksiCell.innerHTML = '<a href="" class="btn btn-warning btn-sm">Edit</a>'
        '<a href="" class="btn btn-warning btn-sm">Del</a>';

        row.appendChild(aksiCell);
    }
</script>
@endpush
