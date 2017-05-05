<?php

namespace Omnipay\Twispay\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;

class GetTransactionRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = '/transaction/';

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return [
            'id' => $this->getId(),
        ];
    }

    public function getId()
    {
        return $this->getParameter('id');
    }

    public function sendData($data)
    {
        try {
            $httpResponse = $this->get($this->endpoint . $this->getId())->send();
        } catch (ClientErrorResponseException $e) {

            if (stristr($e->getMessage(), 'Not Found') !== false) {
                $code = 404;
                $message = 'Not Found';
            }

            return $this->response = new GetTransactionResponse($this, [
                'code' => $code,
                'message' => $message,
            ]);

        }

        return $this->response = new GetTransactionResponse($this, $httpResponse->json());
    }

    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }
}
