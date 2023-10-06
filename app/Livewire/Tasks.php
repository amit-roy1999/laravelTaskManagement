<?php

namespace App\Livewire;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Closure;
use Filament\Actions\Action;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Tasks extends Component implements HasForms, HasActions, HasTable
{
    use InteractsWithForms, InteractsWithActions, InteractsWithTable;

    public array $status;
    public $authUser;

    public function mount()
    {
        $this->status =  [
            0 => 'Pending',
            1 => 'Done'
        ];

        $this->authUser = auth()->user();
    }

    public function createTaskAction(): Action
    {
        return Action::make('CreateTask')
            ->form([
                TextInput::make('name')
                    ->label('Task Name')
                    ->rules(['required', 'string']),
                Textarea::make('description')
                    ->label('Task Description')
                    ->rules(['required', 'string']),
                Select::make('status')
                    ->options($this->status)
                    ->rules(['required', 'integer'])
            ])
            ->action(function (array $data): void {
                $this->authUser->tasks()->create($data);
            });
    }

    public function taskForAnotherUserAction(): Action
    {
        return Action::make('TaskForAnotherUser')
            ->form([
                Select::make('user_id')
                    ->options(getSelectDropDownFormatForFilament(User::where('id','!=',$this->authUser->id)->get(['id', 'name'])->toArray()))
                    ->rules(['required', 'integer']),
                TextInput::make('name')
                    ->label('Task Name')
                    ->rules(['required', 'string']),
                Textarea::make('description')
                    ->label('Task Description')
                    ->rules(['required', 'string']),
                Select::make('status')
                    ->options($this->status)
                    ->rules(['required', 'integer'])
            ])
            ->action(function (array $data): void {
                Task::create($data);
            });
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Task::where('user_id', $this->authUser->id))
            ->columns([
                TextColumn::make('id')->rowIndex()->sortable(),
                TextColumn::make('name')->sortable()->searchable(isIndividual: true),
                TextColumn::make('description')->sortable()->searchable(isIndividual: true),
                SelectColumn::make('status')->options($this->status),
                TextColumn::make('created_at')->label('Created At')->sortable()->since(),
                TextColumn::make('updated_at')->sortable()->dateTime(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make('edit')
                        ->form([
                            TextInput::make('name')
                                ->label('Task Name')
                                ->rules(['required', 'string']),
                            Textarea::make('description')
                                ->label('Task Description')
                                ->rules(['required', 'string']),
                            Select::make('status')
                                ->options($this->status)
                                ->rules(['required', 'integer'])
                        ]),
                    ViewAction::make()
                        ->form([
                            TextInput::make('name')
                                ->label('Task Name'),
                            Textarea::make('description')
                                ->label('Task Description'),
                            Select::make('status')
                                ->options($this->status),
                        ]),
                    DeleteAction::make()
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.tasks');
    }
}
