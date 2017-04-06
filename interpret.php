#!/usr/bin/env php
<?php
// interpret.php for  in /home/etna/sanche_p
// 
// Made by SANCHEZ Pierre
// Login   <sanche_p@etna-alternance.net>
// 
// Started on  Sat Apr  1 17:51:59 2017 SANCHEZ Pierre
// Last update Thu Apr  6 10:22:05 2017 SANCHEZ Pierre
//

$parse = array (		
		'tree' =>
		array(
		      array(
			    'type' => 'if',
			    'condition' =>
			    array(
				  array (
					 'type' => 'VARNAME',
					 'value' => 'test',
					 ),
				  array (
					 'type' => 'GR',
					 'value' => '>',
					 ),
				  array(
					'type' => 'INTEGER',
					'value' => '10',
					),
				  ),
			    ),
		      'block' =>
		      array(
			    'type' => 'print',
			    'value' =>
			    array(
				  'type' => 'STRING',
				  'value' => 'Hello World',
				  ),
			    ),
		      'else' =>
		      array(
			    'block' =>
			    array(
				  'type' => 'if',
				  'condition' =>
				  array(
					array(
					      'type' => 'INTEGER',
					      'value' => '5',
					      ),
					array(
					      'type' => 'EQ',
					      'value' => '==',
					      ),
					array(
					      'type' => 'INTEGER',
					      'value' => '5',
					      ),
					),
				  'block' =>
				  array(
					'type' => 'print',
					'value' =>
					array(
					      'type' => 'STRING',
					      'value' => 'oui',
					      ),
					),
				  ),
			    ),
		      ),
		'variables' =>
		array(
		      array(
			    'type' => 'variable',
			    'name' => 'test',
			    'value' =>
			    array(
				  'type' => 'INTEGER',
				  'value' => '15',
				  ),
			    ),
		      array(
			    'type' => 'variable',
			    'name' => 'test',
			    'value' =>
			    array(
				  'type' => 'STRING',
				  'oui',
				  ),
			    ),
		      ),
				);



function run($parse) {
  $i = 0;
  if(isset($parse['tree']))
    $tree = $parse['tree'];
  else
    $tree = $parse;
  while(isset($tree[$i]))
    {
     if ($tree[$i]['type'] == 'if')
	{
	  echo "If Detected\n";
	  $condition = run($tree[$i]['condition']);
	  if($condition !=  0)
	  echo "Condition Detected\n";
	}
     else if ($tree[$i]['type'] == 'VARNAME')
       {
	 $j = 0;
	 while(isset($parse['variables'][$j]))
	   { 
	     echo "oui";
	     if($parse['variables'][$j]['name'] == $tree[$i]['value'])
	       {	   
		 echo "non"; 
		 $var[] = $parse[$variable][$j]['value']['value'];
		 echo $var[0];	     
	       }
	   }
       }
     else if ($tree[$i]['type'] == 'GR')
       echo "Greater Detected\n";
     else if ($tree[$i]['type'] == 'INTEGER')
       {
	 echo "Int Detected\n";
	 $block = run($tree[$i]['block']);
	   if($block != 0)
	     echo "block detected";
       }
     else
       echo "Unable to handle node type ".$tree[$i]['type'];
     $i++;
    }
}
run($parse);