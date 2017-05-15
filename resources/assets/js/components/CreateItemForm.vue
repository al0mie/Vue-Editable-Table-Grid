<template>
    <div>
        <button class="btn btn-success" v-on:click="edit" v-if="!create">Add</button>
        <button class="btn btn-success" v-on:click="save" v-if="create">Save</button>
        <button class="btn btn-primary" v-on:click="cancel" v-if="create">Cancel</button>

        <form v-if="create">
            <div v-for="(field, index) in fields">
                <div v-if="field.creatable">
                    <label :for="field.name">{{ field.title }}</label>
                    <input type="text"  class="form-control"
                           v-model="createForm[field.name]"
                           :id="field.name"
                    >
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            fields : {
                type: Array,
                required: true
            },
            apiUrl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                create: false,
                createForm: {}
            }
        },
        methods: {
            edit: function() {
                this.create = true;
            },

            save: function() {
                // send required to store a new item
                axios.post(this.apiUrl, this.createForm).then(response => {

                    //trigger event to collection
                    this.$emit('save', response.data);

                    // clear form
                    this.cancel();
                }, (response) => {
                    alert('Invalid data');
                });
            },

            cancel: function() {
                this.create = false;
                this.createForm = {};
            }
        }
    }
</script>