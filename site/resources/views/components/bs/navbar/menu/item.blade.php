@php
$cssClass = '';
if(($item['is_active'] ?? false) === true){
    $cssClass.=' active';
}
if(($item['is_disabled'] ?? false) === true){
    $cssClass.=' disabled';
}
$href= $item['href'] ?? '#';
$label= $item['label'] ?? 'Undefined';
@endphp
@if(empty($item['sub']))
   <li class="nav-item">
      <a class="nav-link{{$cssClass}}" href="{{$href}}" aria-current="page">{{$label}}</a>
   </li>
@else
   <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" aria-expanded="false" role="button" href="#" data-bs-toggle="dropdown">{{$label}}</a>
      <ul class="dropdown-menu">
         @foreach($item['sub'] as $subLink)
            <x-bs.navbar.menu.sub-item :item="$subLink" />
         @endforeach
      </ul>
   </li>
@endif
