@extends('layouts.master')

@section('content-header')
    <h1>
        Contact Detail of - {{ $contact->full_name}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.contact.contact.index') }}">{{ trans('contact::contacts.title.contacts') }}</a></li>
        <li class="active">{{ trans('contact::contacts.title.edit contact') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.contact.contacts.update', $contact->id], 'method' => 'put']) !!}
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#bill_invoice" data-toggle="tab">
                {{ ($contact->user_type == 'customer')?'Invoices':'Bills' }}</a></li>
              <li><a href="#products" data-toggle="tab">Product</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="bill_invoice">
                @if($contact->user_type == 'customer')
                    @include('accounting::admin.invoices.table')
                @elseif($contact->user_type == 'vendor')
                    @include('accounting::admin.bills.table')                
                @endif
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="products">
                <div class="table-responsive">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Qty.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($customer_products)) : ?>
                            <?php foreach ($customer_products as &$product) : ?>
                        <tr>
                            <td>{{$product->name}}</td>
                            <td> {{ $product->quantity}}</td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Qty.</th>
                        </tr>
                        </tfoot>
                    </table>
                    <!-- /.box-body -->
                </div>
              </div>
              <!-- /.tab-pane -->
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
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
                    { key: 'b', route: "<?php echo route('admin.contact.contact.index') ?>" }
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
