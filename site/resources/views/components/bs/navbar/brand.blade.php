@if(!empty($brand))
   <a class="navbar-brand" href="{{$brand['href'] ?? '#'}}">{{$brand['label'] ?? 'No brand'}}</a>
@endif