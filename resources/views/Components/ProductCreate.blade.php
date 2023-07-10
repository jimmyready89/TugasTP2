@extends('Layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Product Create Dummy</h5>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Validate Price</th>
                                    <th scope="col">Create</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">User Create</th>
                                    <th scope="col">User Update</th>
                                    <th>Add To Cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>123-KVB-001</td>
                                    <td>Life Buoy</td>
                                    <td>Rp. 10.000</td>
                                    <td>12 Agustus 2023</td>
                                    <td>Admin</td>
                                    <td>Admin</td>
                                    <td>Admin</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-primary">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
