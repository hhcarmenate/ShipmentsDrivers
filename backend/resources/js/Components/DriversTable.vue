<template>
    <div class="p-4">
        <table class="table-fixed border-collapse">
            <thead>
                <tr>
                    <th class="w-1/2 ">First Name</th>
                    <th class="w-1/4">Last Name</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(driver, index) in drivers_data"
                    :class="(index % 2 !== 0) ? 'bg-gray-700 text-gray-400' : ''"
                >
                    <td class="border border-gray-400">{{ driver.first_name }}</td>
                    <td class="border border-gray-400">{{ driver.last_name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>

    export default {
        props:{
            drivers_data: {
                required: true
            }
        },
    }
</script>
