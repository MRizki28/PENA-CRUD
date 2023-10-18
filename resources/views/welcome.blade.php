<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="{{ route('createData') }}" method="POST">
            @csrf
            <div class="mt-5">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input class="form-control" type="text" name="nama_mahasiswa" id="nama_mahasiswa">
            </div>
            <div class="mt-5">
                <label for="nim">Nim</label>
                <input class="form-control" type="text" name="nim" id="nim">
            </div>
            <div class="footer mt-2 d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Kirim</button>
            </div>
        </form>

        <div>
            <table class="table table-bordered " id="table">
                <thead>
                    <th>No</th>
                    <th>Nama mahasiswa</th>
                    <th>Nim</th>
                </thead>
                <tbody id="render">
                </tbody>
            </table>
        </div>
    </div>

    @include('sweetalert::alert')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        $.ajax({
            type: "GET",
            url: "{{ url('api/mahasiswa') }}",
            dataType: "JSON",
            success: function(response) {
                let tableBody = "";
                $.each(response.data, function(index, item) {
                    tableBody += '<tr>'
                    tableBody += '<td>' + (index + 1) + '</td>'
                    tableBody += '<td>' + item.nama_mahasiswa + '</td>'
                    tableBody += '<td>' + item.nim + '</td>'
                    tableBody += '</tr>'
                });
                $('#table tbody').append(tableBody);
            }
        });
    </script>
</body>

</html>
