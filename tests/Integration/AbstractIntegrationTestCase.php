<?php

namespace Tests\Integration;

use Tests\Utils\Traits\WithMailFake;
use Tests\Utils\Traits\WithStorageFake;
use Tests\Utils\Traits\WithSocialiteFake;
use Tests\AbstractTestCase as BaseTestCase;
use Tests\Utils\Traits\WithNotificationFake;
use Tests\Utils\Traits\WithSchemaAssertions;
use Tests\Utils\Traits\WithCurrentTimestampFake;

abstract class AbstractIntegrationTestCase extends BaseTestCase
{
    use WithSchemaAssertions,
        WithMailFake,
        WithStorageFake,
        WithNotificationFake,
        WithCurrentTimestampFake,
        WithSocialiteFake;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpSchemaAssertions();
        $this->setUpMailFake();
        $this->setUpStorageFake();
        $this->setUpNotificationFake();
        $this->setUpSocialiteFake();
    }

    public function tearDown(): void
    {
        $this->tearDownSchemaAssertions();
        $this->tearDownMailFake();
        $this->tearDownStorageFake();
        $this->tearDownNotificationFake();
        $this->tearDownSocialiteFake();

        parent::tearDown();
    }
}
