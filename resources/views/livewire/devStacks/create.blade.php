<?php

use App\Models\DevStack;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {
    //  필수 코드
    #[Rule('required|string|max:255')]
    public string $skill = '';
    #[Rule('required|string|max:255')]
    public string $company = '';
    #[Rule('required|string|max:255')]
    public string $location = '';
    #[Rule('required|string|max:255')]
    public string $location2 = '';
    #[Rule('string')]
    public string $memo = '';
    #[Rule('required|string')]
    public string $category = '';

    public array $skills = [''];
    public array $category__options = [
        'front' => '프론트',
        'back' => '백엔드',
        'full' => '풀스택',
    ];

    public function store(): void
    {
        $validated = $this->validate();

        DevStack::create_DevStack($validated);

        // dd($this->skills);

        foreach ($this->skills as $skill) {
            // 각 'skill' 값을 데이터베이스에 저장합니다.
        }

        $this->skill = '';
        $this->company = '';
        $this->location = '';
        $this->location2 = '';
        $this->memo = '';
        $this->category = '';

        $this->dispatch('devStack-created');
    }

    public function addSkill()
    {
        $this->skills[] = '';
    }

    public $showCreateComponent = false;
    public function toggleCreateComponent()
    {
        $this->showCreateComponent = !$this->showCreateComponent;
    }

}; ?>

<div>
    <div wire:click="toggleCreateComponent()" class=" bg-greens-100 text-white rounded p-1 w-fit">
        <p class="select-none">
            @if($showCreateComponent)
            ∧
            @else
            ∨
            @endif
        </p>
    </div>
    @if($showCreateComponent)
    <form wire:submit="store">
        <div class="flex mt-4 ">
            <div class="mx-1">
                <p class="text-xs text-slate-700 mb-2 font-extrabold">카테고리</p>
                <x-select-box id="category" class="block mt-1 w-full" name="category" wire:model="category" :options="$category__options" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            <div class="mx-1">
                <p class="text-xs text-slate-700 mb-2 font-extrabold">기술스텍</p>
                <textarea wire:model="skill" placeholder="{{ __('java, php') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('skill')" class="mt-2" />
            </div>
            <div class="mx-1">
                <p class="text-xs text-slate-700 mb-2 font-extrabold">회사명</p>
                <textarea wire:model="company" placeholder="{{ __('회사명') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

                <x-input-error :messages="$errors->get('company')" class="mt-2" />
            </div>
            <div class="mx-1">
                <p class="text-xs text-slate-700 mb-2 font-extrabold">위치 -> 시</p>
                <textarea wire:model="location" placeholder="{{ __('위치->시') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>
            <div class="mx-1">
                <p class="text-xs text-slate-700 mb-2 font-extrabold">상세위치 -> 구/군</p>
                <textarea wire:model="location2" placeholder="{{ __('상세위치->구/군') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

                <x-input-error :messages="$errors->get('location2')" class="mt-2" />
            </div>
        </div>
        <div class="mx-1">
            <p class="text-xs text-slate-700 mb-2 font-extrabold">메모</p>
            <textarea wire:model="memo" placeholder="{{ __('메모') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

            <x-input-error :messages="$errors->get('memo')" class="mt-2" />
        </div>

        <div class="p-4 bg-slate-200 rounded-lg mt-4 ">
            <div class="flex justify-between ">
                <p class="text-greens-100 text-sm font-extrabold">자격요건</p>
                <button wire:click="addSkill" class=" bg-greens-100 px-3 rounded text-white " type="button">
                    <p>+</p>
                </button>
            </div>
            <div class="grid grid-cols-[repeat(5,1fr)]">
                @foreach ($skills as $index => $skill)
                    <div class="mt-2 mx-1">
                        <x-text-input wire:model="skills.{{ $index }}" id="skills.{{ $index }}"
                            class="block mt-1 w-full" type="text" name="skills.{{ $index }}" />
                        <x-input-error :messages="$errors->get('skills.{{ $index }}')" class="mt-2" />
                    </div>
                @endforeach
            </div>
        </div>

        <x-primary-button
            class="mt-4 w-full align-middle flex items-center justify-center ">{{ __('저장') }}</x-primary-button>
    </form>
    @endif
</div>
