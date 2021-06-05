# Integration model generator
Generates PHP model classes from JSON objects, to be used in API requests, using wol-soft's php generator(TODO).

## Table of Contents ##

* [Motivation](#Motivation)
* [Installation](#Installation)
* [Basic usage](#Basic-usage)
* [Examples](#Examples)

## Motivation ##

TODO

## Installation ##

The recommended way to install integration-model-generator is through [Composer](http://getcomposer.org):
```
$ composer require ado-dg/integration-model-generator
```

## Basic usage ##

The first step is preparing your JSON, every field that should be dynamic in the model needs its value between % characters:
```json
{
  "name": "%name%"
}
```
Then, the generator needs to be initialized with following parameters:
*  namespace: the target namespace of the to be generated model
*  model path: the target directory of the to be generated model, will be made if doesn't exist and will be cleared if exists
*  schema path: the target directory where the JSON schema's require by wol-soft's library will be stored, will be made if doesn't exist

Finally, the generation itself can happen by calling the "generateIntegrationModels" method of the generator object. 
This requires the following parameters:
*  json: JSON body to be converted to model classes
*  model name: the name of the to be generated model class (both filename and classname)

## Examples ##

Following example is made for a JSON body required by Azure's TTS API.

JSON:

```json
{
  "documents": [
    {
      "id": 1,
      "text": "%text%"
    }
  ]
}
```
PHP code for generating the model class to corresponding JSON:

```php
use ado_dg\IntegrationModelGenerator\Generator;

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../../vendor/autoload.php';

$json = file_get_contents(__DIR__ . '/../../storage/azure.json');
$generator = new Generator('App\Models\IntegrationModels', __DIR__ . '/../Models/IntegrationModels', __DIR__ . '/../schema');
$generator->generateIntegrationModels($json, 'AzureJsonBody');
```

Now that the model class is generated it can be used as follows:

```php
$body = new App\Models\IntegrationModels\TestJsonBody(["text" => "This is a test sentence"]);
$json =  $body->jsonSerialize();
```
The json variable could now be passed along to an HTTP client as JSON body
