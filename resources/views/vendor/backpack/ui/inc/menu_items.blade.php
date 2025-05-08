{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Orders" icon="la la-box-open" :link="backpack_url('order')" />
<x-backpack::menu-item title="Users" icon="la la-user-cog" :link="backpack_url('user')" />
<x-backpack::menu-item title="Products" icon="la la-boxes" :link="backpack_url('product')" />
<x-backpack::menu-item title="Product colors" icon="la la-palette" :link="backpack_url('product-color')" />
<x-backpack::menu-item title="News" icon="la la-newspaper" :link="backpack_url('news')" />
<x-backpack::menu-item title="Reviews" icon="la la-star" :link="backpack_url('review')" />
<x-backpack::menu-item title="Services" icon="la la-cogs" :link="backpack_url('service')" />
