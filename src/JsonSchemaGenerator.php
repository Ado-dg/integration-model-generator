<?php


namespace ado_dg\IntegrationModelGenerator;


class JsonSchemaGenerator
{
    private $finalJson;
    private $properties;

    function __construct(){
        $this->properties = [];
        $this->finalJson = [
            "id" => "TEST",
            "type" => "object",
            "properties" => [],
            "required" => []
        ];
    }
        
    function iterateJson($json){ 
        foreach($json as $key => $value){
            if (gettype($value) === "array") {
                $this->iterateJson($value);
            } 
            elseif (gettype($value) === "object") {
                $this->iterateJson($value);
            }
            elseif (gettype($value) === "integer") {
                $this->properties[$key] = array("type" => "integer", "default" => $value);
            }
            elseif (strpos($value, '%') !== false) {
                $name = str_replace('%', '', $value);
                $this->properties[$name] = array("type" => "string");
            }
        }
        $this->properties["json"] = array("type" => "string", "default" => "" . json_encode($json) . "");
        $this->finalJson["properties"] = $this->properties;
        return $this->finalJson;
    }
}