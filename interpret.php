#!/usr/bin/env php
   <?php
   // interpret.php for  in /home/etna/sanche_p
   // 
   // Made by SANCHEZ Pierre
   // Login   <sanche_p@etna-alternance.net>
   // 
   // Started on  Sat Apr  1 17:51:59 2017 SANCHEZ Pierre
   // Last update Sat Apr  1 18:16:35 2017 SANCHEZ Pierre
   //

$tree = array (		
	       'tree' =>
	       array(
		     array(
			   'type' => 'if',
			   'condition' =>
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


  
function run($tree) {
  if ($tree[0][0]['type'] == 'if')
    {
      $condition = run($tree['condition']);
      if($condition != 0)
	echo "bendo";
    }
  else
    echo "Unable to handle node type ".$tree['type'];
}
run($tree);