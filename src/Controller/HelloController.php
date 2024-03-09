<?php  

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/hello')]
class HelloController extends AbstractController
{
    public function __invoke(): Response
    {
        return new Response("Hello!");
    }
}