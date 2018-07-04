@if(Admin::user()->visible($item['roles']))

    @php
        $current = str_replace(trim(config('admin.route.prefix'),'/'),'',\Request::path());
        $is_active = substr($current,0,strlen($item['uri'])) ===  $item['uri'];
        $is_open = substr($current,0,strlen($item['uri'])) ===  $item['uri'];
    @endphp

    @if(!isset($item['children']))
        <li class="{{$is_active?'active':null}}">
            @if(url()->isValidUrl($item['uri']))
                <a href="{{ $item['uri'] }}" target="_blank">
                    @else
                        <a href="{{ admin_base_path($item['uri']) }}" {{ $item['pjax']?'':e('nojax') }}>
                            @endif
                            <i class="fa {{$item['icon']}}"></i>
                            <span>{{__($item['title'])}}</span>
                        </a>
        </li>
    @else
        <li class="treeview {{$is_open?'active':null}}">
            <a href="#">
                <i class="fa {{$item['icon']}}"></i>
                <span>{{  __($item['title'])  }}</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @foreach($item['children'] as $item)
                    @include('admin::partials.menu', $item)
                @endforeach
            </ul>
        </li>
    @endif
@endif
