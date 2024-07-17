@if(isset($item['type']) and $item['type'] == 'divider')
   <li>
      <hr class="dropdown-divider" />
   </li>
@else
   <li>
      <a class="dropdown-item" href="{{$item['href'] ?? '#'}}">{{$item['label'] ?? 'Undefined'}}</a>
   </li>
@endif
