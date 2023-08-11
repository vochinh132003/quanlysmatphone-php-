
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script>
		function Img1(x) {
			document.getElementById("fname").src = "images/aocamtho1.png";
		}
		function Img2(x) {
			document.getElementById("fname").src = "images/aocamtho.png";
		}
		function Img3(x) {
			document.getElementById("fname1").src = "images/aomeoxam1.png";
		}
		function Img4(x) {
			document.getElementById("fname1").src = "images/aomeoxam.png";
		}
		function Img5(x) {
			document.getElementById("fname2").src = "images/aosimpson1.png";
		}
		function Img6(x) {
			document.getElementById("fname2").src = "images/aosimpson.png";
		}
		function Img7(x) {
			document.getElementById("fname3").src = "images/damjean1.png";
		}
		function Img8(x) {
			document.getElementById("fname3").src = "images/damjean.png";
		}
	</script>
	<script>
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function () { scrollFunction() };

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				document.getElementById("myBtn").style.display = "block";
			} else {
				document.getElementById("myBtn").style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>
	<script>
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function (form) {
				form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})

	</script>
	<script>
		$(document).ready(function () {
			$("#xemthem").click(function () {
				$("collapse").toggle();
			});
		});
	</script>
</head>

<body>
	<?php
	include "navbarr.php";
	?>
	<?php
	include "content.php";
	?>
	<?php
	include "footer.php";
	?>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	<script src="http://localhost/DOANPHPMYSQL_2023/admin/assets/js/cart.js"></script>
	<script language="Javascript">
		function displayInvoice(productId) {
			// Chuyển hướng người dùng đến trang hiển thị hoá đơn với tableId
			window.location.href = 'chitietsanpham.php?productId=' + productId;
		}
	</script>
</body>

</html>