<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP - CRUD</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="pull-left">
					<h2>PHP CRUD</h2>
				</div>
				<div class="pull-right" style="margin-top: 20px">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item"> Create Item</button>
				</div>	
			</div>
		</div>

		<table class="table table-bordered" id="userData">
			<thead>
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th width="200px">Action</th>
				</tr>
			</thead>
			<tbody>
       <?php 
        require 'api/db_connect.php';
        $sql = "SELECT * FROM items ORDER BY id DESC";
        $result = $mysql->query($sql);
      ?>
      <?php if($result->num_rows>0):?>
        <?php while($row = $result->fetch_assoc()) {?>
				<tr id="tr_<?= $row['id'] ?>">
          <td id="aa"><?= $row['title'] ?></td>
          <td><?= $row['description'] ?></td>
          <td data-id="<?= $row['id'] ?>"><button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button>
          <button class="btn btn-danger remove-item">Delete</button>
          </td>    
        </tr>
          <?php }?>
      <?php endif ?>
			</tbody>
		</table>

	</div>


<!-- Create Item Modal -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Item</h4>
      </div>
      <div class="modal-body">
                <form data-toggle="validator" action="api/create.php" method="POST">
        	<div class="form-group">
        		<label class="control-label" for="title">Title:</label>
					<input type="text" name="title" class="form-control" data-error="Please enter title." required />
					<div class="help-block with-errors"></div>
        	</div>
        	<div class="form-group">
					<label class="control-label" for="title">Description:</label>
							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
							<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
					<button type="submit" class="btn crud-submit btn-success">Submit</button>
			</div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
      </div>
      <div class="modal-body">
			<form data-toggle="validator" action="api/update.php" method="put">
		      			<input type="hidden" name="id" class="edit-id">

		      			<div class="form-group">
							<label class="control-label" for="title">Title:</label>
							<input type="text" name="title" class="form-control" data-error="Please enter title." required />
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<label class="control-label" for="title">Description:</label>
							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
							<div class="help-block with-errors"></div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
						</div>

		      		</form>
      </div>
     
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/7.0.0/validator.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>

