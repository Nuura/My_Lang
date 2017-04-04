#!/usr/bin/env php
<?php
// lexer.php for  in /home/etna
// 
// Made by TARLOWSKI Valentin
// Login   <tarlow_v@etna-alternance.net>
// 
// Started on  Wed Mar 29 08:41:34 2017 TARLOWSKI Valentin
// Last update Sat Apr  1 01:33:34 2017 SANCHEZ Pierre
//

class Lexer
{
  private $code;
  private $tokens;
  private $rules = [
		    ['if', 'IF'],
		    ['else', 'ELSE'],
		    ['\(', 'LEFT_PAREN'],
		    ['\)', 'RIGHT_PAREN'],
		    ['\d', 'INTEGER'],
		    ['\{', 'LEFT_BRACE'],
		    ['\}', 'RIGHT_BRACE'],
		    [';', 'SEMICOLON'],
		    ['print', 'PRINT'],
		    ['\"[\w]+\"', 'STRING'],
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
    $this->cleanCode();
    do
      {
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
      } while($this->code && !$error);
    if ($error)
      {
	echo "No match found for " . $this->code . "\n";
	return 1;
      }
    return $this->tokens;
  }

  private function cleanCode()
  {
    $this->code = str_replace("\n", "", $this->code);
    $this->code = str_replace(" ", "", $this->code);
  }
}

$code = "if (1) { }";

$lexer = NEW Lexer($code);
$tokens = $lexer->tokenization();

var_dump($tokens);