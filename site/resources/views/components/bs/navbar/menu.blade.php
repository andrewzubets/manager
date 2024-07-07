<ul class="navbar-nav me-auto mb-2 mb-lg-0">
   @foreach($links as $item)
      <x-bs.navbar.menu.item :item="$item" />
   @endforeach
</ul>
