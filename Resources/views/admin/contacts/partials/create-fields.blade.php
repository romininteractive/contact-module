<div class="box-body">
    <div class="row">
        <fieldset>
            <legend>
                General Details:
            </legend>
            <div class="form-group col-sm-4">
                {!! Form::label('Type', 'Contact Type:') !!}&nbsp;&nbsp;&nbsp;
                    @foreach ($contact_type as $k => $type)
                         <label class="radio-inline">
                              {{ Form::radio('user_type', $type['value'], ['class' => 'form-control'])  }} 
                              {!! $type['text'] !!}
                        </label>
                    @endforeach
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4">
                {!! Form::label('salutation', 'Salutation') !!}
                {!! Form::select('salutation', $user_salution, null, ['class' => 'form-control'] ) !!}
                <br/>
                {!! Form::normalInput('email', 'Email Address', $errors) !!}
                {!! Form::normalInput('company_name', 'Company Name', $errors) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('first_name', 'First Name', $errors) !!}
                {!! Form::normalInput('last_name', 'Last Name', $errors) !!}
                {!! Form::normalInput('phone', 'Phone Number', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)'] ) !!}
                {!! Form::normalInput('department', 'Department', $errors) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('gstin', 'GSTIN', $errors) !!}
                {!! Form::normalInput('designation', 'Designation', $errors) !!}
            </div>
        </fieldset>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-6">
            <fieldset>
                <legend>
                    Billing Details:
                </legend>
                <!-- {!! Form::label('type', 'Type') !!}     -->
<!--                 {!! Form::radio('dtype', "billing", null) !!} billing
                {!! Form::radio('dtype', "shipping", null) !!} shipping -->
                {!! Form::normalInput('name', 'Name', $errors) !!}
                {!! Form::normalInput('address', 'Address', $errors) !!}
                {!! Form::normalInput('city', 'City', $errors) !!}
                {!! Form::normalInput('state', 'State', $errors) !!}
                {!! Form::normalInput('zip_code', 'Zip Code', $errors, null, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)']) !!}
                {!! Form::normalInput('country', 'Country', $errors) !!}
                {!! Form::normalInput('fax', 'Fax', $errors) !!}
                {!! Form::normalInput('billingphone', 'Phone', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
            </fieldset>
        </div>
        <div class="col-sm-6">
            <fieldset>
                <legend>
                    Shipping Details:
                </legend>
<!--                 {!! Form::label('dtype', 'Type') !!}    
                {!! Form::radio('sdtype', "billing", null) !!} Billing
                {!! Form::radio('sdtype', "shipping", null) !!} Shipping -->
                {!! Form::normalInput('sname', 'Name', $errors) !!}
                {!! Form::normalInput('saddress', 'Address', $errors) !!}
                {!! Form::normalInput('scity', 'City', $errors) !!}
                {!! Form::normalInput('sstate', 'State', $errors) !!}
                {!! Form::normalInput('szip_code', 'Zip Code', $errors, null, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)']) !!}
                {!! Form::normalInput('scountry', 'Country', $errors) !!}
                {!! Form::normalInput('sfax', 'Fax', $errors) !!}
                {!! Form::normalInput('sbillingphone', 'Phone', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
            </fieldset>
        </div>
    </div>
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
         function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
    </script>
</div>