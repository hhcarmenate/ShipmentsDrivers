<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Shipment Assign Map
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="h-screen bg-gray-400 overflow-hidden shadow-xl sm:rounded-lg flex justify-center">
                    <assignments-table :assignments="assignments.data" v-if="assignments.data.length"/>

                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>

import AppLayout from "@/Layouts/AppLayout";
import AssignmentsTable from '../../Components/AssignmentsTable'

export default {
    name: "Assigned",
    components: {
        AppLayout,
        AssignmentsTable
    },
    props:{
        assignments:{
           required: true,
        }
    },
}
</script>
