<?php
namespace SRIO\RestUploadBundle\Tests\Upload;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractUploadTestCase extends WebTestCase
{
    /**
     * Assert that response has errors.
     *
     * @param Client $client
     */
    protected function assertResponseHasErrors(Client $client)
    {
        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     * Get content of a resource.
     *
     * @param  Client            $client
     * @param $name
     * @return string
     * @throws \RuntimeException
     */
    protected function getResource(Client $client, $name)
    {
        $filePath = $this->getResourcePath($client, $name);
        if (!file_exists($filePath)) {
            throw new \RuntimeException(sprintf(
                'File %s do not exists',
                $filePath
            ));
        }

        return file_get_contents($filePath);
    }

    /**
     * Get uploaded file path.
     *
     * @param  Client $client
     * @param $name
     * @return string
     */
    protected function getUploadedFilePath(Client $client)
    {
        return $client->getContainer()->getParameter('kernel.root_dir').'/../web/uploads';
    }

    /**
     * Get resource path.
     *
     * @param  Client $client
     * @param $name
     * @return string
     */
    protected function getResourcePath(Client $client, $name)
    {
        return $client->getContainer()->getParameter('kernel.root_dir').'/../../Resources/'.$name;
    }
}
