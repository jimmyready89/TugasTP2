@extends('Layout')

@section('content')
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <img class="logo-img" src="./assets/images/logo-invoice-model.png" alt="logo">
            </div>
            <div class="card-body">
                <form action="./login" method="post">
                    <input class="d-none" type="password">
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="password" type="password" placeholder="Password" autocomplete="off">
                    </div>
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Sign in
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection