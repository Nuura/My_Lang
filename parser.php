<?php
// parser.php for  in /home/etna/sanche_p
// 
// Made by TARLOWSKI Valentin
// Login   <tarlow_v@etna-alternance.net>
// 
// Started on  Fri Mar 31 07:44:51 2017 TARLOWSKI Valentin
// Last update Sat Apr  1 17:27:11 2017 SANCHEZ Pierre
//

class Parser
{
  private $tokens;
  private $tree;
  
  public function __construct($tokens)
  {
    $this->tokens = $tokens;
  }
  
  public function parser()
  {
    $this->tree[] = $this->check_if();
    if ($this->tokens)
      exit('Parse error\n');
    else
      var_dump($this->tree);
  }
  
  private function check_if()
  {
    $this->shift_token();
    $this->expect('LEFT_PAREN');
    $cond = $this->expect('INTEGER');
    $this->expect('RIGHT_PAREN');
    $block = $this->check_block();
    return array('type' => 'if', 'condition' => $cond, 'block' => $block);
  }

  private function check_block()
  {
    $this->expect('LEFT_BRACE');
    $statements = [];
    $this->expect('RIGHT_BRACE');
    return array('type' => 'block', 'statements' => $statements);
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

$parser = array (
	   array (
		  'type' => 'IF',
		  'value' => 'if',
		  ),
	   array (
		  'type' => 'LEFT_PAREN',
		  'value' => '(',
		  ),
	   array(
		 'type' => 'INTEGER',
		 'value' => '1',
		 ),
	   array(
		 'type' => 'RIGHT_PAREN',
		 'value' => ')',
		 ),
	   array(
		 'type' => 'LEFT_BRACE',
		 'value' => '{',
		 ),
	   array(
		 'type' => 'RIGHT_BRACE',
		 'value' => '}',
		 )
);

$parser = NEW Parser($parser);
$parser->parser();