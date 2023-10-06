<div>
    <div class="my-6">
        {{ $this->createTaskAction }}

        {{ $this->taskForAnotherUserAction }}

        <x-filament-actions::modals />
    </div>

    <div>
        {{ $this->table }}
    </div>

</div>
