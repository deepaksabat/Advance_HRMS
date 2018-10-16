@extends('master')

@section('content')

    <section class="wrapper-bottom-sec">

        <div class="p-30  p-b-none">

            @include('notification.notify')

        </div>
    </section>

@endsection

{{--External Style Section--}}
@section('script')
    {!! Html::script("assets/libs/handlebars/handlebars.runtime.min.js")!!}
    {!! Html::script("assets/js/form-elements-page.js")!!}
@endsection
