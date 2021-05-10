<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Create new Shipments Association
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="h-screen bg-gray-400 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <upload-buttons
                                :button_text="'Upload Shipments'"
                                @selectFile="handleFileSelected"
                                :reference="'shipments_destinations'"
                            ></upload-buttons>
                            <shipment-table
                                v-if="shipments_data_formatted.length"
                                :shipments_data="shipments_data_formatted"
                            ></shipment-table>
                        </div>
                        <div>
                            <upload-buttons
                                :button_text="'Upload Drivers'"
                                @selectFile="handleFileSelected"
                                :reference="'drivers'"
                            ></upload-buttons>
                            <drivers-table
                                v-if="drivers_data_formatted.length"
                                :drivers_data="drivers_data_formatted"
                            ></drivers-table>
                        </div>
                    </div>
                    <div class="flex flex-col items-center mt-20" :class="showAssignmentButton">
                        <button
                            class="bg-gray-800 px-3 py-2 rounded-md text-gray-100"
                            @click="makeAssignment()"
                        >
                            Make Assignment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import UploadButtons from "../../Components/UploadButtons"
import ShipmentTable from "../../Components/ShipmentTable"
import DriversTable from "../../Components/DriversTable"
import { Inertia } from '@inertiajs/inertia'

export default {
    name: "Create",
    components: {
        AppLayout,
        UploadButtons,
        ShipmentTable,
        DriversTable,
        Inertia
    },
    data(){
        return {
            shipments_destinations: null,
            drivers: null,
            shipments_data_formatted: [],
            drivers_data_formatted: []
        }
    },
    methods:{
        handleFileSelected(data) {
            if(data.reference === 'shipments_destinations') {
                this.shipments_destinations = data.file;
                this.checkDestination();
            } else {
                this.drivers = data.file;
                this.checkDrivers();
            }
        },
        checkDestination() {
            this.checkFileUploaded( { type: 'shipments_destinations', data: this.shipments_destinations } );
        },
        checkDrivers() {
            this.checkFileUploaded( { type: 'drivers', data: this.drivers } );
        },
        checkFileUploaded(options) {
            let formData = new FormData();
            formData.append('type', options.type);
            formData.append('data', options.data);
            axios.post('/api/shipments/checkFile', formData)
            .then((data) => {
                if(options.type === 'shipments_destinations') {
                    this.shipments_data_formatted = data.data.data;
                } else {
                    this.drivers_data_formatted = data.data.data;
                }
            })
            .catch((error) => {
                console.log(error)
            });
        },
        makeAssignment(){
            Inertia.post('/shipments/makeAssignments',{
                shipments_data: this.shipments_data_formatted,
                drivers_data: this.drivers_data_formatted
            })
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.log(error);
            });
        }
    },
    computed:{
        showAssignmentButton() {
            return (!this.shipments_data_formatted.length || !this.drivers_data_formatted.length) ? 'hidden' : '';
        }
    }
}
</script>
