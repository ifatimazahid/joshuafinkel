<?php

use Faker\Factory as Faker;
use App\Models\Slot;
use App\Repositories\Admin\SlotRepository;

trait MakeSlotTrait
{
    /**
     * Create fake instance of Slot and save it in database
     *
     * @param array $slotFields
     * @return Slot
     */
    public function makeSlot($slotFields = [])
    {
        /** @var SlotRepository $slotRepo */
        $slotRepo = App::make(SlotRepository::class);
        $theme = $this->fakeSlotData($slotFields);
        return $slotRepo->create($theme);
    }

    /**
     * Get fake instance of Slot
     *
     * @param array $slotFields
     * @return Slot
     */
    public function fakeSlot($slotFields = [])
    {
        return new Slot($this->fakeSlotData($slotFields));
    }

    /**
     * Get fake data of Slot
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSlotData($slotFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'time' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $slotFields);
    }
}
