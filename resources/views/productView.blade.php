<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">ABC Store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/product">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/category">Categories</a>
      </li>
    </ul>
    <span class="navbar-text">
    @auth
    <form action="logout" method="post">
    @csrf
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
    </form>
    @endauth

    @guest
    <a class="btn btn-outline-success my-2 my-sm-0" href="/logout">Login</a>
    @endguest
    </span>
    
  </div>
</nav>

    <div class='container mt-5'>
        <div class='row'>
            <div class='col-md'>
                <h3 class='text-dark mb-2 text-center'>Products</h3>
                <a class="btn btn-primary mb-5"  href="/product/create">Add Product</a>
                <div>
                <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">CategoryName</th>
                    <th scope="col">ProductName</th>
                    <th scope="col">Edit/Delete</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($data as $product )
                    <tr>
                    <th scope="row">{{ $product['id']}}</th>
                    <td>{{ $product['category']}}</td>
                    <td>{{ $product['productName']}}</td>
                    <td>
                    <a href="/product/{{$product['id']}}/edit" class="btn btn-dark">Edit</a>
                    
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteConfModal">Delete</button>
                    
                    </td>
                    </tr>
                @endforeach
                </tbody>

                </table>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="deleteConfModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="/product/{{$product['id']}}/" method="post">
  @method('DELETE')
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this product
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-danger" type="submit">Delete</button>
      </div>
    </div>
    </form>
  </div>
</div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</body>
</html>