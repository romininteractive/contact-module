<div class="box-body">
	<div class="row">
		 <fieldset>
    <legend>General Detail:</legend>
      <div class="form-group col-sm-4">
          {!! Form::label('Type', 'Contact Type:') !!}&nbsp;&nbsp;&nbsp;
              @foreach ($contact_type as $k => $type)
                   <label class="radio-inline">
                      <input {{($type['value'] == $contact->user_type)?'checked':'' }} name="user_type" type="radio" value="{{$type['value']}}">                          
                        {!! $type['text'] !!}
                  </label>
              @endforeach
      </div>
        <div class="clearfix"></div>
      <div class="col-sm-4">
          {!! Form::label('Salutation', 'Salutation') !!}
          {!! Form::select('salutation', $salutations, $contact->salutation, ['class' => 'form-control', 'tabindex'=> '1'] ) !!}                        <br>
          {!! Form::normalInput('first_name', 'First Name', $errors,$contact, ['tabindex'=> '2']) !!}
         {!! Form::normalInput('last_name', 'Last Name', $errors,$contact, ['tabindex'=> '3']) !!}                 
      </div>
      <div class="col-sm-4">
         {!! Form::normalInput('email', 'Email Address', $errors,$contact, ['tabindex'=> '4']) !!}
        {!! Form::normalInput('phone', 'Phone Number', $errors,$contact, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)', 'tabindex'=> '5']) !!}
         {!! Form::normalInput('company_name', 'Company Name', $errors,$contact, ['tabindex'=> '6']) !!}

      </div>
      <div class="col-sm-4">
        {!! Form::normalInput('department', 'Department', $errors,$contact, ['tabindex'=> '7']) !!}
       {!! Form::normalInput('designation', 'Designation', $errors,$contact, ['tabindex'=> '8']) !!}
       {!! Form::normalInput('gstin', 'GSTIN', $errors,$contact, ['tabindex'=> '9']) !!}
      </div>      
  </fieldset>
  </div>
<div class="row">
  <div class="col-sm-{{ (setting('product::shipping_details') ? 6 : 12) }}">
	  <fieldset>
      <legend>Billing Detail:</legend>

  	{!! Form::normalInput('name', 'Name', $errors,$billingConatctAddress, ['tabindex'=> '10']) !!}
    	 {!! Form::normalInput('address', 'Address', $errors,$billingConatctAddress, ['tabindex'=> '12']) !!}
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
    	 {!! Form::normalInput('city', 'City', $errors,$billingConatctAddress, ['tabindex'=> '14']) !!}
    	 {!! Form::normalInput('zip_code', 'Zip Code', $errors,$billingConatctAddress, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)','tabindex'=> '18']) !!}

    	        {!! Form::normalInput('fax', 'Fax', $errors,$billingConatctAddress, ['tabindex'=> '22']) !!}
    	         {!! Form::normalInput('billingphone', 'Phone', $errors,$billingConatctAddress, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)','tabindex'=> '24']) !!}
    	     </fieldset>
  </div>
  @if(setting('product::shipping_details'))
  <div class="col-sm-6">
  	  <fieldset>
        <legend>Shipping Detail:</legend>
        <div class="form-group">
              {!! Form::label('Name', 'Name') !!}
              {!! Form::text('sname', $shippingConatctAddress->name, ['class' => 'form-control', 'required','tabindex'=> '11']) !!}
      	<!-- {!! Form::normalInput('name', 'Name', $errors,$shippingConatctAddress) !!} -->
        </div>
        <div class="form-group">
              {!! Form::label('Address', 'Address') !!}
        	    {!! Form::text('saddress', $shippingConatctAddress->address, ['class' => 'form-control', 'required','tabindex'=> '13']) !!}
        </div>

        <div class="form-group">
              {!! Form::label('Country', 'Country') !!}
              {!! Form::text('scountry', $shippingConatctAddress->country, ['class' => 'form-control','tabindex'=> '21']) !!}
        </div> 
        <div class="form-group">
              {!! Form::label('State', 'State') !!}
              {!! Form::text('sstate', $shippingConatctAddress->state, ['class' => 'form-control','tabindex'=> '17']) !!}
        </div>             
        <div class="form-group">
              {!! Form::label('City', 'City') !!}
              {!! Form::text('scity', $shippingConatctAddress->city, ['class' => 'form-control','tabindex'=> '15']) !!}
        <!-- {!! Form::normalInput('name', 'Name', $errors,$shippingConatctAddress) !!} -->
        </div>         
        <div class="form-group">
              {!! Form::label('ZIP Code', 'ZIP Code') !!}
              {!! Form::text('szip_code', $shippingConatctAddress->zip_code, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)','tabindex'=> '19']) !!}
        </div>
           <div class="form-group">
              {!! Form::label('Fax', 'Fax') !!}
              {!! Form::text('sfax', $shippingConatctAddress->fax, ['class' => 'form-control','tabindex'=> '23']) !!}
        </div>                         
        <div class="form-group">
              {!! Form::label('Phone', 'Phone') !!}
              {!! Form::text('sbillingphone', $shippingConatctAddress->billingphone, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)','tabindex'=> '25']) !!}
        </div>                             
    	</fieldset>
  </div>
  @endif
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
</script>
