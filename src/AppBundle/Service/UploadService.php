<?php
// src/Service/UploadService.php
namespace AppBundle\Service;

class UploadService
{
    public function upload($files)
    {
        $messages = [];
        $arr_objects = [];

        if (isset($files['tmp_name']))
        {   
            foreach ($files['tmp_name'] as $key => $file) 
            {   
                // Verifica se o arquivo importado é válido (formato)
                if ($files['type'][$key] === 'text/xml' || $files['type'][$key] === 'application/xml')
                {
                    // Trata como XML para tratar o erro do shiporders.xml
                    libxml_use_internal_errors(true);

                    $xml = @simplexml_load_file($file);
                    $errors = libxml_get_errors();

                    if (count($errors) > 0) 
                    {
                        $lines = file($file); // Trás o arquivo em forma de array

                        foreach ($errors as $error) 
                        {
                            // Corrige problema nos shiporders.xml (Tags não fechando corretamente)
                            if (strpos($error->message, 'Opening and ending tag mismatch') !== false) 
                            {
                                // REGEX pra encontrar a tag que está com problema
                                $tag   = trim(preg_replace('/Opening and ending tag mismatch: (.*) line.*/', '$1', $error->message));
                                $line  = $error->line - 2;
                                
                                if (isset($lines[$line]))
                                {
                                    if (strpos($lines[$line], '/') === false) 
                                    {
                                        $lines[$line] = '</' . $tag . '>';
                                    }
                                }
                            }
                        }
        
                        $xml = implode("", $lines);
                        $xml = simplexml_load_string($xml);
                    }

                    $arr_objects[] = $xml;
                }
            }

            return $arr_objects;
        }
    }
}