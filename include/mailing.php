<html>
<body>
<div class="freeTripPlaning">
<h3>Free Trip Planning </h3>
<form name="TripPlaning" method="post" action="querySubmit.php" class="form-horizontal">
<div class="form-group">
  <label for="name" class="control-label "> Name: </label>
   <div class="col-sm-12">
  <input type="text" id="name" name=fname class="form-control">
</div>
</div>
<div class="form-group">
  <label for="email" class="control-label ">Email: </label>
  <div class="col-sm-12">
  <input type="email" id="email" name=email class="form-control">
</div>
</div>


<div class="form-group">
  <label for="trip" class="control-label  ">Trip Interested: </label>
  <div class="col-sm-12">
  <input type="text" id="trip" name=trip class="form-control">
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-4">Number of Person </label>
<div class="col-sm-6">
    <label for="days">Select:</label>
    <select class="form-control" id="days">
      <option>1-2</option>
      <option>2-4</option>
      <option>4-6</option>
      <option>6-10</option>
    </select>
  </div>
</div>
<div class="col-sm-12">
  &nbsp;
</div>

<div class="col-sm-2">
  &nbsp;
</div>
<div>
<div class="col-sm-3">
<div class="form-group">
  <button type=reset class="btn btn-default"> Reset </button>
</div>
</div>

<div class="col-sm-1">
<div class="form-group">
</div>
</div>
</div>

<div class="col-sm-3">
<div class="form-group">

  <button type=submit class="btn btn-primary"> Submit </button>
</div>
</div>
</div>


</div>
</form>
</div>
</body>
</html>
