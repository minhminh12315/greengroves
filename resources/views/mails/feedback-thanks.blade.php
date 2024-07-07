@extends('mails.mailMasterLayouts')
@section('content')
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Thank You {{$name}} for Your Feedback!</h5>
        <p class="card-text">We appreciate your feedback and will review it as soon as possible.</p>
        <p class="cart-text">Gethsemani will send notifications if there are promotions</p>
    </div>
</div>
@endsection