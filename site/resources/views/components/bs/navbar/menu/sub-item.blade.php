@if(isset($subLink['type']) and $subLink['type'] == 'divider')
   <li>
      <hr class="dropdown-divider" />
   </li>
@else
   <li>
      <a class="dropdown-item" href="{{$subLink['href'] ?? '#'}}">{{$subLink['label'] ?? 'Undefined'}}</a>
   </li>
@endif