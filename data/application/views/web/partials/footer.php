		<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
			<p class="text-muted text-center text-md-left">Copyright © 2021 - <?= date('Y'); ?> <a href="#" target="_blank">Nur Arifin</a>. All rights reserved</p>
		</footer>

		</div>
		</div>

		<script src="<?= base_url(); ?>assets/js/file-upload.js"></script>
		<script src="<?= base_url(); ?>assets/js/template.js"></script>
		<script src="<?= base_url(); ?>assets/js/data-table.js"></script>
		<script src="<?= base_url(); ?>assets/js/file-upload.js"></script>
		<script src="<?= base_url(); ?>assets/js/dropzone.js"></script>
		<script src="<?= base_url(); ?>assets/js/dropify.js"></script>
		<script src="<?= base_url(); ?>assets/js/select2.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/core/core.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/dropify/dist/dropify.min.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/dropify-multiple-master/dist/js/dropify-multiple.min.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/dropzone/dropzone.min.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/feather-icons/feather.min.js"></script>
		<script src="<?= base_url(); ?>assets/vendors/select2/select2.min.js"></script>
		<?= (isset($footer) && $footer != NULL) ? $footer : "";?>
	</body>

</html>