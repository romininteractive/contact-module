<div class="box-body">
    <div class="row">
        <fieldset>
            <legend>General Detail:</legend>
            <div class="form-group col-sm-4">
                {!! Form::label('Type', 'Contact Type:') !!}&nbsp;&nbsp;&nbsp;
                @foreach ($contact_type as $k => $type)
                <label class="radio-inline">
                    <input {{($type['value'] == $contact->user_type)?'checked':'' }} name="user_type" type="radio"
                        value="{{$type['value']}}">
                    {!! $type['text'] !!}
                </label>
                @endforeach
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4">
                {!! Form::label('Salutation', 'Salutation') !!}
                {!! Form::select('salutation', $salutations, $contact->salutation, ['class' => 'form-control'] ) !!} <br>
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('first_name', 'First Name', $errors,$contact) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('last_name', 'Last Name', $errors,$contact) !!}
            </div>
        </fieldset>

        <fieldset>
            <legend>
                Contact Details:
            </legend>
                
            <div class="col-md-4">
                {!! Form::normalInput('phone', 'Mobile #1', $errors, $contact) !!}
            </div>
            <div class="col-md-4">
                {!! Form::normalInput('mobile2', 'Mobile #2', $errors, $contact) !!}
            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('email', 'Email Address', $errors,$contact) !!}
            </div>                
            <div class="col-md-6">
                {!! Form::normalInput('landline1', 'Landline #1', $errors, $contact) !!}
            </div>
            <div class="col-md-6">
                {!! Form::normalInput('landline2', 'Landline #2', $errors, $contact) !!}
            </div>            
        </fieldset>
        
        <div class="col-sm-3">
            {!! Form::normalInput('company_name', 'Company Name', $errors,$contact) !!}
        </div>
        <div class="col-sm-3">
            {!! Form::normalInput('department', 'Department', $errors,$contact) !!}
        </div>
        <div class="col-sm-3">
            {!! Form::normalInput('designation', 'Designation', $errors,$contact) !!}
        </div>
        <div class="col-sm-3">
            {!! Form::normalInput('gstin', 'GSTIN', $errors,$contact) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-{{ (setting('product::shipping_details') ? 6 : 12) }}">
            <fieldset>
                <legend>Billing Detail:</legend>

                {!! Form::normalInput('name', 'Name', $errors,$billingConatctAddress) !!}
                {!! Form::normalInput('address', 'Address', $errors,$billingConatctAddress) !!}
                <div class='form-group'>
                    {!! Form::label('location', 'Location') !!}
                    <location-dropdown name="location" value="{{ $billingConatctAddress->city }}"></location-dropdown>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {!! Form::normalInput('fax', 'Fax', $errors,$billingConatctAddress) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::normalInput('billingphone', 'Phone', $errors,$billingConatctAddress, ['class' =>
                        'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
                    </div>
                </div>
            </fieldset>
        </div>
        @if(setting('product::shipping_details'))
        <div class="col-sm-6">
            <fieldset>
                <legend>Shipping Detail:</legend>
                <div class="form-group">
                    {!! Form::label('Name', 'Name') !!}
                    {!! Form::text('sname', $shippingConatctAddress->name, ['class' => 'form-control',
                    'required','tabindex'=> '11']) !!}
                    <!-- {!! Form::normalInput('name', 'Name', $errors,$shippingConatctAddress) !!} -->
                </div>
                <div class="form-group">
                    {!! Form::label('Address', 'Address') !!}
                    {!! Form::text('saddress', $shippingConatctAddress->address, ['class' => 'form-control',
                    'required','tabindex'=> '13']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Country', 'Country') !!}
                    {!! Form::text('scountry', $shippingConatctAddress->country, ['class' => 'form-control','tabindex'=>
                    '21']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('State', 'State') !!}
                    {!! Form::text('sstate', $shippingConatctAddress->state, ['class' => 'form-control','tabindex'=>
                    '17']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('City', 'City') !!}
                    {!! Form::text('scity', $shippingConatctAddress->city, ['class' => 'form-control','tabindex'=>
                    '15']) !!}
                    <!-- {!! Form::normalInput('name', 'Name', $errors,$shippingConatctAddress) !!} -->
                </div>
                <div class="form-group">
                    {!! Form::label('ZIP Code', 'ZIP Code') !!}
                    {!! Form::text('szip_code', $shippingConatctAddress->zip_code, ['class' =>
                    'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)','tabindex'=> '19']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Fax', 'Fax') !!}
                    {!! Form::text('sfax', $shippingConatctAddress->fax, ['class' => 'form-control','tabindex'=> '23'])
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Phone', 'Phone') !!}
                    {!! Form::text('sbillingphone', $shippingConatctAddress->billingphone, ['class' =>
                    'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)','tabindex'=> '25']) !!}
                </div>
            </fieldset>
        </div>
        @endif

        <div class="row" style="margin-top: 10px;">
            <div class="col-md-6">
                <fieldset>
                    <legend>
                        Remarks:
                    </legend>

                    {!! Form::normalTextarea('remarks', 'Remarks', $errors, $contact, ['tabindex' => 35]) !!}
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>
                        Bank Account Details:
                    </legend>

                    {!! Form::normalTextarea('bank_details', 'Bank Details', $errors, $contact, ['tabindex' => 36]) !!}
                </fieldset>
            </div>
        </div>
    </div>