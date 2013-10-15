<?php
	$directory = "wp-content/themes/insurancequotesorg/assets/images/logos/insurance-companies/white";
	
	    $results = array(); // create an array to hold directory list
	    $handler = opendir($directory); // create a handler for the directory
	    $totalFiles = 0; // Create a total file counter
	    $allimages = array();
	    while ($file = readdir($handler)) { // keep going until all files in directory have been read
	        if ($file != '.' && $file != '..') { // if $file isn't this directory or its parent, add it to the results array
	         $totalFiles++; // Counter for total files
	         $allimages[] = $file;
	        }
	    }
	    closedir($handler); // close the handler
	    asort($allimages);
	    for ( $i = 0; $i < sizeof($allimages); $i++ ) {
	echo '<img src="'. get_option('home') . '/wp-content/themes/insurancequotesorg/assets/images/logos/insurance-companies/white/'.$allimages[$i].'" alt="Quotes from Trusted Agents" class="rotating-item" />';
		}
?>