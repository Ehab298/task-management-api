<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructorResource\Pages\CreateInstructor;
use App\Filament\Resources\InstructorResource\Pages\EditInstructor;
use App\Filament\Resources\InstructorResource\Pages\ListInstructors;
use App\Filament\Resources\InstructorResource\Pages\ViewInstructor;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InstructorResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Instructors';

    protected static string|\UnitEnum|null $navigationGroup = 'User Management';

    protected static ?string $slug = 'instructors';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', User::ROLE_INSTRUCTOR);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
            TextInput::make('password')
                ->label('Password')
                ->password()
                ->revealable()
                ->required(fn (string $operation) => $operation === 'create')
                ->minLength(8)
                ->dehydrated(fn (?string $state) => filled($state))
                ->afterStateHydrated(fn (TextInput $component, ?string $state) => $component->state(null)),
            TextInput::make('password_confirmation')
                ->label('Password Confirmation')
                ->password()
                ->revealable()
                ->required(fn (string $operation) => $operation === 'create')
                ->same('password')
                ->dehydrated(false),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name'),
            TextEntry::make('email'),
            TextEntry::make('role')
                ->badge(),
            TextEntry::make('is_active')
                ->badge()
                ->formatStateUsing(fn (bool $state) => $state ? 'Active' : 'Inactive'),
            TextEntry::make('created_at')
                ->dateTime(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInstructors::route('/'),
            'create' => CreateInstructor::route('/create'),
            'view' => ViewInstructor::route('/{record}'),
            'edit' => EditInstructor::route('/{record}/edit'),
        ];
    }
}
