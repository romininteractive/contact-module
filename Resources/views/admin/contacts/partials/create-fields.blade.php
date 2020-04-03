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
                {!! Form::select('salutation', $salutations, null, ['class' => 'form-control'] ) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('first_name', 'First Name', $errors, '') !!}
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('last_name', 'Last Name', $errors, '') !!}
            </div>
        </fieldset>

        <fieldset>
            <legend>
                Contact Details:
            </legend>
            <div class="col-md-4">
                {!! Form::normalInput('phone', 'Mobile #1', $errors, '') !!}
            </div>
            <div class="col-md-4">
                {!! Form::normalInput('mobile2', 'Mobile #2', $errors, '') !!}
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('email', 'Email Address', $errors, '') !!}
            </div>
            
            <div class="col-md-6">
                {!! Form::normalInput('landline1', 'Landline #1', $errors, '') !!}
            </div>
            <div class="col-md-6">
                {!! Form::normalInput('landline2', 'Landline #2', $errors, '') !!}
            </div>
        </fieldset>


        <div class="col-sm-3">
                {!! Form::normalInput('company_name', 'Company Name', $errors, '') !!}
        </div>
        <div class="col-sm-3">
            {!! Form::normalInput('department', 'Department', $errors, '') !!}                
        </div>
        <div class="col-sm-3">
            {!! Form::normalInput('designation', 'Designation', $errors, '') !!}
        </div>
        <div class="col-sm-3">
            {!! Form::normalInput('gstin', 'GSTIN', $errors, '') !!}
        </div>
    </div>
    @action('contact.top_field', null)
    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-{{ (setting('product::shipping_details') ? 6 : 12) }}">
            <fieldset>
                <legend>
                    Billing Details:
                </legend>
                {!! Form::normalInput('name', 'Name', $errors, '') !!}
                {!! Form::normalInput('address', 'Address', $errors, '') !!}
                
                <div class='form-group'>
                    {!! Form::label('location', 'Location') !!}
                    <location-dropdown name="location"></location-dropdown>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::normalInput('fax', 'Fax', $errors, '') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::normalInput('billingphone', 'Phone', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
                    </div>
                </div>
            </fieldset>
        </div>
        @if(setting('contact::shipping_details'))
        <div class="col-sm-6">
            <fieldset>
                <legend>
                    Shipping Details:
                </legend>
                {!! Form::normalInput('sname', 'Name', $errors, '') !!}
                {!! Form::normalInput('saddress', 'Address', $errors, '') !!}
                {!! Form::normalInput('scountry', 'Country', $errors, '') !!}
                {!! Form::normalInput('sstate', 'State', $errors, '') !!}
                {!! Form::normalInput('scity', 'City', $errors, '') !!}
                {!! Form::normalInput('szip_code', 'Zip Code', $errors, null, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)']) !!}
                {!! Form::normalInput('sfax', 'Fax', $errors, '') !!}
                {!! Form::normalInput('sbillingphone', 'Phone', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
            </fieldset>
        </div>
        @endif
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-6">
            <fieldset>
                <legend>
                    Remarks:
                </legend>

                {!! Form::normalTextarea('remarks', 'Remarks', $errors, '', ['tabindex' => 35]) !!}
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset>
                <legend>
                    Bank Account Details:
                </legend>

                {!! Form::normalTextarea('bank_details', 'Bank Details', $errors, '', ['tabindex' => 36]) !!}
            </fieldset>
        </div>
    </div>
</div>