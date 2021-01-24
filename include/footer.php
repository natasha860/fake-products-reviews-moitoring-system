</div>
<footer class="bg-dark footer">
	<p class="text-white text-center mb-0 py-3 my-font-size">Copyright 2020-2022, Fake Review System</p>
</footer>

<!-- Approve New User Modal -->

<div class="modal bounceIn" id="approve_user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<h4 class="modal-header modal-title bg-dark text-center text-white py-2">Approve User ?</h4>
			<div class="modal-body text-dark">
				<h5>You Want to Approve This User ?</h5>
			</div>
			<div class="modal-footer  justify-content-center py-1">
				<a href="" class="btn btn-outline-success btn-sm approve_user">Approve</a>
				<button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">Cancle</button>
			</div>
		</div>
	</div>
</div>
<!-- --------End--------- -->

<!-- Delete Product Modal -->

<div class="modal bounceIn" id="del_product" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<h4 class="modal-header modal-title bg-dark  text-center text-white py-2">Delete Product ?</h4>
			<div class="modal-body text-dark ">
				<h5>You Want to Delete This Product ?</h5>
			</div>
			<div class="modal-footer justify-content-center py-1">
				<a href="" class="btn btn-outline-danger btn-sm del_product ">Delete</a>
				<button type="button" class="btn btn-outline-default btn-sm " data-dismiss="modal">Cancle</button>
			</div>
		</div>
	</div>
</div>
<!-- --------End--------- -->

<!-- Delete User From All Users Page -->

<div class="modal bounceIn" id="del_old_user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<h4 class="modal-header modal-title bg-dark text-white py-2">Delete User ?</h4>
			<div class="modal-body text-dark">
				<h5>You Want to Delete This User ?</h5>
			</div>
			<div class="modal-footer justify-content-center py-1">
				<a href="" class="btn btn-outline-danger btn-sm del_old_user">Delete</a>
				<button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">Cancle</button>
			</div>
		</div>
	</div>
</div>
<!-- --------End--------- -->

<!-- Delete User From New Users Page -->

<div class="modal bounceIn" id="del_new_user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<h4 class="modal-header modal-title bg-dark text-white py-2">Delete User's Request ?</h4>
			<div class="modal-body text-dark">
				<h5>You Want to Delete This New User's Registration Request ?</h5>
			</div>
			<div class="modal-footer justify-content-center py-1">
				<a href="" class="btn btn-outline-danger btn-sm del_new_user">Delete</a>
				<button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">Cancle</button>
			</div>
		</div>
	</div>
</div>
<!-- --------End--------- -->

<!-- Delete User From New Users Page -->

<div class="modal bounceIn" id="del_cat" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<h4 class="modal-header modal-title bg-dark text-white py-2">Delete Category ?</h4>
			<div class="modal-body text-dark">
				<h5>You Want to Delete This Category ?</h5>
				<small class="text-danger font-weight-bolder">Alert:</small><br>
				<small class="text-danger">If You Delete Category, All Products Related To This Category Will Also Be Deleted</small>
			</div>
			<div class="modal-footer justify-content-center py-1">
				<a href="" class="btn btn-outline-danger btn-sm del_cat">Delete</a>
				<button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">Cancle</button>
			</div>
		</div>
	</div>
</div>
<!-- --------End--------- -->
<script src="./assets/js/jquery-3.5.1.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/bootstrap-notify.js"></script>
<script src="./assets/js/notify.js"></script>


<?php
// it will check wheather to show info or error message or not
if ($is_notify) {
?>
	<script type="text/javascript">
		code.showNotification('top', 'right', '<?php echo $notify['message'] . "','" . $notify['icon'] . "','" . $notify['color']; ?>');
	</script>
	<?php
}
if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
	if (isset($_GET['login']) || isset($_GET['a_login']) || isset($_GET['approve']) || isset($_GET['del']) || isset($_GET['update_product']) || isset($_GET['update_user']) || isset($_GET['added'])) {
	?>
		<script type="text/javascript">
			var url = "http://localhost/fake_review_system/admin/<?php echo basename($_SERVER['PHP_SELF']); ?>";
			window.history.replaceState(null, null, url);
		</script>
<?php
	}
}
?>

<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip();

	// DELETE PRODUCT

	$(document).ready(function() {
		$(".approve_user_link").on('click', function() {
			var id = $(this).attr("rel");
			var appr_url = "new_users.php?approve=" + id + " ";

			$(".approve_user").attr("href", appr_url);
			$("#approve_user").modal('show');
		});
	});

	// END

	// DELETE PRODUCT

	$(document).ready(function() {
		$(".del_product_link").on('click', function() {
			var id = $(this).attr("rel");
			var del_url = "all_products.php?del=" + id + " ";

			$(".del_product").attr("href", del_url);
			$("#del_product").modal('show');
		});
	});

	// END

	// DELETE USERS

	$(document).ready(function() {
		$(".del_old_user_link").on('click', function() {
			var id = $(this).attr("rel");
			var del_url = "all_users.php?del=" + id + " ";

			$(".del_old_user").attr("href", del_url);
			$("#del_old_user").modal('show');
		});
	});

	// END

	// DELETE USERS

	$(document).ready(function() {
		$(".del_new_user_link").on('click', function() {
			var id = $(this).attr("rel");
			var del_url = "new_users.php?del=" + id + " ";

			$(".del_new_user").attr("href", del_url);
			$("#del_new_user").modal('show');
		});
	});

	$(document).ready(function() {
		$(".del_cat_link").on('click', function() {
			var id = $(this).attr("rel");
			var del_url = "add_category.php?del=" + id + " ";

			$(".del_cat").attr("href", del_url);
			$("#del_cat").modal('show');
		});
	});

	// END
	// $(document).ready(function() {

	// 	function getBadgeCount() {
	// 		$.ajax({
	// 			url: 'notifications.php',
	// 			data: {
	// 'id': '<'
	// 			},
	// 			method: 'get',
	// 			dataType: 'json',
	// 			success: function(response) {
	// 				if (response.count > 0) {
	// 					$('.badge-count').html(response.count);
	// 					$('.badge-count').removeClass('d-none');
	// 				} else {
	// 					$('.badge-count').html(response.count);
	// 					$('.badge-count').addClass('d-none');
	// 				}
	// 				setTimeout(function() {
	// 					getBadgeCount();
	// 				}, 1000);
	// 			}
	// 		});
	// 	}

	// 	getBadgeCount();
	// });

	// END
</script>
</body>

</html>