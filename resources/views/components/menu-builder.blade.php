<ol class="dd-list">
    @forelse($menuItems as $item)
        <li class="dd-item" data-id="{{ $item->id }}">
            <div class="pull-right item_actions">
                <button type="button" class="btn btn-sm btn-danger float-right delete" onclick="deleteData({{ $item->id }})">
                    <i class="fas fa-trash-alt"></i>
                    <span>Delete</span>
                </button>
                <form id="delete-form-{{ $item->id }}" action="{{ route('app.menus.item.destroy',['id'=>$item->menu->id,'itemId'=>$item->id]) }}"
                      method="POST" style="display: none;">
                    @csrf()
                    @method('DELETE')
                </form>
                <a class="btn btn-sm btn-primary float-right edit" href="{{ route('app.menus.item.edit',['id'=>$item->menu->id,'itemId'=>$item->id]) }}">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            </div>
            <div class="dd-handle">
                @if ($item->type == 'divider')
                    <strong>Divider: {{ $item->divider_title }}</strong>
                @else
                    <span>{{ $item->title }}</span> <small class="url">{{ $item->url }}</small>
                @endif
            </div>
            @if(!$item->childs->isEmpty())
                <x-menu-builder :menuItems="$item->childs"/>
            @endif
        </li>
    @empty
        <div class="text-center">
            <strong >No menu item found.</strong>
        </div>
    @endforelse
</ol>
