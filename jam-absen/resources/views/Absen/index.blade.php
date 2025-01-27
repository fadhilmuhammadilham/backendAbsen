<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Absen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="bg-light">
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{$item}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action='/postAbsen' method='post'>
                @csrf
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama' id="nama">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="status_waktu" class="col-sm-2 col-form-label">Jam Masuk</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status_waktu" id="tepat_waktu" value="tepat_waktu"  checked>
                            <label class="form-check-label" for="tepat_waktu">
                                Tepat Waktu
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status_waktu" id="terlambat" value="terlambat">
                            <label class="form-check-label" for="terlambat">
                                Terlambat
                            </label>
                        </div>                            
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Terlambat</th>
                        <th>Jam Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item['nama']}}</td>
                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d') }}</td>
                        <td>{{$item['jam_masuk']}}</td>
                        <td>{{$item['jam_telat']}}</td>
                        <td>{{$item['jam_keluar']}}</td>
                        <td>
                            <a href="{{ url('absen/edit/'.$item['id'])}}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ url('absen/'.$item['id']) }}" method="POST" onsubmit=" confirm('apakah anda yakin ingin menghapus data?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                            </form>        
                            @if (!$item['jam_keluar'])
                            <a href="{{ url('absen/jamkeluar/edit/'.$item['id']) }}" class="btn btn-primary btn-sm">Keluar</a>
                            @endif                     
                        </td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</body>

</html>
