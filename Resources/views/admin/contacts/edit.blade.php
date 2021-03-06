@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('contact::contacts.title.edit contact') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.contact.contacts.index') }}">{{ trans('contact::contacts.title.contacts') }}</a></li>
        <li class="active">{{ trans('contact::contacts.title.edit contact') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.contact.contacts.update', $contact->id], 'method' => 'put']) !!}
    <div class="row">

        <input type="hidden" name="country_name" id="country_name" value="{{($billingConatctAddress)?$billingConatctAddress->country:null}}">
        <input type="hidden" name="state_name" id="state_name" value="{{($billingConatctAddress)?$billingConatctAddress->state:null}}">        
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('contact::admin.contacts.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.contact.contacts.index')}}?type={{ $contact->user_type }}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
<script type="text/javascript" src="{{ asset('modules/rarv/js/countries.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var count_val = $('#country_name').val();
            var state_val = $('#state_name').val();
            populateCountries("country", "state" ,count_val, state_val);        
        });    
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?php echo route('admin.contact.contacts.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#name").keyup(function () {
                var value = $(this).val();
                $("#sname").val(value);
            });
        });
        $(document).ready(function () {
            $("#address").keyup(function () {
                var value = $(this).val();
                $("#saddress").val(value);
            });
        });
        $(document).ready(function () {
            $("#city").keyup(function () {
                var value = $(this).val();
                $("#scity").val(value);
            });
        });
        $(document).ready(function () {
            $("#state").keyup(function () {
                var value = $(this).val();
                $("#sstate").val(value);
            });
        });
         $(document).ready(function () {
            $("#zip_code").keyup(function () {
                var value = $(this).val();
                $("#szip_code").val(value);
            });
        });
         $(document).ready(function () {
            $("#country").keyup(function () {
                var value = $(this).val();
                $("#scountry").val(value);
            });
        });
         $(document).ready(function () {
            $("#fax").keyup(function () {
                var value = $(this).val();
                $("#sfax").val(value);
            });
        });
         $(document).ready(function () {
            $("#billingphone").keyup(function () {
                var value = $(this).val();
                $("#sbillingphone").val(value);
            });
        });
    </script>

@endpush
