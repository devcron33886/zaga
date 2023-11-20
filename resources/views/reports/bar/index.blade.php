<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bar Report') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50 divide-y divide-gray-100">
                                    <tr class="divide-x divide-gray-100">
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Names</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bar Amount</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Kitchen Amount</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Chamber</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bingalo</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total Amount</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Percentage</th>
                                        <th scope="col" class="px-3 py-3.5 bg-red-400 text-left text-sm font-semibold text-gray-900">Cash in</th>
                                        <th scope="col" class="px-3 py-3.5  text-left text-sm font-semibold text-gray-900">Cash out</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Daily Payout</th> 
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($works as $work)
                                    <tr class="divide-x divide-gray-100">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $work->employee->names ?? ''}}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formattedBar() }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formattedKitchen() }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formattedChamber() }}</td>

                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formattedBingalo() }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formattedTotal() }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formatedPercentage() }}</td>
                                        <td class="whitespace-nowrap bg-red-400 px-3 py-4 text-sm text-gray-900">{{ $work->formattedCashIn() }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formattedCashOut() }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $work->formattedPayOut() }}</td>  
                                    </tr>
                                @endforeach
                                <tfoot>
                                    <tr>
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Total</td>
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{ Cknow\Money\Money::RWF($bar_total) }}</td>
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{ Cknow\Money\Money::RWF($kitchen_total) }}</td>
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{ Cknow\Money\Money::RWF($chamber_total) }}</td>
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{ Cknow\Money\Money::RWF($bingalo_total) }}</td>
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{ Cknow\Money\Money::RWF($total) }}</td>
                                        <td class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{ Cknow\Money\Money::RWF($percentages) }}</td>
                                    </tr>
                                </tfoot>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            <div class="mt-4">
                {{ $works->links() }}
            </div>
        </div>
    </div>
</x-app-layout>