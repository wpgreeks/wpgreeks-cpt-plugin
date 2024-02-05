<div class="WrapperArea">
	<div class="Title">
		<h1 class="wrap-title">Taxonomy Manager</h1>
	</div>

	<div class="ManagerWrapper">
		<?php settings_errors(); ?>

		<div class="CommonTabs">
			<ul class="nav nav-tabs">
				<li class="<?php echo !isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>"><a href="#tab-1">Your Taxonomies</a></li>
				<li class="<?php echo isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>">
					<a href="#tab-2">
						<?php echo isset($_POST["edit_taxonomy"]) ? 'Edit' : 'Add' ?> Taxonomy
					</a>
				</li>
			</ul>
		</div>

		<div class="tab-content">
			<div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>">
				<div class="CommonTable">
					<h3>Manage Your Custom Taxonomies</h3>

					<?php 
						$options = get_option( 'wpgreeks_plugin_tax' ) ?: array();

						echo '<table class="cpt-table"><tr><th>ID</th><th>Singular Name</th><th>Show Admin Column</th><th>Hierarchical</th><th class="text-center">Actions</th></tr>';

						foreach ($options as $option) {
							$hierarchical = isset($option['hierarchical']) ? "TRUE" : "FALSE";
							$show_admin_column = isset($option['show_admin_column']) ? "TRUE" : "FALSE";

							echo "<tr><td>{$option['taxonomy']}</td><td>{$option['singular_name']}</td><td>{$show_admin_column}</td><td>{$hierarchical}</td><td class=\"text-center\">";

							echo '<form method="post" action="" class="inline-block">';
							echo '<input type="hidden" name="edit_taxonomy" value="' . $option['taxonomy'] . '">';
							submit_button( 'Edit', 'primary small', 'submit', false);
							echo '</form> ';

							echo '<form method="post" action="options.php" class="inline-block">';
							settings_fields( 'wpgreeks_plugin_tax_settings' );
							echo '<input type="hidden" name="remove" value="' . $option['taxonomy'] . '">';
							submit_button( 'Delete', 'delete small', 'submit', false, array(
								'onclick' => 'return confirm("Are you sure you want to delete this Custom Taxonomy? The data associated with it will not be deleted.");'
							));
							echo '</form></td></tr>';
						}

						echo '</table>';
					?>
				</div>
			</div>

			<div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_taxonomy"]) ? 'active' : '' ?>">
				<div class="ManagerPost">
					<form method="post" action="options.php" id="<?php echo isset($_POST["edit_taxonomy"]) ? 'edit-tax-form' : 'add-tax-form' ?>">
						<?php 
							settings_fields( 'wpgreeks_plugin_tax_settings' );
							do_settings_sections( 'wpgreeks_taxonomy' );
							submit_button();
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>