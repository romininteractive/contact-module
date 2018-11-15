<div class="box-body">
	<div class="row">
		 <fieldset>
    <legend>General Detail:</legend>
  <div class="col-sm-6">
 {!! Form::normalSelect('salutation','Salutation',$errors,['','Mr.','Mrs.','Ms.','MISS','Dr.']) !!}
 {!! Form::normalInput('last_name', 'Last Name', $errors,$contact) !!}
  {!! Form::normalInput('email', 'Email Address', $errors,$contact) !!}
   {!! Form::normalInput('department', 'Department', $errors,$contact) !!}


  </div>
   <div class="col-sm-6">
   {!! Form::normalInput('first_name', 'First Name', $errors,$contact) !!}
    {!! Form::normalInput('company_name', 'Company Name', $errors,$contact) !!}
    {!! Form::normalInput('designation', 'Designation', $errors,$contact) !!}
    {!! Form::normalInput('phone', 'Phone Number', $errors,$contact) !!}
     {!! Form::normalInput('gstin', 'GSTIN', $errors,$contact) !!}
   </div>
</fieldset>
</div>



<div class="row">
  <div class="col-sm-6">
  	  <fieldset>
    <legend>Billing Detail:</legend>

  	{!! Form::normalInput('name', 'Name', $errors,$conatctAddress) !!}
    	 {!! Form::normalInput('address', 'Address', $errors,$conatctAddress) !!}
    	 {!! Form::normalInput('city', 'City', $errors,$conatctAddress) !!}
    	 {!! Form::normalInput('state', 'State', $errors,$conatctAddress) !!}
    	 {!! Form::normalInput('zip_code', 'Zip Code', $errors,$conatctAddress) !!}
    	 {!! Form::normalInput('coutry', 'Courtry', $errors,$conatctAddress) !!}
    	        {!! Form::normalInput('fax', 'Fax', $errors,$conatctAddress) !!}
    	         {!! Form::normalInput('billingphone', 'Phone', $errors,$conatctAddress) !!}
    	     </fieldset>
    	     </div>
  <div class="col-sm-6">
  	  <fieldset>
    <legend>Shipping Detail:</legend>
  	{!! Form::normalInput('sname', 'Name', $errors,$conatctAddress) !!}
    	     {!! Form::normalInput('saddress', 'Address', $errors,$conatctAddress) !!}
    	     {!! Form::normalInput('scity', 'City1', $errors,$conatctAddress) !!}
    	     {!! Form::normalInput('sstate', 'State', $errors,$conatctAddress) !!}
    	      {!! Form::normalInput('szip_code', 'Zip Code', $errors,$conatctAddress) !!}
    	    	 {!! Form::normalInput('scoutry', 'Coutry', $errors,$conatctAddress) !!}
    	    	  {!! Form::normalInput('sfax', 'Fax', $errors,$conatctAddress) !!}
    	    	   {!! Form::normalInput('sbillingphone', 'Phone', $errors,$conatctAddress) !!}
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
            $("#coutry").keyup(function () {
                var value = $(this).val();
                $("#scoutry").val(value);
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
