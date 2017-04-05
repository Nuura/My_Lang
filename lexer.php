#!/usr/bin/env php
<?php
// lexer.php for  in /home/etna
// 
// Made by TARLOWSKI Valentin
// Login   <tarlow_v@etna-alternance.net>
// 
// Started on  Wed Mar 29 08:41:34 2017 TARLOWSKI Valentin
// Last update Wed Apr  5 22:07:41 2017 TARLOWSKI Valentin
//

REQUIRE_ONCE("parser.php");

class Lexer
{
  private $code;
  private $tokens;
  private $rules = [
		    ['if', 'IF'],
		    ['else', 'ELSE'],
		    ['\(', 'LEFT_PAREN'],
		    ['\)', 'RIGHT_PAREN'],
		    ['\d+', 'INTEGER'],
		    ['\{', 'LEFT_BRACE'],
		    ['\}', 'RIGHT_BRACE'],
		    [';', 'SEMICOLON'],
		    ['print', 'PRINT'],
		    ['\".+\"', 'STRING'],
		    ['var', 'VARIABLE'],
		    ['[\w]+', 'VARNAME'],
		    ['(=)[^=<>]', 'AF'],
		    ['(>)[^=<>]', 'GR'],
		    ['(<)[^=<>]', 'LOW'],
		    ['>=', 'GR_EQ'],
		    ['<=', 'LOW_EQ'],
		    ['==', 'EQ'],
		    ['!=', 'NOT'],
		    ['\+', 'PLUS'],
		    ['-', 'LESS'],
		    ['\*', 'MULT'],
		    ['\/', 'DIV']
		    ];
  
  public function __construct($input)
  {
    $this->code = $input;
  }

  public function tokenization()
  {
    $error = false;
    while(strlen($this->code) > 1 && !$error)
      {
	$this->clean_code();
	$error = true;
	foreach ($this->rules as $rule)
	  if (preg_match("/^" . $rule[0] . "/", $this->code, $preg))
	    {
	      $error = false;
	      if (isset($preg[1]))
		$preg[0] = $preg[1];
	      $this->tokens[] = [
				 'type' => $rule[1],
				 'value' => $preg[0]
				 ];
	      $this->code = substr($this->code, strlen($preg[0]));
	      break;
	    }
      } 
    if ($error)
      {
	echo "No match found for " . $this->code . "\n";
	return 1;
      }
    return $this->tokens;
  }

  private function clean_code()
  {
    $this->code = ltrim($this->code);
  }
}

$code = "var test = 15;
if (test > 10)
{
     print \"Hello World\";
}
else
{
     if (5 == 5)
     {
        print \"Oui\";
     }
}";

$lexer = NEW Lexer($code);
$tokens = $lexer->tokenization();
$parser = NEW Parser($tokens);
$tree = $parser->parser();

var_dump($tree);