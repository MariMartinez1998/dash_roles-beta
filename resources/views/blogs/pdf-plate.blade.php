<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report of Services</title>

</head>

<style>
@page {
    margin-left: 0;
    margin-right: 0;
    text-align: left;
    font-size: 10px;
    border-width: 1px;

}

table {
    background-color: white;
    align: left;
    width: 500px;
}

h1,
th,
td {

    padding: 10px;
    align: center;
}

thead {
    background-color: #808080;
    border-bottom: solid 5px #292727;
    color: white;
}

#emp {
    font-family: Arial;
    border-collapse: collapse;
    width: 100;
}

#emp td,
#emp th {
    border: 1px solid #ddd;
    padding: 8px;
}

#emp th {
    padding-top: 12px;
    padding-bottom: 12px;

}
</style>



<body>
    <header>
        <br>
        <h5 style="text-align: center"><strong>Service Report</strong></h5>
    </header>


    <div class="container">
        <table style="text-align: center;">

            <tr>
                <td><img width="150" src="img/logo.png" alt=""></td>
                <td><h2>Mk Collisions</h2></td>
            </tr>
        </table>

        <div class="container">
            <table id="emp" style="margin: 2 auto;">
                <thead class="thead-dark">
                    <tr>
                        <th style="display:none;">ID</th>
                        <th scope="col">Plate</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Time in check</th>
                        <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">Zip Code</th>
                        <th scope="col">Vin</th>
                        <th scope="col">Model</th>
                        <th scope="col">Make</th>
                        <th scope="col">Colour</th>
                        <th scope="col">Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                        <td style="display:none;">{{ $blog->id }}</td>
                        <td>{{ $blog->id_plate }}</td>
                        <td>{{ $blog->titulo }}</td>
                        <td>{{ $blog->contenido }}</td>
                        <td>{{ $blog->name }} {{ $blog->last_name }}</td>
                        <td>{{ $blog->phone }}</td>
                        <td>{{ $blog->created_at }}</td>
                        <td>{{ $blog->city }}</td>
                        <td>{{ $blog->state }}</td>
                        <td>{{ $blog->zip_code }}</td>
                        <td>{{ $blog->vin }}</td>
                        <td>{{ $blog->model }}</td>
                        <td>{{ $blog->make }}</td>
                        <td>{{ $blog->color }}</td>
                        <td>{{ $blog->year }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
</body>

</html>