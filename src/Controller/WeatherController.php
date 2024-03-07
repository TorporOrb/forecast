<?php 
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/highlander-says')]
    public function highlanderSays(): Response
    {
         $draw = random_int(0, 100);

         $forecast = $draw < 50 ? "It's going to rain." : "It's going to be sunny.";
         
         return $this->render('weather/highlander_says.html.twig', [
            'forecast' => $forecast,
         ]);
    }
}