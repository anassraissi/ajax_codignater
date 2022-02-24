<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
	<link https="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
		<title>Hello, world!</title>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 my-2">

				<h1 style="text-align:centre;">ajax_crud_codignater</h1>

				<hr style="background-color:black;color :white; height:2px;">
				

				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 my-2">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
					data-bs-target="#exampleModal">
					Add a record
				</button>

				<!-- insert Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="" method="post" id="form">

									<label for="">Name</label>
									<input type="text" id="name" class="form-control" value="">
									

									<label for="Email">Email</label>
									<input type="email" id="email" class="form-control">

								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" id="add">Add</button>
							</div>
						</div>
					</div>
				</div>

					<!-- edit Modal -->
					<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="editModal">Edit Modal</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="" method="post" id="edit_form">
                                   <input type="hidden" id="edit_id" value=""> 
									<label for="edit_name">Name</label>
									<input type="text" id="edit_name" class="form-control" value="" name="edit_name">
									<label for="edit_email">Email</label>
									<input type="email" id="edit_email" class="form-control" value="" name="edit_email">

								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" id="Update">Update</button>
							</div>
						</div>
					</div>
				</div>

			</div>
			<a href=""></a>
		</div>
		<div class="row">
			<div class="col-md-12 my-2">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tbody">
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		$(document).on("click", "#add", function (e) {
			e.preventDefault();
			var name = $("#name").val();
			var email = $("#email").val();
			// alert(email);
			if(name=="" || email ==""){
			     alert('both fields are required');
			}
			else{
				$.ajax({
				url: "<?php echo base_url();?>insert",
				type: "post",
				dataType: "json",
				data: {
					name: name,
					email: email
				},
				success: function (data) {
				
					$('#exampleModal').modal('hide');
					fetch();

					// fermer model apres ajouter un data
					if (data.message == "Success") {
						toastr["success"](data.message)
						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					} else {
						toastr["error"](data.message)

						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					}


				}

			});
			}
		
			$('#form')[0].reset(); // clear the inputs after insert data

		});

		function fetch() {
			$.ajax({
				url: "<?php echo base_url(); ?>fetch",
				type: "post",
				dataType: "json",
				success: function (data) {
					var tbody = "";
					var i = '1';
					for (var key in data) {
						tbody += "<tr>";
						tbody += "<td>" + i++ + "</td>";
						tbody += "<td>" + data[key]['name'] + "</td>";
						tbody += "<td>" + data[key]['email'] + "</td>";
						tbody += `<td>
					<a href="#" id="del" value="${data[key]['id']}" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt" aria-hidden="true"></i>
</a>
					<a href="#" id="edit" value="${data[key]['id']}" class="btn btn-sm btn-outline-success"><i class="fas fa-edit" aria-hidden="true"></i></a>

					</td>`;
						tbody += "</tr>";

					}
					$("#tbody").html(tbody);
				}
			});

		}
		fetch();
		$(document).on("click", "#del", function (e) {
			e.preventDefault();
			var del_id = $(this).attr('value');
			if (del_id == "") {
				alert("Delete id required");
			} else {
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-success mr-2',
						cancelButton: 'btn btn-danger '
					},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes, delete it!',
					cancelButtonText: 'No, cancel!',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: "<?php echo base_url(); ?>delete",
							type: "post",
							data: {
								del_id: del_id
							},
							dataType: "json",
							success: function (data) {
								fetch(); // aficher le nouveau data from basedonnes
								if (data.responce == "Success") {
									swalWithBootstrapButtons.fire(
										'Deleted!',
										'Your file has been deleted.',
										'success'
									)
								}

							}
						});

					} else if (
						/* Read more about handling dismissals below */
						result.dismiss === Swal.DismissReason.cancel
					) {
						swalWithBootstrapButtons.fire(
							'Cancelled',
							'Your imaginary file is safe :)',
							'error'
						)
					}
				})
			}
		});

	</script>
	<script>
		$(document).on("click", "#edit", function (e) {
			e.preventDefault();
			var edit_id = $(this).attr('value');
			if (edit_id == "") {
				alert('anaas');
		}
		else{
				$.ajax({
							url: "<?php echo base_url(); ?>edit",
							type: "post",
							data: {
								edit_id: edit_id
							},
							dataType: "json",
							success: function (data) {
								console.log(data);
								if(data.response =="Success"){
									$('#editModal').modal('show');
									$('#edit_id').val(data.post[0].id);
									$('#edit_email').val(data.post[0].email);
									$('#edit_name').val(data.post[0].name); //convertir de type tableau au 

								}
								else{
									toastr["error"](data.message)

										toastr.options = {
											"closeButton": true,
											"debug": false,
											"newestOnTop": false,
											"progressBar": true,
											"positionClass": "toast-top-right",
											"preventDuplicates": false,
											"onclick": null,
											"showDuration": "300",
											"hideDuration": "1000",
											"timeOut": "5000",
											"extendedTimeOut": "1000",
											"showEasing": "swing",
											"hideEasing": "linear",
											"showMethod": "fadeIn",
											"hideMethod": "fadeOut"
										}
								}
							}
			          });
			}
		});

		$(document).on("click", "#Update", function (e) {
            e.preventDefault();
             var edit_id=$('#edit_id').val();
			 var edit_name=$('#edit_name').val();
             var edit_email=$("#edit_email").val();
			 if(edit_id=="" || edit_name=="" ||edit_email=="")
			 {
				 alert("all field are required");
			 }
			 else{
				 $.ajax({
                url: "<?php echo base_url()?>update",
				type:"Post",
				dataType:"json",
				data : {
					edit_id: edit_id,
					edit_name: edit_name,
					edit_email: edit_email
				},
				success: function (data) {
					if(data.response=="Success"){
						fetch();
						$('#editModal').modal('hide');
						toastr["success"](data.message)

										toastr.options = {
											"closeButton": true,
											"debug": false,
											"newestOnTop": false,
											"progressBar": true,
											"positionClass": "toast-top-right",
											"preventDuplicates": false,
											"onclick": null,
											"showDuration": "300",
											"hideDuration": "1000",
											"timeOut": "5000",
											"extendedTimeOut": "1000",
											"showEasing": "swing",
											"hideEasing": "linear",
											"showMethod": "fadeIn",
											"hideMethod": "fadeOut"
										}

					}
					else{
						toastr["error"](data.message)

							toastr.options = {
								"closeButton": true,
								"debug": false,
								"newestOnTop": false,
								"progressBar": true,
								"positionClass": "toast-top-right",
								"preventDuplicates": false,
								"onclick": null,
								"showDuration": "300",
								"hideDuration": "1000",
								"timeOut": "5000",
								"extendedTimeOut": "1000",
								"showEasing": "swing",
								"hideEasing": "linear",
								"showMethod": "fadeIn",
								"hideMethod": "fadeOut"
							}
												}
					}
				
				 });
			 }


        });

	</script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
