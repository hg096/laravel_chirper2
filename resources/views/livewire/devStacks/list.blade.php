<?php

use App\Models\DevStack;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public Collection $devStacks;

    public ?DevStack $editing = null;

    public function mount(): void
    {
        $this->getDevStack();
    }

    #[On('devStack-created')]
    public function getDevStack(): void
    {
        $this->devStacks = DevStack::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

    }

    public function edit(DevStack $devStack): void
    {
        $this->editing = $devStack;
        $this->getDevStack();
    }

    #[On('devStack-edit-canceled')]
    #[On('devStack-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;
        $this->getDevStack();
    }

    public function delete(DevStack $devStack): void
    {
        $this->authorize('delete', $devStack);
        // $DevStack->delete();
        DevStack::delete_DevStack($devStack);
        $this->getDevStack();
    }
}; ?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($devStacks as $devStack)
            <div class="p-6 flex space-x-2" wire:key="{{ $devStack->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ $devStack->user->name }}</span>
                            <small
                                class="ml-2 text-sm text-gray-600">{{ $devStack->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($devStack->created_at->eq($devStack->updated_at))
                                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
                        </div>
                        @if ($devStack->user->is(auth()->user()))
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link wire:click="edit({{ $devStack->id }})">
                                        {{ __('수정') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link wire:click="delete({{ $devStack->id }})"
                                        wire:confirm="삭제하시겠습니까?">
                                        {{ __('삭제') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>
                    @if ($devStack->is($editing))
                    <livewire:devStacks.edit :devStack="$devStack" :key="$devStack->id" />
                    @else
                        {{-- <livewire:devStacks.edit :chirp="$chirp" :key="$chirp->id" /> --}}
                        <p class="mt-4 text-lg text-gray-900">{{ $devStack->memo }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
