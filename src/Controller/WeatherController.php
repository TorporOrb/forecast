<?php 
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

//#[Route('/weather')]
class WeatherController extends AbstractController
{
    #[Route('/highlander-says/{threshold<\d+>?50}', host: 'api.localhost')]
    public function highlanderSaysApi(int $threshold): Response
    {
         $draw = random_int(0, 100);

         $forecast = $draw < $threshold ? "It's going to rain." : "It's going to be sunny.";
         
         $json = [
            'forecast' => $forecast, 
            'self' => $this->generateUrl(
                'app_weather_highlandersaysapi', 
                ['threshold' => $threshold], 
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
         ];

         Return new JsonResponse($json);
    }

    #[Route('/highlander-says/{threshold<\d+>?50}')]
    public function highlanderSays(int $threshold): Response
    {
         $draw = random_int(0, 100);

         $forecast = $draw < $threshold ? "It's going to rain." : "It's going to be sunny.";
         
         return $this->render('weather/highlander_says.html.twig', [
            'forecast' => $forecast,
         ]);
    }

    #[Route('/highlander-says/{guess}')]
    public function highlanderSaysGuess(string $guess): Response
    {
        $forecast = "It's going to $guess.";
         
         return $this->render('weather/highlander_says.html.twig', [
            'forecast' => $forecast,
         ]);
    }

    

}