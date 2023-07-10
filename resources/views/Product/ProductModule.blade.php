<li li class="nav-item ">
    <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1"
        aria-controls="submenu-1">
        <i class="fas fa-th-list"></i> Product
        <span class="badge badge-success">6</span>
    </a>
    <div id="submenu-1" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.search') }}">Product List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.create') }}">Product Create</a>
            </li>
        </ul>
    </div>
</li>
