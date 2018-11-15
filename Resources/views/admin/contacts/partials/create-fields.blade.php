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
</div>