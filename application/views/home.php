<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Todo List</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
	
</head>
<body>
	
	
	<div class="container">
		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
				<form method="POST" role="form" onsubmit="return post()">
					<legend>Todo List</legend>
				
					<div class="form-group">
						<label for="">Add your todo list here</label>
						<input type="text" class="form-control" id="inlist" placeholder="list . . .">
						<button type="submit" class="hidden"></button>
						<br>
						<div class="input-group">
							<input type="text" class="form-control" id="exampleInputAmount" placeholder="Search">
							<span class="input-group-btn">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
									<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Action</a>
									<br>
									<a class="dropdown-item" href="#">Another action</a>
									<br>
									<a class="dropdown-item" href="#">Something else here</a>
								</div>
							</span>
						</div>

					</div>
				</form>
				
			</div>
		</div>

		
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<label>Status List</label>
				<select name="" id="input" class="form-control">
					<option value="">-- All --</option>
					<option value="">Finished</option>
					<option value="">Todo</option>
				</select>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<label>Category</label>
				<select name="" id="input" class="form-control">
				<option value="">-- All --</option>
					<option value="">Work</option>
					<option value="">Learn</option>
				</select>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th style="width: 5px">Status</th>
							<th>List</th>
							<th style="width: 5px">Action</th>
						</tr>
					</thead>
					<tbody id="t_body">
						
					</tbody>
				</table>
				
			</div>
		</div>
		
		
	</div>
	

	<script src="<?=base_url('assets/js/jquery-3.4.1.min.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
</body>
<script>

	get()

	function get() {
		var ok = ''
		var st = 0
		$.ajax({
			type: 'GET',
			url: "<?=base_url()?>index.php/Home/ajax_get",
			dataType: "json",
			success: function(data) {
				$('#t_body').html('');
				for(i=0;i<data.length;i++)
				{
					if(data[i].status == 1){
						ok = 'checked'
						st = 0
					}
					else{
						ok = ''
						st = 1
					}
					console.log(data[i].list)
					$('#t_body').append(
						"<tr><td><input type='checkbox' id='st"+data[i].id+"' onclick='status("+data[i].id+")' value='"+st+"' "+ok+"></td>"+
						"<td><div style='margin: 10px' ondblclick='onedit("+data[i].id+")' id='list"+data[i].id+"'>" + 
							"<label id='item"+data[i].id+"'>"+data[i].list+"</label></div></td>"+
						"<td><button type='button' onclick='delet("+data[i].id+")' class='btn btn-danger'>X</button></td></tr>"
					)
				}
			}
		})
	}
	function post() {
		$.ajax({
			type: 'POST',
			url: "<?=base_url()?>index.php/Home/ajax_post",
			data: {list: document.getElementById('inlist').value},
			dataType: 'json',
			success: function(resp){
				get();
			}
		})
		return false;
	}

	function delet(id) {
		$.ajax({
			type: 'POST',
			url: "<?=base_url()?>index.php/Home/ajax_delete",
			data: {id: id},
			dataType: 'json',
			success: function(resp){
				get();
			}
		})
		return false;
	}

	function status(id) {
		var st = document.getElementById('st'+id).value
		$.ajax({
			type: 'POST',
			url: "<?=base_url()?>index.php/Home/ajax_put_status",
			data: {id: id, status: st},
			dataType: 'json',
			success: function(resp){
				get();
			}
		})
		return false;
	}

	function onedit(id) {
		var item = document.getElementById('item'+id).innerHTML
		var edit = "<form onsubmit='return editok("+id+")' method='POST'>" +
			"<input type='text' class='form-control' id='edit"+id+"' value='"+item+"'>"+
			"</form>";
		document.getElementById('list'+id).innerHTML = edit
	}

	function editok(id) {
		var item = document.getElementById('edit'+id).value
		document.getElementById('list'+id).innerHTML = "<label id='item"+id+"'>"+item+"</lebael>"
		$.ajax({
			type: 'POST',
			url: "<?=base_url()?>index.php/Home/ajax_put",
			data: {list_new: item, id: id},
			dataType: 'json',
			success: function(resp){
			}
		})
		return false;
	}
</script>
</html>