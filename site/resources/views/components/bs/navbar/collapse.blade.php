@php $id = $attributes['id'] ?? 'navbarSupportedContent'; @endphp
<button class="navbar-toggler" aria-label="Переключатель навигации" aria-controls="{{$id}}" data-bs-toggle="collapse" type="button" data-bs-target="#{{$id}}" aria-expanded="false">
   <span class="navbar-toggler-icon"></span>
</button>
<div id="{{$id}}" class="collapse navbar-collapse">
   {{ $slot }}
</div>