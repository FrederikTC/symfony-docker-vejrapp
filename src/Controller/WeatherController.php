<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\WeatherData;
use App\Entity\TestData;
use Doctrine\ORM\EntityManagerInterface;



class WeatherController extends AbstractController
{
    private HttpClientInterface $httpClient;
    private EntityManagerInterface $entityManager;

    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }

    #[Route('/app', name: 'weather_app')]
    public function Home(): Response
    {
        $parameterIds = ['temp_dry', 'temp_dew', 'humidity', 'weather'];
        $allData = [];

        $test_data = new TestData();
        $test_data->setStationId("22");
        $this->entityManager->persist($test_data);
        
        $this->entityManager->flush();


        // $test_2 = new WeatherData();
        // $test_2->setStationId("dwadwa");
        // $this->entityManager->persist($test_2);
        // $this->entityManager->flush();
    
        foreach ($parameterIds as $parameterId) {
            $response = $this->httpClient->request('GET', 'https://dmigw.govcloud.dk/v2/metObs/collections/observation/items', [
                'query' => [
                    'limit' => 10,
                    'parameterId' => $parameterId,
                ],
                'headers' => [
                    'X-Gravitee-Api-Key' => 'b6f4eedc-6898-499d-ba1e-ee427838c80d',
                ],
            ]);
    
            $statusCode = $response->getStatusCode();
    
            if ($statusCode === 200) {
                $content = $response->getContent();
                $data = json_decode($content, true);
                $allData[$parameterId] = $data;
            } else {
                // Handle errors or unexpected status codes for each parameter
                $allData[$parameterId] = "Failed fetching API data for parameter $parameterId";
            }
        }
    
        // Combine all data into a single response
        // Note: This example simply returns the raw combined data. You may want to process or format this data further.
        return new Response(json_encode($allData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
