<nav class="navbar navbar-expand-lg bg-body-tertiary">
   <div class="container-fluid">
       @if(isset($brand))
       <x-bs.navbar.brand :brand="$brand" />
       @endif
      <x-bs.navbar.collapse id="navbarSupportedContent">
         @if(!empty($leftMenu))
            <x-bs.navbar.menu :links="$leftMenu" />
         @endif
         @if(!empty($rightMenu))
            <x-bs.navbar.menu :links="$rightMenu" />
         @endif
         @if(isset($search))
            <x-bs.navbar.search :value="$search" />
         @endif
      </x-bs.navbar.collapse>
   </div>
</nav>
