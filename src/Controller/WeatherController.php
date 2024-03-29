<?php 
declare(strict_types=1);

namespace App\Controller;

use App\Service\Highlander;
use App\Model\HighlanderApiDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/{_locale}/weather', requirements: [
   '_locale' => 'en|de'
])]
class WeatherController extends AbstractController
{
   #[Route('/highlander-says/api')]
   public function highlanderSaysApi(
      Highlander $highlander,
      #[MapQueryString] ?HighlanderApiDTO $dto = null,
   ): Response
   {
         if(!$dto){
            $dto = new HighlanderApiDTO();
            $dto->threshold = 50;
            $dto->trials = 1;
         }

         $forecasts = $highlander->say($dto->threshold, $dto->trials);
         $json = [
            'forecasts' => $forecasts, 
            'threshold' => $dto->threshold,
         ];

         return $this->json($json);
    }

    #[Route('/highlander-says/{threshold<\d+>}')]
    public function highlanderSays(
      Request $request,
      RequestStack $requestStack,
      TranslatorInterface $translator,
      Highlander $highlander,
      ?int $threshold = null,
      #[MapQueryParameter]?string $_format = 'html',
      ): Response
    {
         
      
      $session = $requestStack->getSession();

      if ($threshold){
         $session->set('threshold', $threshold);
         $this->addFlash(
            'info', 
            $translator->trans('weather.highlander_says.success',
         [ '%threshold%' => $threshold,]),            
         );
      } else {
         $threshold = $session->get(name: 'threshold', default: 50);
      }
      
      $trials = (int) $request->get(key: 'trials', default: 1);

      $forecasts = $highlander->say($threshold, $trials);
      
      $html = $this->renderView("weather/highlander_says.{$_format}.twig", [
         'forecasts' => $forecasts,
         'threshold' => $threshold,
      ]);

      $response = new Response($html);
      return $response; 
    }

    #[Route('/highlander-says/{guess}')]
    public function highlanderSaysGuess(string $guess): Response
    {
         $availableGuesses = ['snow', 'rain', 'hail'];
         if(!in_array($guess, $availableGuesses)){
            throw $this->createNotFoundException('This guess is not found.');
         }
         $forecast = "It's going to $guess.";
      
         
         return $this->render('weather/highlander_says.html.twig', [
            'forecasts' => [$forecast],
         ]);
    }

    

}