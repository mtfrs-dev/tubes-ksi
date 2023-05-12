<x-app-layout>

    @include('components.alert')

    <div class="mb-4 flex justify-between items-center px-3 py-2 overflow-hidden w-full bg-white rounded-lg shadow-md">
        <p class="w-fit text-xl lg:text-3xl font-medium text-gray-700">
            Data Transaksi
        </p>
        <button type="button" id="openTransactionStoreButton" class="w-fit text-white bg-primary hover:bg-primary-70 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-1.5 pr-3 text-center flex gap-2">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
            </span>
            <span>
                {{ __('Transaksi Baru') }}
            </span>
        </button>
    </div>

    <div class="bg-white shadow-sm rounded-lg mb-4 p-4">
        <livewire:transaction-table />
    </div>

    <!-- STORE TRANSACTION DETAIL MODAL -->
    <div id="transactionStoreModal" 
        class="fixed @if(auth()->user()->role == "ADMIN" && $errors->hasBag('store_transaction')) z-[110] @else z-[-110] @endif inset-0">
        {{-- class="fixed z-[110] inset-0"> --}}
        <div class="absolute z-[112] inset-0 bg-gray-600 bg-opacity-30 flex justify-center items-center py-4">
            <div class="bg-white w-10/12 md:w-2/3 lg:3/5 xl:w-1/2 rounded-md p-5">
                <!-- POP UP HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <p class="block m-0 text-lg font-semibold text-gray-900 tracking-wide">
                        Data Transaksi Pembelian Baru
                    </p>
                    <button type="button" id="closeTransactionStoreButton" class="block border-none outline-none text-gray-900 hover:text-gray-800 font-medium">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </button>
                </div>
                
                <!-- POP UP BODY -->
                <form action="{{ route('transactions.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="w-full max-h-[60vh] overflow-y-auto mb-6 px-2 custom-scrollbar">
                        <input type="hidden" name="type" value="PEMBELIAN">

                        <!-- Transaction Type -->
                        {{-- <p class="block mb-2 text-base font-medium text-gray-900">{{ __('Tipe Transaksi') }}</p>
                        <div class="mb-4 grid grid-cols-2 gap-4">                            
                            <div class="flex items-center pl-4 border-2 border-primary-20 rounded-md">
                                <input id="type_buy" type="radio" value="PEMBELIAN" name="type"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                <label for="type_buy" class="w-full py-3 ml-2 text-sm font-medium text-primary-50">
                                    PEMBELIAN
                                </label>
                            </div>
                            <div class="flex items-center pl-4 border-2 border-primary-20 rounded-md">
                                <input id="type_sell" type="radio" value="PENJUALAN" name="type"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                <label for="type_sell" class="w-full py-3 ml-2 text-sm font-medium text-primary-50">
                                    PENJUALAN
                                </label>
                            </div>
                        </div> --}}

                        <!-- Transaction Supplier -->
                        <div class="mb-4">
                            <label for="store_user_id" class="block mb-2 text-base font-medium text-gray-900">{{ __('Nama Penyedia') }}</label>
                            <select name="user_id" id="store_user_id"
                                class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder">
                                <option value="" selected disabled hidden>Pilih Penyedia</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" 
                                        @selected(old('user_id') == $supplier->id)>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Transaction Products -->
                        <div id="dynamicForm">
                            <p class="block mb-2 text-base font-medium text-gray-900">{{ __('Produk Obat Dibeli') }}</p>
                            <div class="mb-2 flex justify-between items-center gap-4">
                                <div class="w-[calc(100%-15rem)]">
                                    <p class="block text-base font-medium text-gray-900">{{ __('Nama Obat') }}</p>
                                </div>
                                <div class="w-20">
                                    <p class="block text-center text-base font-medium text-gray-900">{{ __('Jumlah') }}</p>
                                </div>
                                <div class="w-20">
                                    <p class="block text-center text-base font-medium text-gray-900">{{ __('Satuan') }}</p>
                                </div>
                                <div class="w-8 h-8 box-border"></div>
                            </div>

                            <div id="row_0" class="mb-4 flex justify-between items-center gap-4">
                                <div class="w-[calc(100%-15rem)]">
                                    <select name="select_0" id="select_0"
                                        class="form-select border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder custom-scrollbar">
                                        <option value="" selected disabled hidden>Pilih Obat</option>
                                        @foreach ($medicines as $medicine)
                                            <option value="{{ $medicine->id }}">
                                                {{ $medicine->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-20">
                                    <input type="number" id="qty_0" name="qty_0" min="0"
                                        class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder"
                                        placeholder="QTY" autocomplete="off" disabled>
                                </div>
                                <div class="w-20">
                                    <p id="unit_0" class="max-w-full text-primary-50 text-sm font-semibold block"></p>
                                </div>
                                <div class="w-fit">
                                    <button type="button" id="addBtn_0" class="addBtn hidden w-fit text-white bg-primary hover:bg-primary-70 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                        </svg>
                                    </button>
                                    <button type="button" id="delBtn_0" class="delBtn hidden w-fit text-white bg-danger hover:bg-danger-70 focus:ring-2 focus:outline-none focus:ring-danger-300 font-medium rounded-md text-sm p-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                        </svg>
                                    </button>
                                    <div id="btnPlaceholder_0" class="w-8"></div>
                                </div>
                            </div>
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

    <x-slot name="scripts">
        <script>
            function capitalizeWords(str) {
                let words = str.split(' ');
                for (let i = 0; i < words.length; i++) {
                    words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                }
                return words.join(' ');
            }

            let medicineData = {!! json_encode($medicines) !!};
            let units        = {!! json_encode($units) !!};

            let medicines = medicineData.map((item) => {
                return {
                    'id'            : item.id,
                    'name'          : item.name,
                    'qty'           : item.quantity,
                    'buy_price'     : item.buy_price,
                    'sell_price'    : item.sell_price,
                    'unit_id'       : item.unit_id,
                    'selected'      : false,
                }
            });

            $(document).ready(function () {                
                var index = 0;
                
                $(document).on("change", ".form-select", function() {
                    for(let i in medicines){
                        medicines[i].selected = false;
                    }

                    // console.log(medicines);

                    let selectedMed         = $(".form-select");
                    // console.log(selectedMed)
                    let selectedMedCount    = selectedMed.length;
                    // console.log(selectedMedCount)
                    for(let i=0; i<selectedMedCount; i++){
                        for (let j = 0; j < medicines.length; j++) {
                            if(medicines[j].id == selectedMed[i].value) {
                                medicines[j].selected = true;
                            }
                        }
                    }

                    // console.log(medicines);

                    let RemainingOptions = [];
                    let WillBeDeleted    = [];

                    // // console.log(selectedMed);
                    // // console.log(selectedMedCount);

                    for(let i=0; i<selectedMedCount; i++){
                        for(let j=1; j<selectedMed[i].childElementCount; j++){
                            if( medicines[j-1].selected == true){
                                if( !WillBeDeleted.includes(j-1) ){
                                    WillBeDeleted.push(j-1);
                                }
                            }else if( medicines[j-1].selected == false){
                                if( !RemainingOptions.includes(j-1) ){
                                    RemainingOptions.push(j-1);
                                }
                            }
                        }
                        for(let j=0; j<selectedMed[i].childElementCount; j++){
                            if( WillBeDeleted.includes(selectedMed[i].children[j].value) && !selectedMed[i].children[j].selected){
                                selectedMed[i].children[j].remove();
                            }   
                        }
                    }
                    console.log(WillBeDeleted);
                    console.log(RemainingOptions);
                        

                    for(let i=0; i<selectedMedCount; i++){
                        let CurrentOptions = [];
                        for(let j=0; j<selectedMed[i].childElementCount; j++){
                            CurrentOptions.push(selectedMed[i].children[j].value);
                        }
                        for(let j=0; j<RemainingOptions.length; j++){
                            if(!CurrentOptions.includes(RemainingOptions[j])){
                                option = document.createElement("option");
                                option.setAttribute("value", RemainingOptions[j]);
                                option.innerText = medicines[RemainingOptions[j]]["name"];
                                selectedMed[i].appendChild(option);
                            }
                        }
                    }
                    let X               = $(this).attr('id').split('_')[1];
                    // console.log(this.value);
                    let AvailableQty    = medicines[this.value-1].qty;
                    let ThisRow         = $( "#row_"+X );
                    let ThisQty         = $( "#qty_"+X );
                    let ThisUnit        = $( "#unit_"+X );
                    let ThisBtnPlc      = $( "#btnPlaceholder_"+X );
                    let ThisAddBtn      = $( "#addBtn_"+X );
                    let ThisDelBtn      = $( "#delBtn_"+X );
                    // console.log(ThisQty, ThisRow, ThisAddBtn, ThisDelBtn);
                    ThisQty.attr("disabled") ? ThisQty.attr("disabled", false) : '';
                    ThisQty.attr("max",AvailableQty);
                    ThisQty.val(0);
                    ThisUnit.text(units[medicines[this.value-1].unit_id].name);
                    

                    ThisQty.change( function(){
                        if( (this.value > 0) && (selectedMedCount < medicines.length) && (ThisRow.is(':last-child')) ){
                            ThisAddBtn.removeClass("hidden");
                            ThisBtnPlc.addClass("hidden");
                        }else{
                            ThisBtnPlc.removeClass("hidden");
                            ThisAddBtn.addClass("hidden");
                        }
                        // $("#prod_count_"+X+"").text($("#qty_"+X).val());
                    });
                    // let PP = $(".jaslkdj");
                    // let PselectedMedCount = PP.length;
                    // $("#i0909ad_Otobhlad").text(PPC+" produk dipilih");
                });

                $(document).on("click", ".addBtn", function(event){
                    event.preventDefault();
                    let X = $(this).attr("id").split("_")[1];
                    $("#addBtn_"+X+"").addClass("hidden");
                    $("#delBtn_"+X+"").removeClass("hidden");
                    index++;
                    let option = ``; 
                    let F = 0;
                    for (let i=0; i<medicines.length; i++){
                        if(!(medicines[i].selected)){
                            option += `<option value="`+i+`">`+medicines[i].name+`</option>`;
                        }
                    }
                    $("#dynamicForm").append(``
                        +`<div id="row_`+index+`" class="mb-4 flex justify-between items-center gap-4">`
                            +`<div class="w-[calc(100%-15rem)]">`
                                +`<select name="select_`+index+`" id="select_`+index+`" class="form-select border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder custom-scrollbar">`
                                    +`<option value="" selected disabled hidden>Pilih Obat</option>`
                                    + option
                                +`</select>`
                            +`</div>`
                            +`<div class="w-20">`
                                +`<input type="number" id="qty_`+index+`" name="qty_`+index+`" min="0" class="border-2 border-primary-20 text-primary-50 text-sm rounded-md focus:ring-primary-70 focus:border-primary-70 block w-full p-2.5 custom-placeholder" placeholder="QTY" autocomplete="off" disabled>`
                            +`</div>`
                            +`<div class="w-20">`
                                +`<p id="unit_`+index+`" class="text-primary-50 text-sm font-semibold block"></p>`
                            +`</div>`
                            +`<div class="w-fit">`
                                +`<button type="button" id="addBtn_`+index+`" class="addBtn hidden w-fit text-white bg-primary hover:bg-primary-70 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-1.5">`
                                    +`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">`
                                        +`<path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />`
                                    +`</svg>`
                                +`</button>`
                                +`<button type="button" id="delBtn_`+index+`" class="delBtn hidden w-fit text-white bg-danger hover:bg-danger-70 focus:ring-2 focus:outline-none focus:ring-danger-300 font-medium rounded-md text-sm p-1.5">`
                                    +`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">`
                                        +`<path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />`
                                    +`</svg>`
                                +`</button>`
                                +`<div id="btnPlaceholder_`+index+`" class="w-8"></div>`
                            +`</div>`
                        +`</div>`
                    );
                });

                $(document).on("click", ".deleteBtn", function(event){
                    event.preventDefault();
                    let X   = $(this).attr("id").split("_")[1];
                    let SB  = $("#select_"+X).val();
                    let ThisRow  = $("#row_"+X);
                    let SP  = $(".form-select");
                    let PC  = SP.length;
                    let PPP = $("#prod_"+X+"");
                    for(let i=0; i<PC; i++){
                        option = document.createElement("option");
                        option.setAttribute("value", SB);
                        option.innerText = PD[SB]["name"];
                        SP[i].appendChild(option);
                    }
                    ThisRow.remove();
                    PPP.remove();
                    let PP = $(".jaslkdj");
                    let PPC = PP.length;
                    $("#i0909ad_Otobhlad").text(PPC+" produk dipilih");
                });



                window.addEventListener('delete:category', event => {
                    Swal.fire({
                        title: 'Peringatan',
                        text: `Anda yakin akan menghapus data kategori obat ini?`,
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
                                text: 'Data kategori obat berhasil dihapus.',
                                icon: 'success',
                                showConfirmButton : false,
                                timer: 2000
                            });
                            window.livewire.emit('deleteCategory', event.detail.id)
                        }
                    })
                });

                $("#openCategoryStoreButton").click(function (e) { 
                    e.preventDefault();
                    $("#categoryStoreModal").removeClass("z-[-110]");
                    $("#categoryStoreModal").addClass("z-[110]");
                });

                $("#closeCategoryStoreButton").click(function (e) { 
                    e.preventDefault();
                    $("#categoryStoreModal").removeClass("z-[110]");
                    $("#categoryStoreModal").addClass("z-[-110]");
                    
                    $("#store_name").val("");
                    $("#store_code").val("");
                });

                window.addEventListener('showUpdateForm:category', event => {
                    $("#update_id").val(event.detail.id);
                    $("#update_name").val(event.detail.name);
                    $("#update_code").val(event.detail.code);
                    $("#categoryUpdateModal").removeClass("z-[-110]");
                    $("#categoryUpdateModal").addClass("z-[110]");
                });

                $("#closeCategoryUpdateButton").click(function (e) { 
                    e.preventDefault();
                    $("#categoryUpdateModal").removeClass("z-[110]");
                    $("#categoryUpdateModal").addClass("z-[-110]");
                    $("#update_id").val("");
                    $("#update_name").val("");
                    $("#update_code").val("");
                });
            });
        </script>
    </x-slot>

</x-app-layout>
