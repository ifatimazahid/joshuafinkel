<?php

use App\Models\Slot;
use App\Repositories\Admin\SlotRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SlotRepositoryTest extends TestCase
{
    use MakeSlotTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SlotRepository
     */
    protected $slotRepo;

    public function setUp()
    {
        parent::setUp();
        $this->slotRepo = App::make(SlotRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSlot()
    {
        $slot = $this->fakeSlotData();
        $createdSlot = $this->slotRepo->create($slot);
        $createdSlot = $createdSlot->toArray();
        $this->assertArrayHasKey('id', $createdSlot);
        $this->assertNotNull($createdSlot['id'], 'Created Slot must have id specified');
        $this->assertNotNull(Slot::find($createdSlot['id']), 'Slot with given id must be in DB');
        $this->assertModelData($slot, $createdSlot);
    }

    /**
     * @test read
     */
    public function testReadSlot()
    {
        $slot = $this->makeSlot();
        $dbSlot = $this->slotRepo->find($slot->id);
        $dbSlot = $dbSlot->toArray();
        $this->assertModelData($slot->toArray(), $dbSlot);
    }

    /**
     * @test update
     */
    public function testUpdateSlot()
    {
        $slot = $this->makeSlot();
        $fakeSlot = $this->fakeSlotData();
        $updatedSlot = $this->slotRepo->update($fakeSlot, $slot->id);
        $this->assertModelData($fakeSlot, $updatedSlot->toArray());
        $dbSlot = $this->slotRepo->find($slot->id);
        $this->assertModelData($fakeSlot, $dbSlot->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSlot()
    {
        $slot = $this->makeSlot();
        $resp = $this->slotRepo->delete($slot->id);
        $this->assertTrue($resp);
        $this->assertNull(Slot::find($slot->id), 'Slot should not exist in DB');
    }
}
