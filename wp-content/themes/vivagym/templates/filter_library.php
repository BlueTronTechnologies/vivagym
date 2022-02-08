<form action="<?php bloginfo('url'); ?>/fitness-library/" method="get" class="library_filter_row">
	<div class="form_cont grid">
		
		<div>
			<h5>My Goal</h5>
		</div>
		<?php
		if(isset($_GET['goal1'])){
			$goal1 = $_GET['goal1'];
		}else{
			$goal1 = '';
		}
		if(isset($_GET['goal2'])){
			$goal2 = $_GET['goal2'];
		}else{
			$goal2 = '';
		}
		if(isset($_GET['goal3'])){
			$goal3 = $_GET['goal3'];
		}else{
			$goal3 = '';
		}
		$terms = get_terms([
			'taxonomy' => 'goals',
			'hide_empty' => false,
		]);
		$gcount = 1;
		foreach($terms as $term){
			if($goal1 == $term->slug || $goal2 == $term->slug || $goal3 == $term->slug){
				$selected = 'checked';
			}else{
				$selected = '';
			}
			echo '<div><label for="'.$term->slug.'">'.$term->name.'<input type="checkbox" id="'.$term->slug.'" name="goal'.$gcount.'" value="'.$term->slug.'" '.$selected.'></label></div>';
			$gcount++;
		}
		?>
		<div>
			<h5>INTENSTITY LEVEL:</h5>
		</div>
		<?php
		if(isset($_GET['intensity1'])){
			$intensity1 = $_GET['intensity1'];
		}else{
			$intensity1 = '';
		}
		if(isset($_GET['intensity2'])){
			$intensity2 = $_GET['intensity2'];
		}else{
			$intensity2 = '';
		}
		if(isset($_GET['intensity3'])){
			$intensity3 = $_GET['intensity3'];
		}else{
			$intensity3 = '';
		}
		$terms = get_terms([
			'taxonomy' => 'intensities',
			'hide_empty' => false,
		]);
		$intcount = 1;
		foreach($terms as $term){
			if($intensity1 == $term->slug || $intensity2 == $term->slug || $intensity3 == $term->slug){
				$selected = 'checked';
			}else{
				$selected = '';
			}
			echo '<div><label for="'.$term->slug.'">'.$term->name.'<input type="checkbox" name="intensity'.$intcount.'" id="'.$term->slug.'" value="'.$term->slug.'" '.$selected.'></label></div>';
			$intcount++;
		}
		?>
		<div class="button">
			<input type="submit" class="refine" value="refine"/>
		</div>
		
	</div>
</form>