<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SlotApiTest extends TestCase
{
    use MakeSlotTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSlot()
    {
        $slot = $this->fakeSlotData();
        $this->json('POST', '/api/v1/slots', $slot);

        $this->assertApiResponse($slot);
    }

    /**
     * @test
     */
    public function testReadSlot()
    {
        $slot = $this->makeSlot();
        $this->json('GET', '/api/v1/slots/'.$slot->id);

        $this->assertApiResponse($slot->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSlot()
    {
        $slot = $this->makeSlot();
        $editedSlot = $this->fakeSlotData();

        $this->json('PUT', '/api/v1/slots/'.$slot->id, $editedSlot);

        $this->assertApiResponse($editedSlot);
    }

    /**
     * @test
     */
    public function testDeleteSlot()
    {
        $slot = $this->makeSlot();
        $this->json('DELETE', '/api/v1/slots/'.$slot->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/slots/'.$slot->id);

        $this->assertResponseStatus(404);
    }
}
