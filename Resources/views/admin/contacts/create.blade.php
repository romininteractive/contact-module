@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('contact::contacts.title.create contact') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.contact.contacts.index') }}">{{ trans('contact::contacts.title.contacts') }}</a></li>
        <li class="active">{{ trans('contact::contacts.title.create contact') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.contact.contacts.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('contact::admin.contacts.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.contact.contacts.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
        populateCountries("country", "state");        
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
            $("#name").change(function () {
                var value = $(this).val();
                $("#sname").val(value);
            });
            $("#address").change(function () {
                var value = $(this).val();
                $("#saddress").val(value);
            });
            $("#city").change(function () {
                var value = $(this).val();
                $("#scity").val(value);
            });
            $("#state").change(function () {
                var value = $(this).val();
                $("#sstate").val(value);
            });
            $("#zip_code").change(function () {
                var value = $(this).val();
                $("#szip_code").val(value);
            });
            $("#country").change(function () {
                var value = $(this).val();
                $("#scountry").val(value);
            });
            $("#fax").change(function () {
                var value = $(this).val();
                $("#sfax").val(value);
            });

            $("#first_name").change(function(){
                var firstName = $(this).val();

                $("#name").val(firstName + ' ' + $("#last_name").val());
                $("#sname").val(firstName + ' ' + $("#last_name").val());
            });
            $("#last_name").change(function(){
                var lastName = $(this).val();

                $("#name").val($("#first_name").val() + ' ' + lastName);
                $("#sname").val($("#first_name").val() + ' ' + lastName);
            });

            $("#phone").change(function(){
                var val = $(this).val();

                $("#billingphone").val(val);
                $("#sbillingphone").val(val);
            });

            $("#billingphone").change(function () {
                var value = $(this).val();
                $("#sbillingphone").val(value);
            });
        });

         function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
    </script>
@endpush
