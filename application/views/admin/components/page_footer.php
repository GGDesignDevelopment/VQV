	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo site_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo site_url('js/fileinput.min.js');?>"></script>
    <?php foreach ($scripts as $script) { echo $script; };?>
  </body>
</html>
