<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;

class GoogleAnalyticsService
{
    private BetaAnalyticsDataClient $client;

    public function __construct(string $credentialsPath)
    {
        $this->client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath
        ]);
    }

    public function getVisitors(string $propertyId): int
    {
        try {
            // Créer l'objet RunReportRequest
            $request = new RunReportRequest([
                'property' => 'properties/' . $propertyId,
                'dateRanges' => [
                    new DateRange([
                        'start_date' => '30daysAgo',
                        'end_date' => 'today',
                    ]),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'date']),
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                ],
            ]);

            // Passer l'objet RunReportRequest
            $response = $this->client->runReport($request);

            $total = 0;
            foreach ($response->getRows() as $row) {
                $total += (int) $row->getMetricValues()[0]->getValue();
            }

            return $total;

        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            error_log('Google Analytics Error: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Obtenir les visiteurs par jour
     */
    public function getVisitorsByDay(string $propertyId, int $days = 7): array
    {
        try {
            // Créer l'objet RunReportRequest
            $request = new RunReportRequest([
                'property' => 'properties/' . $propertyId,
                'dateRanges' => [
                    new DateRange([
                        'start_date' => $days . 'daysAgo',
                        'end_date' => 'today',
                    ]),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'date']),
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                ],
            ]);

            // Passer l'objet RunReportRequest
            $response = $this->client->runReport($request);

            $data = [];
            foreach ($response->getRows() as $row) {
                $date = $row->getDimensionValues()[0]->getValue();
                $users = (int) $row->getMetricValues()[0]->getValue();
                $data[$date] = $users;
            }

            return $data;

        } catch (\Exception $e) {
            error_log('Google Analytics Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtenir les pages vues
     */
    public function getPageViews(string $propertyId): int
    {
        try {
            $request = new RunReportRequest([
                'property' => 'properties/' . $propertyId,
                'dateRanges' => [
                    new DateRange([
                        'start_date' => '30daysAgo',
                        'end_date' => 'today',
                    ]),
                ],
                'metrics' => [
                    new Metric(['name' => 'screenPageViews']),
                ],
            ]);

            $response = $this->client->runReport($request);

            $total = 0;
            foreach ($response->getRows() as $row) {
                $total += (int) $row->getMetricValues()[0]->getValue();
            }

            return $total;

        } catch (\Exception $e) {
            error_log('Google Analytics Error: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Obtenir les pages les plus visitées
     */
    public function getTopPages(string $propertyId, int $limit = 10): array
    {
        try {
            $request = new RunReportRequest([
                'property' => 'properties/' . $propertyId,
                'dateRanges' => [
                    new DateRange([
                        'start_date' => '30daysAgo',
                        'end_date' => 'today',
                    ]),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'pagePath']),
                ],
                'metrics' => [
                    new Metric(['name' => 'screenPageViews']),
                ],
                'limit' => $limit,
                'orderBys' => [
                    ['metric' => ['metric_name' => 'screenPageViews'], 'desc' => true]
                ],
            ]);

            $response = $this->client->runReport($request);

            $data = [];
            foreach ($response->getRows() as $row) {
                $page = $row->getDimensionValues()[0]->getValue();
                $views = (int) $row->getMetricValues()[0]->getValue();
                $data[$page] = $views;
            }

            return $data;

        } catch (\Exception $e) {
            error_log('Google Analytics Error: ' . $e->getMessage());
            return [];
        }
    }
}
