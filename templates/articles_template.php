<div class="container">
<br>
    <div class="page-header">
	        <h1><?=$pageTitle;?></h1>
    </div>
	<form id="articles" method="post" action="<? echo $action; ?>">

		<h3>Name</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Name</span>
						<input type="text" name="name" id="name" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $name; ?>">
                    	<input type="hidden"  id="originalName" value="<?php echo $name; ?>">
					</div>
				</div>
			</div>

        <h3>Number of Units</h3>
        	<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Units</span>
						<input type="text" name="units" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $units; ?>">
					</div>
				</div>
			</div>

		<h3>Value</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<span class="input-group-addon">$</span>
						<input type="text" name="value" class="form-control"  aria-describedby="basic-addon1" value="<?php echo $value; ?>">
						<span class="input-group-addon">.00</span>
					</div>
				</div>
			</div>


		<br>
        <div>
			<input type="hidden" name="ID"  value="<?php echo $ID; ?>" />
            <input  class="btn btn-lg btn-primary center-block" id="submit-button" type="submit" value="submit" />
        </div>
	</form>
	</div>  <!-- end of container-->