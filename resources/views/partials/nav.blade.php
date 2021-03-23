
<nav class="navbar bg-white shadow-sm">

    <ul id="vexsoluciones_navbar" class="nav">
      <li class="vexsoluciones_nav_item nav-item">
        <a class="vexsoluciones_nav-link nav-link @if(Request::route()->getName() == 'home') active @endif " href="{{ route('home') }}">@lang('servientrega.titles.home')</a>
      </li>
      <li class="vexsoluciones_nav_item nav-item">
        <a class="vexsoluciones_nav-link nav-link @if(Request::route()->getName() == 'settings') active @endif" href="{{ route('settings') }}">@lang('servientrega.titles.settings')</a>
      </li>
      <li class="vexsoluciones_nav_item nav-item">
        <a class="vexsoluciones_nav-link nav-link @if(Request::route()->getName() == 'products') active @endif" href="{{ route('products') }}">@lang('servientrega.titles.products')</a>
      </li>
      <li class="vexsoluciones_nav_item nav-item ">
        <a class="vexsoluciones_nav-link nav-link @if(Request::route()->getName() == 'orders' || Request::route()->getName() == 'orderDetail') active @endif " href="{{ route('orders') }}">@lang('servientrega.titles.orders')</a>
      </li>
    </ul>
</nav>
