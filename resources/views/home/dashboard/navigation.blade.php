<style>
    nav {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;

        background-color: #D10024;
    }

    a {
        color: white;
    }

    nav ul {
        display: flex;
        /* gap: 20px !important; */
        list-style: none;
    }

    nav ul li {
        padding: 8px 20px;
    }

    a:hover {
        color: #FF547D;
        /* Lighter shade of red for hover on inactive pages */
    }

    .active {
        background-color: white;
        color: #D10024;
    }

    .active a {
        color: #D10024;
    }

    .active a:hover {
        /* color: #F05555; */
        color: #000;
        /* A shade or tint of the active page color */
    }
</style>
<nav>
    <ul>
        <li class="{{ Request::path() == 'viewcart' ? 'active' : '' }}">
            <a href="{{url('/viewcart')}}">My Cart</a>
        </li>
        <li class="{{ Request::path() == 'viewwish' ? 'active' : '' }}">
            <a href="{{url('/viewwish')}}">My Wishlist</a>
        </li>
        <li class="{{ Request::path() == 'myorder' ? 'active' : '' }}">
            <a href="{{url('/myorder')}}">My Orders</a>
        </li>
        <li class="{{ Request::path() == 'shippingAddressManage' ? 'active' : '' }}">
            <a href="{{url('/shippingAddressManage')}}">Manage Shipping Address</a>
        </li>
        <li class="{{ Request::path() == 'redirect' ? 'active' : '' }}">
            <a href="{{url('/redirect')}}">Profile</a>
        </li>
    </ul>
</nav>