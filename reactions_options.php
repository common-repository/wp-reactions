<div class="wrap">
	<script type="text/javascript">
	
		/*
		* Adds a new reaction input to the form table
		* Somewhat longwinded right now, but at least it works!
		*/
		function addInput() {
			var myTable = document.getElementById('options_table');
			var tBody = myTable.getElementsByTagName('tbody')[0];
			var newRow = document.createElement('tr');
		 	newRow.valign = 'top';
			var newHeader = document.createElement('th');
			newHeader.scope = 'row';
			newHeader.innerHTML = 'Reaction:';
			var newTd = document.createElement('td');
			var newInput = document.createElement('input');
			newInput.type = 'text';
			newInput.name = 'reactions[]';
			var newButton = document.createElement('input');
			newButton.type = 'button';
			newButton.value = 'Delete';
			newButton.onclick = function() {removeInput(this)};
			newTd.appendChild(newInput);
			newTd.appendChild(newButton);
			newRow.appendChild(newHeader);
			newRow.appendChild(newTd);
			tBody.appendChild(newRow);
		}
		
		/*
		* removes a reaction input from the form table
		*/
		function removeInput(element) {
			var i=element.parentNode.parentNode.rowIndex;
			document.getElementById('options_table').deleteRow(i);
		}
	</script>
	<h2>Reactions</h2>
	
	<form method="post" action="<?php echo WP_PLUGIN_URL;?>/wp-reactions/reactions_update.php">
		<?php wp_nonce_field('update-options'); ?>
		
		<table id="options_table" class="form-table">
			<?php
				echo '<th scope="row">Pre-Reaction Text:</th><td><input type="text" name="reactions_text" value="' . get_option('reactions_text') . '" /></td></tr>';
				$reactions = get_option('reactions');
				if($reactions != null) {
					foreach($reactions as $reaction) {
						echo '<th scope="row">Reaction:</th><td><input type="text" name="reactions[]" value="' . $reaction . '" /><input type="button" value="Delete" onclick="removeInput(this);"/></td></tr>';
					}
				} else {
					echo '<th scope="row">Reaction:</th><td><input type="text" name="reactions[]" value="" /><input type="button" value="Delete" onclick="removeInput(this);"/></td></tr>';
				}
			?>
		
		</table>
		<input type="button" value="Add another reaction" onClick="addInput('options_table');">

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="reactions" />
		<p>
			<b>Warning:</b> Saving changes to the reactions will reset the reaction counts on all posts.
		</p>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>