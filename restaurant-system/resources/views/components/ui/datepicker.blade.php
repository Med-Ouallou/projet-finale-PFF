@props([
    'name' => '',
    'value' => '',
    'placeholder' => 'Sélectionner une date',
    'id' => null,
    'model' => null,
    'align' => 'left',
])

@php
    $id = $id ?? 'datepicker-' . uniqid();
@endphp

<div x-data="customDatepicker({ initialDate: '{{ $value }}', model: '{{ $model }}' })" x-init="init()" class="relative w-full">
    <!-- Hidden input to submit the actual value -->
    <input type="hidden" name="{{ $name }}" x-model="formattedDate" @if($attributes->has('onchange')) onchange="{{ $attributes->get('onchange') }}" @endif>
    
    <!-- Input Trigger -->
    <div class="relative">
        <input type="text" x-model="displayDate" readonly @click="toggle()" @click.away="close()"
            placeholder="{{ $placeholder }}"
            class="py-2.5 px-3.5 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all cursor-pointer w-full"
            {{ $attributes->whereDoesntStartWith('wire:')->except(['name', 'value', 'onchange']) }}>
        <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
        </div>
    </div>

    <!-- Calendar Dropdown -->
    <div x-show="isOpen" x-transition.opacity.duration.200ms
        class="absolute z-[100] mt-2 w-80 flex flex-col bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden @if($align === 'right') end-0 @else start-0 @endif"
        style="display: none;">
        
        <!-- Calendar Header -->
        <div class="p-4 border-b border-gray-50 space-y-3">
            <div class="flex items-center justify-between">
                <!-- Prev Button -->
                <button type="button" @click="prevMonth()" class="w-8 h-8 flex justify-center items-center text-gray-600 hover:bg-gray-100 rounded-full transition-colors focus:outline-none">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                
                <!-- Month / Year Selects -->
                <div class="flex justify-center items-center gap-x-2">
                    <div class="relative w-32">
                        <select x-model="month" @change="updateCalendar()" class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50">
                            <template x-for="(m, index) in monthNames" :key="index">
                                <option :value="index" x-text="m" :selected="index === month"></option>
                            </template>
                        </select>
                    </div>
                    <div class="relative w-24">
                        <select x-model="year" @change="updateCalendar()" class="py-2 px-3 block w-full border border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 bg-gray-50">
                            <template x-for="y in years" :key="y">
                                <option :value="y" x-text="y" :selected="y === year"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <!-- Next Button -->
                <button type="button" @click="nextMonth()" class="w-8 h-8 flex justify-center items-center text-gray-600 hover:bg-gray-100 rounded-full transition-colors focus:outline-none">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
            
            <!-- Weeks -->
            <div class="grid grid-cols-7 gap-1">
                <template x-for="day in ['Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa', 'Di']">
                    <span class="text-center text-[10px] font-bold uppercase text-gray-400 tracking-wider" x-text="day"></span>
                </template>
            </div>
        </div>

        <!-- Days Grid -->
        <div class="p-3">
            <div class="grid grid-cols-7 gap-1">
                <template x-for="blankday in blankDays">
                    <div class="w-8 h-8"></div>
                </template>
                <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                    <div>
                        <button type="button" @click="selectDate(date)"
                            class="w-8 h-8 flex justify-center items-center text-sm rounded-full transition-all focus:outline-none"
                            :class="{
                                'bg-emerald-600 text-white font-bold shadow-md shadow-emerald-200': isSelected(date),
                                'text-gray-700 hover:bg-gray-100 font-medium': !isSelected(date),
                                'bg-emerald-50 text-emerald-700 font-bold': isToday(date) && !isSelected(date)
                            }"
                            x-text="date">
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@once
<script>
    function customDatepicker(config) {
        return {
            isOpen: false,
            formattedDate: config.initialDate || '',
            displayDate: '',
            month: '',
            year: '',
            no_of_days: [],
            blankDays: [],
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            years: [],
            
            init() {
                const currentYear = new Date().getFullYear();
                for (let i = currentYear - 5; i <= currentYear + 5; i++) {
                    this.years.push(i);
                }
                
                let today = new Date();
                if (this.formattedDate) {
                    let d = new Date(this.formattedDate);
                    if (!isNaN(d.getTime())) {
                        today = d;
                        this.setDisplayDate(today);
                    }
                }
                
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.updateCalendar();
                
                this.$watch('formattedDate', (value) => {
                    if (!value) {
                        this.displayDate = '';
                    }
                    if (config.model && config.model !== 'null' && config.model !== '') {
                        let parts = config.model.split('.');
                        let obj = this;
                        for (let i = 0; i < parts.length - 1; i++) {
                            obj = obj[parts[i]];
                        }
                        if (obj) {
                            obj[parts[parts.length - 1]] = value;
                        }
                    }
                });

                if (config.model && config.model !== 'null' && config.model !== '') {
                    // Initialize if parent model has a value already
                    let parts = config.model.split('.');
                    let obj = this;
                    let initialVal = null;
                    for (let i = 0; i < parts.length; i++) {
                        if (obj) obj = obj[parts[i]];
                    }
                    if (obj) initialVal = obj;
                    
                    if (initialVal) {
                        this.formattedDate = initialVal;
                        let d = new Date(initialVal);
                        if (!isNaN(d.getTime())) {
                            this.setDisplayDate(d);
                            this.month = d.getMonth();
                            this.year = d.getFullYear();
                            this.updateCalendar();
                        }
                    }

                    this.$watch(config.model, (value) => {
                        if (value !== this.formattedDate) {
                            this.formattedDate = value;
                            if (value) {
                                let d = new Date(value);
                                if (!isNaN(d.getTime())) {
                                    this.setDisplayDate(d);
                                    this.month = d.getMonth();
                                    this.year = d.getFullYear();
                                    this.updateCalendar();
                                }
                            } else {
                                this.displayDate = '';
                            }
                        }
                    });
                }
            },
            
            toggle() {
                this.isOpen = !this.isOpen;
            },
            
            close() {
                this.isOpen = false;
            },
            
            updateCalendar() {
                this.month = parseInt(this.month);
                this.year = parseInt(this.year);
                
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                
                // getDay() returns 0 for Sunday. We want Monday = 0
                let firstDay = new Date(this.year, this.month, 1).getDay();
                firstDay = firstDay === 0 ? 6 : firstDay - 1; 
                
                let blankdaysArray = [];
                for (var i = 1; i <= firstDay; i++) {
                    blankdaysArray.push(i);
                }
                
                let daysArray = [];
                for (var i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }
                
                this.blankDays = blankdaysArray;
                this.no_of_days = daysArray;
            },
            
            prevMonth() {
                if (this.month === 0) {
                    this.month = 11;
                    this.year--;
                } else {
                    this.month--;
                }
                this.updateCalendar();
            },
            
            nextMonth() {
                if (this.month === 11) {
                    this.month = 0;
                    this.year++;
                } else {
                    this.month++;
                }
                this.updateCalendar();
            },
            
            isSelected(date) {
                if (!this.formattedDate) return false;
                const d = new Date(this.formattedDate);
                return d.getDate() === date && d.getMonth() === this.month && d.getFullYear() === this.year;
            },
            
            isToday(date) {
                const today = new Date();
                return today.getDate() === date && today.getMonth() === this.month && today.getFullYear() === this.year;
            },
            
            selectDate(date) {
                let selectedDate = new Date(this.year, this.month, date);
                
                // Format as YYYY-MM-DD
                let m = (this.month + 1).toString().padStart(2, '0');
                let d = date.toString().padStart(2, '0');
                this.formattedDate = `${this.year}-${m}-${d}`;
                
                this.setDisplayDate(selectedDate);
                this.close();
                
                // Trigger change event for parent forms if needed
                this.$nextTick(() => {
                    const input = this.$el.querySelector('input[type="hidden"]');
                    if (input && input.onchange) {
                        input.onchange({ target: input });
                    } else if (input) {
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            },
            
            setDisplayDate(date) {
                let d = date.getDate().toString().padStart(2, '0');
                let m = (date.getMonth() + 1).toString().padStart(2, '0');
                let y = date.getFullYear();
                // French format DD/MM/YYYY
                this.displayDate = `${d}/${m}/${y}`;
            }
        }
    }
</script>
@endonce
@endpush
