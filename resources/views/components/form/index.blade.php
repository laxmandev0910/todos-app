@props([
'id',
'method',
'action'=>'',
'spoofMethod'=> null
])

<form id="{{$id}}" action="{{$action}}" method="{{$method}}" {{ $attributes }} accept-charset="UTF-8" spellcheck="false"
  autocomplete="off" novalidate>
  @csrf
  {{ $slot }}
</form>