<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-bold text-xl">Add Members</h2>

                    <form action="{{route('jurusan.add')}}" method="post">
                        @csrf
                        <x-input-label for="name" :value="__('Name')" class="my-1"/>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                                      autocomplete="name" value="{{old('name')}}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('name')"/>

                        <div class="flex items-center gap-2 my-3">
                            <x-primary-button>Add</x-primary-button>
                        </div>
                    </form>

                    @if (session('status') === 'jurusan-saved')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Jurusan Saved
                        </p>
                    @endif
                </div>

            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-bold text-xl">List Jurusan</h2>
                    @foreach($jurusans as $jurusan)
                        <div class="max-w-xl flex flex-col items-start h-8 border-0 border-b-2 border-b-blue-800 mt-3">
                            <h3>{{$jurusan->name}}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
