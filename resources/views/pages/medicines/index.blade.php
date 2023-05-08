<x-app-layout>
    <x-slot name="header">
        {{ __('Data Obat') }}
    </x-slot>

    @include('components.alert')

    <div class="mb-4 inline-flex overflow-hidden w-full bg-white rounded-lg shadow-md">
        <div class="flex justify-center items-center w-12 bg-blue-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
            </svg>
        </div>

        <div class="px-2 py-1 align-baseline -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-blue-500">Info</span>
                <p class="text-sm text-gray-600">Sample table page</p>
            </div>
        </div>
    </div>

    {{-- <p class="w-60 bg-primary text-primary-70"></p>
    <p class="bg-danger text-danger-70"></p>
    <p class="bg-success text-success-70"></p> --}}

    <div class="bg-white shadow-sm rounded-lg mb-4 p-4 custom-scrollbar">
        <livewire:medicine-table />
    </div>

    <!-- SHOW MEDICINE DETAIL MODAL -->
    <div id="medicineDetailModal" class="fixed z-[110] inset-0 hidden">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-3/5 lg:1/2 xl:w-1/3 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Detail Obat
                    </p>
                    <button type="button" id="closeMedicineDetailButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-600">
                        <tbody class="w-full">
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Nama
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_name" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Kode
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_code" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Kategori
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_categories" class="px-2 py-1 flex flex-start gap-1.5 flex-wrap"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Harga Beli
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_buy_price" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Harga Jual
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_sell_price" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Kuantitas
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_quantity" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Satuan
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_unit" class="px-2 py-1 align-baseline"></td>
                            </tr>
                            <tr class="bg-white">
                                <th scope="row" class="px-2 py-1 align-baseline font-medium text-gray-900 whitespace-nowrap">
                                    Deskripsi
                                </th>
                                <td class="px-2 py-1 align-baseline">:</td>
                                <td id="medicine_description" class="px-2 py-1 align-baseline"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE MEDICINE DETAIL MODAL -->
    <div id="medicineUpdateModal" class="fixed z-[-110] inset-0">
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-3/5 lg:1/2 xl:w-1/3 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Ubah Detail Obat
                    </p>
                    <button type="button" id="closeMedicineUpdateButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                
                <!-- POP UP BODY -->
                <form action="{{ route('medicines.update') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="w-full max-h-[60vh] overflow-y-auto mb-6 px-2 custom-scrollbar">
                        <input type="hidden" name="id" id="update_id">
                        <!-- Medicine Name -->
                        <div class="mb-4">
                            <label for="update_name" class="block mb-2 text-base font-medium text-gray-900">{{ __('Nama Obat') }}</label>
                            <input type="text" id="update_name" name="name" value="{{ old('name') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Nama Obat">
                            @error('name', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Code -->
                        <div class="mb-4">
                            <label for="update_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kode Obat') }}</label>
                            <input type="text" id="update_code" name="code" value="{{ old('code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kode Obat">
                            @error('code', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine QR Code -->
                        <div class="mb-4">
                            <label for="update_qr_code" class="block mb-2 text-base font-medium text-gray-900">{{ __('Barcode Obat') }}</label>
                            <input type="text" id="update_qr_code" name="qr_code" value="{{ old('qr_code') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Barcode Obat">
                            @error('qr_code', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Category -->
                        <div class="mb-4">
                            <label for="update_categories" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kategori Obat') }}</label>
                            <select name="categories[]" id="update_categories" multiple="multiple"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        @selected(old('categories') && in_array($category->name, old('categories')))>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Buy Price -->
                        <div class="mb-4">
                            <label for="update_buy_price" class="block mb-2 text-base font-medium text-gray-900">{{ __('Harga Beli') }}</label>
                            <input type="number" id="update_buy_price" name="buy_price" value="{{ old('buy_price') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Harga Beli">
                            @error('buy_price', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Sell Price -->
                        <div class="mb-4">
                            <label for="update_sell_price" class="block mb-2 text-base font-medium text-gray-900">{{ __('Harga Jual') }}</label>
                            <input type="number" id="update_sell_price" name="sell_price" value="{{ old('sell_price') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Harga Jual">
                            @error('sell_price', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Quantity -->
                        <div class="mb-4">
                            <label for="update_quantity" class="block mb-2 text-base font-medium text-gray-900">{{ __('Kuantitas') }}</label>
                            <input type="number" id="update_quantity" name="quantity" value="{{ old('quantity') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Kuantitas">
                            @error('quantity', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Unit -->
                        <div class="mb-4">
                            <label for="update_unit" class="block mb-2 text-base font-medium text-gray-900">{{ __('Satuan Obat') }}</label>
                            <select name="unit" id="update_unit"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder">
                                <option value="" selected disabled hidden>Pilih Satuan Obat</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" 
                                        @selected(old('unit') == $unit->id)>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit', 'update_medicine')
                                <p class="block mt-1 text-xs font-medium text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medicine Description -->
                        <div class="mb-4">
                            <label for="update_description" class="block mb-2 text-base font-medium text-gray-900">{{ __('Deskripsi Obat') }}</label>
                            <input type="text" id="update_description" name="description" value="{{ old('description') }}"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" 
                                autocomplete="off" placeholder="Deskripsi">
                            @error('description', 'update_medicine')
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
            function capitalizeWords(str) {
                let words = str.split(' ');
                for (let i = 0; i < words.length; i++) {
                    words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                }
                return words.join(' ');
            }

            $(document).ready(function () {
                $("#update_categories").select2({
                    placeholder: "Pilih Kategori Obat"
                });

                // window.addEventListener('deleteAll', event => {
                //     Swal.fire({
                //         title: 'Peringatan',
                //         text: `Anda yakin akan menghapus ${event.detail.total} data ulasan?`,
                //         icon: 'warning',
                //         showCancelButton : true,
                //         cancelButtonText : 'Batal',
                //         cancelButtonColor : '#6C7582',
                //         showConfirmButton : true,
                //         confirmButtonText : 'Hapus',
                //         confirmButtonColor : '#FF4248',
                //         buttonsStyling : 'py-2 w-20 text-center',
                //     })
                //     .then((isConfirmed) => {
                //         if (isConfirmed) {
                //             Swal.fire({
                //                 title: 'Berhasil',
                //                 text: `${event.detail.total} ulasan berhasil dihapus.`,
                //                 icon: 'success',
                //                 showConfirmButton : false,
                //                 timer: 2000
                //             });
                //             window.livewire.emit('deleteAllReview', event.detail.id_arr)
                //         }
                //     })
                // });

                window.addEventListener('delete:medicine', event => {
                    Swal.fire({
                        title: 'Peringatan',
                        text: `Anda yakin akan menghapus data obat ini?`,
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
                                text: 'Data obat berhasil dihapus.',
                                icon: 'success',
                                showConfirmButton : false,
                                timer: 2000
                            });
                            window.livewire.emit('deleteMedicine', event.detail.id)
                        }
                    })
                });

                window.addEventListener('showDetail:medicine', event => {
                    let displayBuyPrice = event.detail.buy_price.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        currencyDisplay: 'symbol', 
                        minimumFractionDigits: 0, 
                        maximumFractionDigits: 0 
                    });
                    let displaySellPrice = event.detail.sell_price.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        currencyDisplay: 'symbol', 
                        minimumFractionDigits: 0, 
                        maximumFractionDigits: 0 
                    });
                    $("#medicine_name").text(capitalizeWords(event.detail.name));
                    $("#medicine_code").text(event.detail.code.toUpperCase());
                    if(event.detail.categories.length > 0) {
                        for(let i=0; i<event.detail.categories.length; i++) {
                            $("#medicine_categories").append(
                                `<p class="block w-fit px-1.5 py-1 text-xs rounded-md bg-primary text-white">`+event.detail.categories[i].name+`</p>`
                            );
                        }
                    } else {
                        $("#medicine_categories").html(`<p class="block w-fit px-1.5 py-1 text-xs rounded bg-gray-500 text-white">Tanpa Kategori</p>`);
                    }
                    $("#medicine_buy_price").text(displayBuyPrice);
                    $("#medicine_sell_price").text(displaySellPrice);
                    $("#medicine_quantity").text(event.detail.quantity);
                    $("#medicine_unit").text(capitalizeWords(event.detail.unit));
                    $("#medicine_description").text(event.detail.description);
                    $("#medicineDetailModal").removeClass("hidden");
                });

                $("#closeMedicineDetailButton").click(function (e) { 
                    e.preventDefault();
                    $("#medicineDetailModal").addClass("hidden");
                    $("#medicine_name").text("");
                    $("#medicine_code").text("");
                    $("#medicine_categories").html("");
                    $("#medicine_buy_price").text("");
                    $("#medicine_sell_price").text("");
                    $("#medicine_quantity").text("");
                    $("#medicine_unit").text("");
                    $("#medicine_description").text("");
                });

                window.addEventListener('showUpdateForm:medicine', event => {
                    $("#update_id").val(event.detail.id);
                    $("#update_name").val(event.detail.name);
                    $("#update_code").val(event.detail.code);
                    $("#update_qr_code").val(event.detail.qr_code);
                    $("#update_buy_price").val(event.detail.buy_price);
                    $("#update_sell_price").val(event.detail.sell_price);
                    $("#update_quantity").val(event.detail.quantity);
                    $("#update_unit").val(event.detail.unit);
                    $("#update_description").val(event.detail.description);
                    // console.log(event.detail.categories);
                    // let currentCategories;
                    // if(event.detail.categories.length > 0) {
                    //     currentCategories = event.detail.categories.map(function(element) {
                    //         return {
                    //             'id' : element.id,
                    //             'name' : element.name
                    //         }
                    //     });
                    // } 
                    // console.log(currentCategories);
                    // // $("#update_categories").select2({
                    // //     "placeholder": "Pilih Kategori Obat",
                    // //     "results" : currentCategories
                    // // });
                    // // updateSelectCategories.results = results;
                    $("#medicineUpdateModal").removeClass("z-[-110]");
                    $("#medicineUpdateModal").addClass("z-[110]");
                });

                $("#closeMedicineUpdateButton").click(function (e) { 
                    e.preventDefault();
                    $("#medicineUpdateModal").removeClass("z-[110]");
                    $("#medicineUpdateModal").addClass("z-[-110]");
                    $("#update_id").val("");
                    $("#update_name").val("");
                    $("#update_code").val("");
                    $("#update_qr_code").val("");
                    $("#update_buy_price").val("");
                    $("#update_sell_price").val("");
                    $("#update_quantity").val("");
                    $("#update_unit").val("");
                    $("#update_description").val("");
                });
            });
        </script>
    </x-slot>

</x-app-layout>
