<template>
    <div class="container">
        <table :class="['table', classes]" v-cloak>
            <thead>
                <tr>
                    <template v-for="field in tableFields">
                        <th :id="'_' + field.name"
                            :class="['table-th', field.titleClass]"
                            v-html="field['title']"
                        ></th>
                    </template>
                </tr>
            </thead>

            <tbody v-cloak class="vuetable-body">
                <template v-for="(item, index) in tableData">
                    <row :item="item" :fields="tableFields" :apiUrl="resourceUrl"
                          v-on:destroy="destroy"
                          v-on:update="update"
                    ></row>
                </template>
            </tbody>
        </table>
        <br>
        <create-item-form :fields="tableFields" :apiUrl="apiUrl" v-on:save="save"></create-item-form>
    </div>
</template>

<script>
    import CreateItemForm from './CreateItemForm.vue';
    import Row from './Row.vue';

    export default {
        components: {
            'row': Row,
            'create-item-form': CreateItemForm
        },
        props: {
            apiUrl: {
                type: String,
                required: true
            },
            fields: {
                type: Array,
                required: true
            },
            classes: {
                type: String,
                required: false,
                default: 'table table-grid'
            }
        },
        data() {
            return {
                tableFields: [],
                tableData: [],
                resourceUrl: ''
            }
        },
        mounted() {
            //get unified fields
            this.normalizeFields();
            //get unified api url
            this.normalizeUrl();
            //load data
            this.loadData();
        },
        methods: {
            normalizeUrl() {
                if (typeof(this.apiUrl) === 'undefined') {
                    console.error('You need to provide "api url" prop.');
                    return;
                }
                this.resourceUrl = this.apiUrl.trim('/');
                this.resourceUrl = this.apiUrl + '/';
            },
            normalizeFields () {
                this.tableFields = [];

                //check fields
                if (typeof(this.fields) === 'undefined') {
                    console.error('You need to provide "fields" prop.');
                    return;
                }

                let self = this;
                let obj;

                //normilize to one style
                this.fields.forEach(function (field, i) {
                    if (typeof (field) === 'string') {
                        obj = {
                            name: field,
                            title: field,
                            titleClass: '',
                            editable: true,
                            created: true
                        }
                    } else {
                        obj = {
                            name: field.name,
                            title: (field.title === undefined) ? field.field.name : field.title,
                            titleClass: (field.titleClass === undefined) ? '' : field.titleClass,
                            editable: (field.editable === undefined) ? true : field.editable,
                            created: (field.created === undefined) ? true : field.created,
                        }
                    }
                    self.tableFields.push(obj)
                })
            },

            loadData (success = this.loadSuccess, failed = this.loadFailed) {
                axios.get(this.apiUrl).then(success, failed);
            },

            loadSuccess (response) {
                this.tableData = response.data;
            },
            loadFailed (response) {
                console.error('load-error', response);
            },

            destroy: function (item) {
                // destroy from the collection
                let index = this.tableData.indexOf(item);
                this.tableData.splice(index, 1);
            },
            update: function (item) {
                // update in the collection
                let index = this.tableData.indexOf(item);
                this.tableData[index] = item;
            },
            save: function (item) {
                // add a new item to the collection
                this.tableData.push(item);
            }
        }
    }
</script>
