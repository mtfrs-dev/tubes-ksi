<x-app-layout>

    @include('components.alert')

    <div class="mb-4 flex justify-between items-center px-3 py-2 overflow-hidden w-full bg-white rounded-lg shadow-md">
        <p class="w-fit text-xl lg:text-3xl font-medium text-gray-700">
            Data Satuan Obat
        </p>
        <button type="button" id="openUnitStoreButton" class="w-fit text-white bg-primary hover:bg-primary-70 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-1.5 pr-3 text-center flex gap-2">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
            </span>
            <span>
                {{ __('Satuan Baru') }}
            </span>
        </button>
    </div>

    <div class="bg-white shadow-sm rounded-lg mb-4 p-4">
        <livewire:unit-table />
    </div>

    <!-- STORE UNIT DETAIL MODAL -->
    <div id="unitStoreModal" 
        class="fixed @if(auth()->user()->role == "ADMIN" && $errors->hasBag('store_unit')) z-[110] @else z-[-110] @endif inset-0">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-3/5 lg:1/2 xl:w-1/3 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Tambah Data Satuan Obat
                    </p>
                    <button type="button" id="closeUnitStoreButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                
                <!-- POP UP BODY -->
                <form action="{{ route('units.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="w-full max-h-[60vh] overflow-y-auto mb-6 px-2 custom-scrollbar">
                        <!-- Unit Name -->
                        <div class="mb-4">
                            <label for="store_name" class="block mb-2 text-base font-medium text-gray-900">{{ __('Nama Satuan') }}</label>
                            <input type="text" id="store_name" name="name" value="{{ old('name') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Nama Satuan">
                            @error('name', 'store_unit')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unit Code -->
                        <div class="mb-4">
                            <label for="store_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kode Satuan') }}</label>
                            <input type="text" id="store_code" name="code" value="{{ old('code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kode Satuan">
                            @error('code', 'store_unit')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <!-- SUBMIT BUTTON -->
                    <div class="flex justify-end">
                        <button type="submit" class="w-fit text-white bg-primary hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                            {{ __('Simpan Data') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- UPDATE UNIT DETAIL MODAL -->
    <div id="unitUpdateModal" 
        class="fixed @if(auth()->user()->role == "ADMIN" && $errors->hasBag('update_unit')) z-[110] @else z-[-110] @endif inset-0">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-3/5 lg:1/2 xl:w-1/3 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Ubah Detail Satuan Obat
                    </p>
                    <button type="button" id="closeUnitUpdateButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                
                <!-- POP UP BODY -->
                <form action="{{ route('units.update') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="w-full max-h-[60vh] overflow-y-auto mb-6 px-2 custom-scrollbar">
                        <input type="hidden" name="id" id="update_id">
                        <!-- Unit Name -->
                        <div class="mb-4">
                            <label for="update_name" class="block mb-2 text-base font-medium text-gray-900">{{ __('Nama Satuan') }}</label>
                            <input type="text" id="update_name" name="name" value="{{ old('name') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Nama Satuan">
                            @error('name', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unit Code -->
                        <div class="mb-4">
                            <label for="update_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kode Satuan') }}</label>
                            <input type="text" id="update_code" name="code" value="{{ old('code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kode Satuan">
                            @error('code', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- SUBMIT BUTTON -->
                    <div class="flex justify-end">
                        <button type="submit" class="w-fit text-white bg-primary hover:bg-primary-70 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                            {{ __('Simpan Perubahan') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>

            $(document).ready(function () {

                window.addEventListener('delete:unit', event => {
                    Swal.fire({
                        title: 'Peringatan',
                        text: `Anda yakin akan menghapus data satuan obat ini?`,
                        icon: 'warning',
                        showCancelButton : true,
                        cancelButtonText : 'Batal',
                        cancelButtonColor : '#6C7582',
                        showConfirmButton : true,
                        confirmButtonText : 'Hapus',
                        confirmButtonColor : '#FF4248',
                        buttonsStyling : 'py-2 w-20 text-center',
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data satuan obat berhasil dihapus.',
                                icon: 'success',
                                showConfirmButton : false,
                                timer: 2000
                            });
                            window.livewire.emit('deleteUnit', event.detail.id)
                        }
                    })
                });

                $("#openUnitStoreButton").click(function (e) { 
                    e.preventDefault();
                    $("#unitStoreModal").removeClass("z-[-110]");
                    $("#unitStoreModal").addClass("z-[110]");
                });

                $("#closeUnitStoreButton").click(function (e) { 
                    e.preventDefault();
                    $("#unitStoreModal").removeClass("z-[110]");
                    $("#unitStoreModal").addClass("z-[-110]");
                    
                    $("#store_name").val("");
                    $("#store_code").val("");
                });

                window.addEventListener('showUpdateForm:unit', event => {
                    $("#update_id").val(event.detail.id);
                    $("#update_name").val(event.detail.name);
                    $("#update_code").val(event.detail.code);
                    $("#unitUpdateModal").removeClass("z-[-110]");
                    $("#unitUpdateModal").addClass("z-[110]");
                });

                $("#closeUnitUpdateButton").click(function (e) { 
                    e.preventDefault();
                    $("#unitUpdateModal").removeClass("z-[110]");
                    $("#unitUpdateModal").addClass("z-[-110]");
                    $("#update_id").val("");
                    $("#update_name").val("");
                    $("#update_code").val("");
                });
            });
        </script>
    </x-slot>
</x-app-layout>
