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

                    <form action="{{route('members.add')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-input-label for="name" :value="__('Name')" class="my-1"/>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus
                                      autocomplete="name" value="{{old('name')}}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('name')"/>

                        <x-input-label for="phone" :value="__('Phone')" class="my-1"/>
                        <x-text-input id="phone" name="phone" type="number" class="mt-1 block w-full" autofocus
                                      autocomplete="phone" value="{{old('phone')}}"/>
                        <x-input-error class="mt-2" :messages="$errors->get('phone')"/>

                        <x-input-label for="jurusan" :value="__('Jurusan')" class="my-1"></x-input-label>
                        <x-select id="jurusan" name="jurusan">
                            <option value="" selected disabled>{{__('-- Pilih Jurusan --')}}</option>
                            @if(isset($jurusans))
                                @foreach($jurusans as $jurusan)
                                    <option value="{{$jurusan->id}}" @if($jurusan->id == old('jurusan')) selected @endif >{{$jurusan->name}}</option>
                                @endforeach
                            @endif
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('jurusan')"/>

                        <x-input-label for="image" :value="__('Image')" class="my-1"/>
                        <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('image')"/>

                        <div class="flex items-center gap-2 my-3">
                            <x-primary-button>{{ __('Add') }}</x-primary-button>
                        </div>
                    </form>

                    @if (session('status') === 'member-saved')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Member Saved') }}
                        </p>
                    @endif
                </div>

            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-bold text-xl">List Members</h2>

                    @foreach($members as $member)
                        <x-item :member="$member"></x-item>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
