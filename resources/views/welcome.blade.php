@section('TITLE')
  메인
@stop

<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="max-w-2xl w-full px-4">
            @auth
                <livewire:chirps.create />
            @else
            @endauth
            <livewire:chirps.list />
            <livewire:devStacks.list />
        </div>

    </div>
</x-app-layout>
