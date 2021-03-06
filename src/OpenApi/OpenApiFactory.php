<?php
namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

class OpenApiFactory implements OpenApiFactoryInterface
{
    private $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);
        // $pathItem = $openApi->getPaths()->getPath('/api/docs');
        // $operation = $pathItem->getGet();

        // $openApi->getPaths()->addPath('/api/docs', $pathItem->withGet(
        //     $operation->withParameters(array_merge(
        //         $operation->getParameters(),
        //         [new Model\Parameter('fields', 'query', 'Fields to remove of the output')]
        //     ))
        // ));

        $openApi = $openApi->withInfo((new Model\Info('Budget-fam_Api-Platform', 'v1.0.0', "It is an API allowing to manage the family budget  and be consume by client application Http requests."))
                            ->withExtensionProperty('info-key', 'Info value'));
        $openApi = $openApi->withExtensionProperty('key', 'Custom x-key value');
        $openApi = $openApi->withExtensionProperty('x-value', 'Custom x-value value');

        return $openApi;
    }
}