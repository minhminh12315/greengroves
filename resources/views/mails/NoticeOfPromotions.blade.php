@extends('mails.mailMasterLayouts')
@section('content')
<div class="card" style="width: 18rem;">
    
    <h1>{{ $data['title'] }}</h1>
    <p>{{ $data['description'] }}</p>
</div>
@endsection