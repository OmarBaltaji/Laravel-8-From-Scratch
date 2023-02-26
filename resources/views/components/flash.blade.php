@if (session()->has('success'))
    <x-flashmessage type="success" />
@elseif (session()->has('error')) 
    <x-flashmessage type="error" />
@endif