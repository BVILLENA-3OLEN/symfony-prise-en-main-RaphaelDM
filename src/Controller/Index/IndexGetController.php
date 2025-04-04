<?php

declare(strict_types=1);

namespace App\Controller\Index;

use App\Enum\Entity\RoleEnum;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path:'/',
    name:'app_index_get'
)]

class IndexGetController extends AbstractController{

    public function __invoke(
        PostRepository $postRepository,
        #[MapQueryParameter]
        ?string $nom = NULL,
    ): Response{
        $allPublishedPosts = $postRepository->getAllPublished();
        // dump($allPosts);
        return $this->render(
            view: 'pages/index/index.html.twig',
            parameters: [
                'nom' => $nom,
                'published_posts' => $allPublishedPosts,
                'can_create' => $this->isGranted(RoleEnum::ADMIN->value),
            ],
        );
    }


}