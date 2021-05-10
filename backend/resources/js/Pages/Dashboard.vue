<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Shipments by Day
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="h-screen bg-gray-400 overflow-hidden shadow-xl sm:rounded-lg">
                    <shipments-dates />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ShipmentsDates from '../Components/ShipmentsDates'

    export default {
        components: {
            AppLayout,
            ShipmentsDates,
        },
        data(){
            return {
                shipmentsByDays: []
            }
        },
    }
</script>
