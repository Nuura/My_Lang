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
	       'type' => 'if',
	       'condition' =>
	       array (
		      'type' => 'INTEGER',
		      'value' => '1',
		      ),
	       'block' =>
	       array (
		      'type' => 'block',
		      'statements' =>
		      array (
			     array (
				    'type' => 'print',
				    'value' =>
				    array (
					   'type' => 'STRING',
					   'value' => 'Hello',
					   ),
				    ),
			     array (
				    'type' => 'print',
				    'value' =>
				    array (
					   'type' => 'STRING',
					   'value' => 'world',
					   ),
				    ),
			     ),
		      ),
	       );

function run($tree) {
  if ($tree['type'] == 'if')
    {
      $condition = run($tree['condition']);
      if($condition != 0)
	echo "bendo";
    }
  if ($rtr)
      else
    echo "Unable to handle node type ".$tree['type'];
}
run($tree);