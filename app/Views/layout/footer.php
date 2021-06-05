		</div>
		<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->

		<!-- Footer -->
		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
				<div class="copyright text-center my-auto">
					<span>Copyright &copy; <?= date('Y') ?> - Rahmat Rendy Prayogo - </span>
					<span class="text-primary font-weight-lighter">Made with <i class="fas fa-heart"></i></span>
				</div>
			</div>
		</footer>
		<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

		</div>
		<!-- End of Page Wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">

			<i class="fas fa-angle-up"></i>
		</a>

		<!-- Bootstrap core JavaScript-->
		<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
		<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

		<!-- Core plugin JavaScript-->
		<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

		<!-- Custom scripts for all pages-->
		<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>


		<script>
			// melihat preview foto dan namanya pada halmaan edit profil
			function preview() {
				const foto = document.querySelector('#foto');
				const fotoLabel = document.querySelector('.custom-file-label');
				const fotoPreview = document.querySelector('.img-preview');

				fotoLabel.textContent = foto.files[0].name;

				const fileFoto = new FileReader();
				fileFoto.readAsDataURL(foto.files[0]);

				fileFoto.onload = function(e) {
					fotoPreview.src = e.target.result;
				}
			}
		</script>

		<!-- jika level user adalah kasir maka sembunyikan kolom aksi produk dan button tambah-->
		<?php if ($user['level_user'] == 'kasir') : ?>
		    <script>
		        $(document).ready(function(){
			        $(".aksi-produk").hide("slow");

		        	$("#btn-tambah").mouseenter(function(){
			            $(this).hide("fast");
				        setTimeout(function(){
				        	$(".input-group")
				        		.hide("slow").removeClass("col-5")
				        		.show("slow").addClass("col-6");
				        }, 500)
		        	})
		        });
		    </script>
		<?php endif; ?>

		<script>
			// mengaktifkan tooltip
			$(function() {
				$('[data-toggle="tooltip"]').tooltip()
			})
		</script>

		</body>

		</html>