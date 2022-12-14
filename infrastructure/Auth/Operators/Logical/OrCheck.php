<?php

namespace Infrastructure\Auth\Operators\Logical;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractCheck;

final class OrCheck extends AbstractCheck
{
    /**
     * @var AbstractCheck[]
     */
    private readonly array $assertions;

    public function __construct(
        AbstractCheck ...$assertions,
    ) {
        $this->assertions = $assertions;
    }

    public function execute(): Response
    {
        $result = Response::deny();

        foreach ($this->assertions as $assertion) {
            $response = $this->check($assertion);

            if ($response->allowed()) {
                return $response;
            }

            $result = $response;
        }

        return $result;
    }
}
