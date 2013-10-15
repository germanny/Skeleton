<?php

$state_list = array ( 'Alabama',  'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming');
$states = '';

foreach($state_list as $state) { 

	$map_state = $state;
	include('inc-state-abbreviations.php');
	$map_abbr = strtolower($abbr);

	$states .= '<li id="'.$map_abbr.'"><a href="'.home_url().'/states/'.strtolower(str_replace(" ", "-", $state)).'/" title="Home Insurance in '.$state.'" rel="bookmark" class="url"><span>'.strtoupper($map_abbr) .'</span>  - '. $state.'</a></li>';
}

$list_elements = explode('</li>', $states);
$num = count($list_elements)-1;
$col = 3; //SET THE NUMBER OF COLUMNS
$num_col = ceil($num/$col);

for( $i=1; $i<$col; $i++) { $list_elements[$i*$num_col] = '</ul><ul>'.$list_elements[$i*$num_col]; }
$list = implode('</li>', $list_elements); ?>

<ul class="links_list">
<?php echo $list; ?>
</ul>

<hr class="clearer">