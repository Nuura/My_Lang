/*function run($tree) {                                                                                                                                                                                         
  if ($tree['type'] == 'if')                                                                                                                                                                                    
    {                                                                                                                                                                                                           
      $condition = run($tree['condition']);                                                                                                                                                                     
      if($condition != 0)                                                                                                                                                                                       
        {                                                                                                                                                                                                       
          $then = run($tree['then']);                                                                                                                                                                           
        }                                                                                                                                                                                                       
    }                                                                                                                                                                                                           
  else  if ($tree['type'] == 'INTEGER')                                                                                                                                                                         
    return $tree['value'];                                                                                                                                                                                      
                                                                                                                                                                                                                
  else if ($tree['type'] == 'block')                                                                                                                                                                            
    {                                                                                                                                                                                                           
      echo "bonsoir";                                                                                                                                                                                           
      foreach ($tree['statements'] as $statements)                                                                                                                                                              
      run($statements);                                                                                                                                                                                       
      }                                                                                                                                                                                                           
                                                                                                                                                                                                                
      else                                                                                                                                                                                                          
      echo "Unable to handle node type ".$tree['type'];                                                                                                                                                           
      }                                                                                                                                                                                                           
      run($tree);                                                                                                                                                                                                     
*/