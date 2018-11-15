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
          {!! Form::select('salutation', $user_salution, $contact->salutation, ['class' => 'form-control'] ) !!}                        <br>
         <!-- {!! Form::normalSelect('salutation','Salutation',$errors,['','Mr.','Mrs.','Ms.','MISS','Dr.']) !!} -->
         {!! Form::normalInput('email', 'Email Address', $errors,$contact) !!}
         {!! Form::normalInput('company_name', 'Company Name', $errors,$contact) !!}
      </div>
      <div class="col-sm-4">
        {!! Form::normalInput('first_name', 'First Name', $errors,$contact) !!}
        {!! Form::normalInput('phone', 'Phone Number', $errors,$contact, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
        {!! Form::normalInput('department', 'Department', $errors,$contact) !!}
      </div>
      <div class="col-sm-4">
       {!! Form::normalInput('last_name', 'Last Name', $errors,$contact) !!}
       {!! Form::normalInput('gstin', 'GSTIN', $errors,$contact) !!}
       {!! Form::normalInput('designation', 'Designation', $errors,$contact) !!}
      </div>      
</fieldset>
</div>



<div class="row">
  <div class="col-sm-6">
  	  <fieldset>
    <legend>Billing Detail:</legend>

  	{!! Form::normalInput('name', 'Name', $errors,$billingConatctAddress) !!}
    	 {!! Form::normalInput('address', 'Address', $errors,$billingConatctAddress) !!}
    	 {!! Form::normalInput('city', 'City', $errors,$billingConatctAddress) !!}
    	 {!! Form::normalInput('state', 'State', $errors,$billingConatctAddress) !!}
    	 {!! Form::normalInput('zip_code', 'Zip Code', $errors,$billingConatctAddress, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)']) !!}
    	 {!! Form::normalInput('country', 'Country', $errors,$billingConatctAddress) !!}
    	        {!! Form::normalInput('fax', 'Fax', $errors,$billingConatctAddress) !!}
    	         {!! Form::normalInput('billingphone', 'Phone', $errors,$billingConatctAddress, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
    	     </fieldset>
    	     </div>
  <div class="col-sm-6">
  	  <fieldset>
    <legend>Shipping Detail:</legend>
    <div class="form-group">
          {!! Form::label('Name', 'Name') !!}
          {!! Form::text('sname', $shippingConatctAddress->name, ['class' => 'form-control', 'required']) !!}
  	<!-- {!! Form::normalInput('name', 'Name', $errors,$shippingConatctAddress) !!} -->
    </div>
    <div class="form-group">
          {!! Form::label('Address', 'Address') !!}
    	    {!! Form::text('saddress', $shippingConatctAddress->address, ['class' => 'form-control', 'required']) !!}
    </div>
    <div class="form-group">
          {!! Form::label('City', 'City') !!}
          {!! Form::text('scity', $shippingConatctAddress->city, ['class' => 'form-control']) !!}
    <!-- {!! Form::normalInput('name', 'Name', $errors,$shippingConatctAddress) !!} -->
    </div>         
    <div class="form-group">
          {!! Form::label('State', 'State') !!}
          {!! Form::text('sstate', $shippingConatctAddress->state, ['class' => 'form-control']) !!}
    	     <!-- {!! Form::normalInput('scity', 'City1', $errors,$shippingConatctAddress) !!} -->
    </div>             
    <div class="form-group">
          {!! Form::label('ZIP Code', 'ZIP Code') !!}
          {!! Form::text('szip_code', $shippingConatctAddress->zip_code, ['class' => 'form-control','maxlength' => 6, 'onkeypress' => 'return isNumber(event)']) !!}
    	     <!-- {!! Form::normalInput('sstate', 'State', $errors,$shippingConatctAddress) !!} -->
    </div>
    <div class="form-group">
          {!! Form::label('Country', 'Country') !!}
          {!! Form::text('scountry', $shippingConatctAddress->country, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
          {!! Form::label('Fax', 'Fax') !!}
          {!! Form::text('sfax', $shippingConatctAddress->fax, ['class' => 'form-control']) !!}
    </div>                         
    <div class="form-group">
          {!! Form::label('Phone', 'Phone') !!}
          {!! Form::text('sbillingphone', $shippingConatctAddress->billingphone, ['class' => 'form-control','maxlength' => 10, 'onkeypress' => 'return isNumber(event)']) !!}
    </div>                             
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
</script>
