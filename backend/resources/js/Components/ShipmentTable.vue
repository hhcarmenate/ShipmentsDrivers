<template>
    <div class="p-4">
        <table class="table-fixed border-collapse">
            <thead>
                <tr>
                    <th class="w-1/2 ">Address</th>
                    <th class="w-1/4">City</th>
                    <th class="w-1/4">State</th>
                    <th class="w-1/4">Zip</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(shipment, index) in shipments_data"
                    :class="(index % 2 !== 0) ? 'bg-gray-700 text-gray-400' : ''"
                >
                    <td class="border border-gray-400">{{ shipment.address }}</td>
                    <td class="border border-gray-400">{{ shipment.city }}</td>
                    <td class="border border-gray-400">{{ shipment.state }}</td>
                    <td class="border border-gray-400">{{ shipment.zip }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>

    export default {
        props:{
            shipments_data: {
                required: true
            }
        },
    }
</script>
