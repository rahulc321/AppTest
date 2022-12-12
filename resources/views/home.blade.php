<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
</head>
<body style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg');
            height: 100vh">

<div class="container">

<li> {{ Auth::user()->name }}</li>
<a href="{{url('/custom-logout')}}" class="" style="float: right">Logout</a>
  <h2>List Books Data</h2>
  <a href="{{url('/importData')}}" class="" style="float: right">Import Data From Api</a>
  <br>
  <br>
  <br>

  @if(Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif

                    @if(Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
  <table class="table table-bordered" id="dataTable">
    <thead>
      <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Authers</th>
        <th>Thumbnail</th>
        <th>Small Thumbnail</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
      <tr>
        <td>{{$book->bookId}}</td>
        <td>{{$book->title}}</td>
        <td>{{$book->authors}}</td>
        <td><img src="{{$book->thumbnail}}" style="width: 51px;border-radius: 11px;"></td>
        <td><img src="{{$book->smallThumbnail}}" style="width: 51px;border-radius: 11px;"></td>
        <td><a href="{{url('/delete',[$book->id])}}">Delete</a></td>
         
      </tr>
    @endforeach 
    </tbody>
  </table>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
</body>
</html>

