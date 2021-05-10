<template>
    <div class="p-5">
        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 sm:text-left">
                <div class="flex items-center">
                </div>
            </div>
            <div class="ml-4 text-center text-sm text-gray-100 sm:text-right sm:ml-0">
                <inertia-link
                    :href="'/shipments/create'"
                    type="button"
                    class="bg-gray-900 px-3 py-2 text-sm rounded-md focus:outline-none"
                >
                    Add New Shipment
                </inertia-link>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            shipments: {
                required: false,
                default: []
            }
        }
    }
</script>
