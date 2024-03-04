<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'App:FetchWeatherData',
    description: 'Fetches the latest weather data from DMI',
)]
class AppFetchWeatherDataCommand extends Command
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        // Best practice is to call the parent constructor
        parent::__construct();

        $this->httpClient = $httpClient;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $stationId = 'yourStationIdHere'; // Ensure you replace this with the actual station ID you intend to query.

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        // Fetch weather data from DMI API
        $response = $this->httpClient->request('GET', 'https://dmigw.govcloud.dk/v2/metObs/collections/observation/items', [
            'query' => [
                'stationId' => $stationId,
                'limit' => 10,
            ],
            'headers' => [
                'X-Gravitee-Api-Key' => 'fef72e57-493c-477c-805a-dc0ea7b77616',
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        if ($statusCode === 200) {
            // Process and print data
            $io->success('Data fetched successfully');
            $output->writeln($content);
        } else {
            $io->error('Error fetching data');
        }

        return Command::SUCCESS;
    }
}
