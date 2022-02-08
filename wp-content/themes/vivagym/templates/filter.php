<div class="filter_main">
	<label for="province_select">SELECT <br>PROVINCE</label>
	<div class="select">

		<select name="province_select" class="province_select">
			
			<?php
				if(isset($_GET['province'])){
					$current = $_GET['province'];
					echo '<option value="" >All</option>';
				}else{
					$current = 'all';
					echo '<option value="" selected>All</option>';
				}

				$terms = get_terms([
				    'taxonomy' => 'provinces',
				    'hide_empty' => false,
				]);
				foreach($terms as $term){
					if($current == $term->slug){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					echo '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';
				}
			?>
		</select>

	</div>

	<button class="button refine">Refine</button>
</div>