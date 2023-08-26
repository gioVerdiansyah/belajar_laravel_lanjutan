<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="@yield('cdn')"/>
  <title>@yield('title')</title>
</head>
<body>
    <div class="container mt-3">
        <div class="row">
          <div class="col-12">

          <div class="py-4">
            <h2>Tabel Matakuliah</h2>
          </div>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>IPK</th>
                <th>Created At</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody>
              @yield('data')
            </tbody>
          </table>
          @yield('pagination')
          </div>
        </div>
      </div>
</body>
</html>
