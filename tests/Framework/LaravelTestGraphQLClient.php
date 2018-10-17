<?php

namespace GraphQLClient;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;

/**
 * Class LaravelTestGraphQLClient
 *
 * @package GraphQLClient
 */
class LaravelTestGraphQLClient extends Client
{
    use MakesHttpRequests;

    /** @var Application */
    private $app;

    /**
     * WebTestGraphQLClient constructor.
     *
     * @param Application $app
     * @param string      $baseUrl
     */
    public function __construct(Application $app, string $baseUrl)
    {
        parent::__construct($baseUrl);

        $this->app = $app;
    }

    protected function postQuery(array $data): array
    {
        $response = $this->post($this->getBaseUrl(), $data);

        if ($response->getStatusCode() >= 400) {
            throw new GraphQLException(sprintf(
                'Mutation failed with status code %d and error %s',
                $response->getStatusCode(),
                $response->getContent()
            ));
        }

        $responseBody = json_decode($response->getContent(), true);

        if (isset($responseBody['errors'])) {
            throw new GraphQLException(json_encode($responseBody['errors']));
//             throw new GraphQLException(sprintf(
//                 'Mutation failed with error %s', json_encode($responseBody['errors'])
//             ));
        }

        return $responseBody;
    }
}
