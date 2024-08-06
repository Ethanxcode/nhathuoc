<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
<li class="side-menus {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-building"></i><span>Dashboard</span></a>
</li>
</li>
<li class="side-menus {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-building"></i><span>Customers</span></a>
</li>
<li class="side-menus {{ Request::is('admins*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admins.index') }}"><i class="fas fa-building"></i><span>Clients</span></a>
</li>

<li class="side-menus {{ Request::is('pages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('pages.index') }}"><i class="fas fa-building"></i><span>Landing page</span></a>
</li>
<li class="side-menus {{ Request::is('products*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-building"></i><span>Products</span></a>
</li>

<li class="side-menus {{ Request::is('qrcodes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('qrcodes.index') }}"><i class="fas fa-building"></i><span>Qrcodes</span></a>
</li>

<li class="side-menus {{ Request::is('giftTypes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('giftTypes.index') }}"><i class="fas fa-building"></i><span>Gift Types</span></a>
</li>

<li class="side-menus {{ Request::is('gifts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('gifts.index') }}"><i class="fas fa-building"></i><span>Gifts</span></a>
</li>
<li class="side-menus {{ Request::is('customerGifts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customerGifts.index') }}"><i class="fas fa-building"></i><span>Customer
            Gifts</span></a>
</li>

<li class="side-menus {{ Request::is('customerPoints*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customerPoints.index') }}"><i class="fas fa-building"></i><span>Customer
            Points</span></a>
</li><li class="side-menus {{ Request::is('customerClientPoints*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customerClientPoints.index') }}"><i class="fas fa-building"></i><span>Customer Client Points</span></a>
</li>


<li class="side-menus {{ Request::is('medicineShops*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('medicineShops.index') }}"><i class="fas fa-building"></i><span>Medicine Shops</span></a>
</li>

