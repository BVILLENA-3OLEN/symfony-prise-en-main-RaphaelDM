<?php
declare(strict_types=1);
namespace App\Controller\Hello;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


#[Route(
    path:'/hello/{name}',
    name:'app_hello_name_get',
    methods: [Request::METHOD_GET]
)]

class HelloNameGetController extends AbstractController
{
    public function __invoke(string $name , TranslatorInterface $translator): Response
    {
        return $this->render(
            view: 'pages/hello/hello-name.html.twig',
            parameters: [
                'page_title'=> $translator -> trans(
                    id : 'app.hello.name.title',
                    parameters:[
                        '%name%' => $name,
                    ]
                ),
                'name' => $name,
            ],
        );
    }
}