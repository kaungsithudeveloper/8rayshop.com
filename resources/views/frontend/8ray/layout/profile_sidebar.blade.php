<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('8ray.user.profile.edit') ? 'active' : '' }}" href="{{ route('8ray.user.profile.edit') }}" aria-controls="account-detail">
                    <i class="fi-rs-user mr-10"></i>Account details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('8ray.user.password') ? 'active' : '' }}" href="{{ route('8ray.user.password') }}" aria-controls="account-detail">
                    <i class="fi-rs-user mr-10"></i>Password Manage
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('8ray.user.order') ? 'active' : '' }}" href="{{ route('8ray.user.order') }}" aria-controls="orders" aria-selected="false">
                    <i class="fi-rs-shopping-bag mr-10"></i>Orders
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('return.order.page') ? 'active' : '' }}" href="{{ route('return.order.page') }}" aria-controls="return orders " aria-selected="false">
                    <i class="fi-rs-shopping-bag mr-10"></i> Return Orders
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('8ray.user.track.order') ? 'active' : '' }}" href="{{ route('8ray.user.track.order') }}" aria-controls="track-orders" aria-selected="false">
                    <i class="fi-rs-shopping-cart-check mr-10"></i> Track Your Order
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('8ray.logout') }}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>
