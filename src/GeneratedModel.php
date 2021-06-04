<?php


namespace ado_dg\IntegrationModelGenerator;

use JsonSerializable;

class GeneratedModel implements JsonSerializable
{
    protected $json;

    public function toJson(){
        $dynamicJson = $this->json;
        $class_vars = get_object_vars($this);
        foreach ($class_vars as $name => $value) {
            if($name !== "json") {
                $needle = '%' . $name . '%';
                if(is_string($value)){
                    $value = sprintf('%s', $value);
                }
                $dynamicJson = str_replace($needle, $value, $dynamicJson);
            }
        }
        return $dynamicJson;
    }
    
    public function jsonSerialize() {
        return json_decode($this->toJson());
    }
}