<?php 

namespace ado_dg\IntegrationModelGenerator;

use PHPModelGenerator\ModelGenerator;
use PHPModelGenerator\SchemaProvider\RecursiveDirectoryProvider;
use PHPModelGenerator\Model\GeneratorConfiguration;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FileSystemIterator;

use ado_dg\IntegrationModelGenerator\JsonSchemaGenerator;

class Generator
{
    private $schemaGenerator;
    private $modelGenerator;
    private $modelPath;
    private $schemaPath;

    function __construct($namespace, $modelPath, $schemaPath) {
        $this->modelPath = $modelPath;
        $this->schemaPath = $schemaPath;
        $this->buildDirectories();
        $this->schemaGenerator = new JsonSchemaGenerator();
        $this->modelGenerator = new ModelGenerator(
            (new GeneratorConfiguration())
                ->setNamespacePrefix($namespace)
                ->setPrettyPrint(true)
        );
        
    }

    function generateIntegrationModels($json, $modelName) {
        $this->generateSchema($json, $modelName);
        $this->modelGenerator->generateModels(
            new RecursiveDirectoryProvider($this->schemaPath),
            $this->modelPath
        );

    }

    private function generateSchema($json, $modelName) {
        $jsonSchema = $this->schemaGenerator->iterateJson(json_decode($json));
        file_put_contents($this->schemaPath . '/' . $modelName . '.json', json_encode($jsonSchema));
    }

    private function clearModelDir() {
        $dir = $this->modelPath;
        $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ( $ri as $file ) {
            $file->isDir() ?  rmdir($file) : unlink($file);
        }
    }

    private function buildDirectories(){
        $this->buildDir($this->schemaPath);
        $this->buildDir($this->modelPath);
        $this->clearModelDir();
    }

    private function buildDir($path){
        if (!is_dir($path)) {
            mkdir($path);
        }
    }
}