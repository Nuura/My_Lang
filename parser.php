<?php
// parser.php for  in /home/etna/sanche_p
// 
// Made by TARLOWSKI Valentin
// Login   <tarlow_v@etna-alternance.net>
// 
// Started on  Fri Mar 31 07:44:51 2017 TARLOWSKI Valentin
// Last update Sun Apr  2 21:49:57 2017 SANCHEZ Pierre
//

class Parser
{
  private $tokens;
  private $tree;
  private $variables;
  private $funcs = array (
			 'VARIABLE' => 'check_var',
			 'IF' => 'check_if',
			 'PRINT' => 'check_print'
			 );
  
  public function __construct($tokens)
  {
    $this->tokens = $tokens;
  }
  
  public function parser()
  {
    do
      {
	$error = true;
	foreach ($this->funcs as $type => $func)
	  {
	    if ($type == $this->get_token()['type'])
	      {
		if ($this->get_token()['type'] != 'VARIABLE')
		  $this->tree[] = $this->$func();
		else
		  $this->$func();
		$error = false;
	      }
	  }
      }while ($this->tokens && $error != true);
    if ($this->tokens)
      echo "Parse error !\n";
    else
      return array('tree' => $this->tree, 'variables' => $this->variables);
  }

  private function check_print()
  {
    $this->shift_token();
    $value = $this->expect("STRING");
    $this->expect("SEMICOLON");
    return array('type' => 'print', 'value' => $value);
  }
  
  private function check_var()
  {
    $error = false;
    $this->shift_token();
    $name = $this->expect('VARNAME');
    $this->expect('AF');
    if ($this->get_token()['type'] == 'INTEGER' || $this->get_token()['type'] == 'STRING')
      $value = $this->expect($this->get_token()['type']);
    $this->expect('SEMICOLON');
    if (!empty($this->variables))
      foreach ($this->variables as $variable)
	if ($variable['name'] == $name['value'])
	  exit('Multiple variable declaration : ' . $name['value']);
    $this->variables[] = array('type' => 'variable', 'name' => $name['value'], 'value' =>  $value);
  }
  
  private function check_if()
  {
    $this->shift_token();
    $this->expect('LEFT_PAREN');
    $cond = $this->get_condition();
    $this->expect('RIGHT_PAREN');
    $block = $this->check_block()[0];
    if ($this->get_token()['type'] == 'ELSE')
      {
	$this->shift_token();
	return array('type' => 'if', 'condition' => $cond, 'block' => $block, 'else' => array('block' => $this->check_block()[0]));
      }
    else
      return array('type' => 'if', 'condition' => $cond, 'block' => $block);
  }

  private function get_condition()
  {
    while ($this->get_token()['type'] != 'RIGHT_PAREN')
      $cond[] = $this->shift_token();
    return $cond;
  }

  private function check_block()
  {
    $this->expect('LEFT_BRACE');
    $block = [];
    while ($action = $this->get_action())
      $block[] = $action;
    $this->expect('RIGHT_BRACE');
    return $block;
  }

  private function get_action()
  {
    if ($this->get_token()['type'] == "PRINT")
      {
	$this->shift_token();
	$value = $this->expect("STRING");
	$this->expect("SEMICOLON");
	return array('type' => 'print', 'value' => $value);
      }
    else if ($this->get_token()['type'] == "IF")
      {
	return $this->check_if();
      }
    else if ($this->get_token()['type'] == "VARIABLE")
      {
	$this->check_var();
	return 'variable';
      }
  }
  
  private function get_token()
  {
    return $this->tokens[0];
  }

  private function shift_token()
  {
    return array_shift($this->tokens);
  }

  private function expect($type)
  {
    $token = $this->shift_token();
    if ($token['type'] != $type)
      throw new Exception("Unexpected type " . $token['type'] . " : Expected type " . $type);
    else
      return $token;
  }
}