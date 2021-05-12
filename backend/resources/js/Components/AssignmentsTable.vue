<template>
    <div class="p-4">
        <table class="table-fixed border-collapse">
            <thead>
                <tr>
                    <th class="w-1/2 ">Address</th>
                    <th class="w-1/4">Driver Name</th>
                    <th class="w-1/4">Suitable Score</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(assignment, index) in assignments.permutation"
                    :class="(index % 2 !== 0) ? 'bg-gray-700 text-gray-400' : ''"
                >
                    <td class="border border-gray-400">{{ assignment.destination }}</td>
                    <td class="border border-gray-400">{{ assignment.driver }}</td>
                    <td class="border border-gray-400">{{ assignment.suitable_score }}</td>
                </tr>
            </tbody>
        </table>
        <div class="ml-4 text-center text-sm text-gray-900 sm:text-right sm:ml-0 mt-5">
            Max SS: {{ assignments.score_sum }}
        </div>
        <div class="ml-4 text-center text-sm text-gray-100 sm:text-right sm:ml-0 mt-5">
            <inertia-link
                :href="'/shipments/create'"
                type="button"
                class="bg-gray-500 px-3 py-2 text-sm rounded-md focus:outline-none"
            >
                Back
            </inertia-link>
            <inertia-link
                :href="'/shipments/create'"
                type="button"
                class="bg-gray-900 px-3 py-2 text-sm rounded-md focus:outline-none ml-2"
            >
                Save(Under Construction)
            </inertia-link>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            assignments: {
                required: true
            }
        },
    }
</script>
