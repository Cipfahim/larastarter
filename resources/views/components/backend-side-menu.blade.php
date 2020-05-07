<div>
    @foreach($items as $item)
        @if ($item->type == 'divider')
            <li class="app-sidebar__heading">{{ $item->divider_title }}</li>
        @else
            @if($item->childs->isEmpty())
                <li>
                    <a href="{{ $item->url }}" class="{{ Request::is(ltrim($item->url,'/').'*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon {{ $item->icon_class }}"></i>
                        {{ $item->title }}
                    </a>
                </li>
            @else
                <li
                    @foreach($item->childs as $child)
                        @if (Request::is(ltrim($child->url,'/').'*'))
                            class="mm-active"
                            @break
                        @endif
                    @endforeach
                >
                    <a href="{{ $item->url }}" class="{{ Request::is(ltrim($item->url,'/').'*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon {{ $item->icon_class }}"></i>
                        {{ $item->title }}
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        @foreach($item->childs as $child)
                            <li>
                                <a href="{{ $child->url }}" class="{{ Request::is(ltrim($child->url,'/').'*') ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon {{ $child->icon_class }}"></i>
                                    {{ $child->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endif
    @endforeach
</div>
