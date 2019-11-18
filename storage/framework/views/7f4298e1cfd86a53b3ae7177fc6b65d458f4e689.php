<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


    </head>
    <body>
    	<button type="button" class="btn-sm btn-primary" style="float:right; margin:10px" data-toggle="modal" data-target="#myModal">Add</button>
    	

        <div class="flex-center position-ref full-height">
        	
            <div class="content">
                <div class="title m-b-md">
                  	<table id="example" class="display" style="width:98%">
				        <thead>
				            <tr>
				                <th>Name</th>
				                <th>Email</th>
				                <th>Phone</th>
				                <th>Address</th>
				                <th>City</th>
				                <th>PosCode</th>
				                <th>Cost</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    <tr>
					                <td><?php echo e($item["first_name"]." ".$item["last_name"]); ?></td>
					                <td><?php echo e($item["email"]); ?></td>
					                <td><?php echo e($item["telnumber"]); ?></td>
					                <td><?php echo e($item["address1"]); ?></td>
					                <td><?php echo e($item["city"]); ?></td>
					                <td><?php echo e($item["postcode"]); ?></td>
					                <td><?php echo e($item["cost"]); ?></td>
				            	</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				        </tbody>
				    </table>
                </div>
            </div>
        </div>
    </body>

    <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	      	<form id="form">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Modal Header</h4>
	        </div>
	        <div class="modal-body">
	        	  <input type="hidden" id="_token" value="<?php echo e(csrf_token()); ?>">
		          <div class="form-group">
					  <label for="firstname">First Name:</label>
					  <input type="text" name="firstname" class="form-control" value="" id="firstname">
				  </div>
				  <div class="form-group">
					  <label for="lastname">Last Name:</label>
					  <input type="text" name="lastname" class="form-control" value="" id="lastname">
				  </div>
				  <div class="form-group">
					  <label for="firstname">Email:</label>
					  <input type="text" name="email" class="form-control" value="" id="firstname">
				  </div>
				  <div class="form-group">
					  <label for="lastname">Phone:</label>
					  <input type="text" name="phone" class="form-control" value="" id="lastname">
				  </div>
				  <div class="form-group">
					  <label for="lastname">Address:</label>
					  <input type="text" name="address" class="form-control" value="" id="lastname">
				  </div>
				
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	          <input type="submit" class="btn btn-primary" value="Save" />
	        </div>
	        </form>
	      </div>
	      
	    </div>
	</div>
</html>

<script>
	$(document).ready(function() {
	    $('#example').DataTable();
	} );

	$( "form" ).submit(function( event ) {
	     var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
	    $.ajax({
	        type: 'POST',
	        url: "<?php echo e(url('/')); ?>/csv",
	        data: formdata, // here $(this) refers to the ajax object not form
	        success: function (data) {
	           console.log(data);
	        },
	    });
    	event.preventDefault();
	});
</script>
