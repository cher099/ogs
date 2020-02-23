<script type="text/javascript">
window.onload = (e) => {
	$(document).ready(function () {
		window.setTimeout(function() {
    		$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        		$(this).remove(); 
    		});
		}, 1000);
 	});
}
</script>
<?php 
if (isset($_SESSION['error'])){
?>
	<div class="alert alert-danger m-2 alert-dismissible fade show">
		<?php echo $_SESSION['error']; ?>
		 <button class="close" data-dismiss="alert" type="button">
            <span>×</span>
        </button>
	</div>
<?php
	unset($_SESSION['error']);
}

if (isset($_SESSION['success'])){
?>
	<div class="alert alert-success m-2 alert-dismissible fade show">
		<?php echo $_SESSION['success']; ?>
		<button class="close" data-dismiss="alert" type="button">
            <span>×</span>
        </button>
	</div>
<?php
	unset($_SESSION['success']);
}
?>
