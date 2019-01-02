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
                {!! Form::select('salutation', $salutations, null, ['class' => 'form-control', 'tabindex'=> '1'] ) !!}
                <br/>
                {!! Form::normalInput('first_name', 'First Name', $errors, '', ['tabindex'=> '2']) !!}
                {!! Form::normalInput('last_name', 'Last Name', $errors, '', ['tabindex'=> '3']) !!}                

            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('email', 'Email Address', $errors, '', ['tabindex'=> '4']) !!}
                {!! Form::normalInput('phone', 'Phone Number', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)','tabindex'=>  '5'] ) !!}
                {!! Form::normalInput('company_name', 'Company Name', $errors, '', ['tabindex'=>    '6']) !!}

            </div>
            <div class="col-sm-4">
                {!! Form::normalInput('department', 'Department', $errors, '', ['tabindex'=> '7']) !!}                
                {!! Form::normalInput('designation', 'Designation', $errors, '', ['tabindex'=> '8']) !!}
                {!! Form::normalInput('gstin', 'GSTIN', $errors, '', ['tabindex'=> '9']) !!}
            </div>
        </fieldset>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-{{ (setting('product::setting_details') ? 6 : 12) }}">
            <fieldset>
                <legend>
                    Billing Details:
                </legend>
                {!! Form::normalInput('name', 'Name', $errors, '', ['tabindex'=> '10']) !!}
                {!! Form::normalInput('address', 'Address', $errors, '', ['tabindex'=> '12']) !!}
                <div class='form-group'>
                    {!! Form::label('country', 'country') !!}
                    <select name="country" class="form-control" id="country">
                    </select>
                </div>                
                <div class='form-group'>
                    {!! Form::label('state', 'state') !!}
                    <select name="state" class="form-control" id="state">
                    </select>
                </div>

                {!! Form::normalInput('city', 'City', $errors, '', ['tabindex'=> '14']) !!}
                {!! Form::normalInput('zip_code', 'Zip Code', $errors, null, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)','tabindex'=> '18']) !!}
                {!! Form::normalInput('fax', 'Fax', $errors, '', ['tabindex'=> '22']) !!}
                {!! Form::normalInput('billingphone', 'Phone', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)','tabindex'=> '24']) !!}
            </fieldset>
        </div>
        @if(setting('contact::shipping_details'))
        <div class="col-sm-6">
            <fieldset>
                <legend>
                    Shipping Details:
                </legend>
                {!! Form::normalInput('sname', 'Name', $errors, '', ['tabindex'=> '11']) !!}
                {!! Form::normalInput('saddress', 'Address', $errors, '', ['tabindex'=> '13']) !!}
                {!! Form::normalInput('scountry', 'Country', $errors, '', ['tabindex'=> '21']) !!}
                {!! Form::normalInput('sstate', 'State', $errors, '', ['tabindex'=> '17']) !!}
                {!! Form::normalInput('scity', 'City', $errors, '', ['tabindex'=> '15']) !!}
                {!! Form::normalInput('szip_code', 'Zip Code', $errors, null, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)','tabindex'=> '19']) !!}
                {!! Form::normalInput('sfax', 'Fax', $errors, '', ['tabindex'=> '23']) !!}
                {!! Form::normalInput('sbillingphone', 'Phone', $errors, null, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)','tabindex'=> '25']) !!}
            </fieldset>
        </div>
        @endif
    </div>
</div>