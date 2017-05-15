<template>
   <div>
       <editable-table-grid :apiUrl="apiUrl"
                 :fields="fields"
                 :classes="classes"
       ></editable-table-grid>
   </div>
</template>

<script>
    import EditableTableGrid from './EditableTableGrid.vue'

    export default {
        components: {
            'editable-table-grid': EditableTableGrid
        },
        data() {
            return {
                apiUrl: '/api/users',
                classes: 'table table-bordered',
                fields: [
                    {
                        title: 'Username',
                        name: 'username',
                        editable: true,
                        creatable: true
                    },
                    {
                        title: 'Email',
                        name: 'email',
                        editable: true,
                        creatable: true
                    },
                    {
                        title: 'First name',
                        name: 'first_name',
                        editable: false,
                        creatable: true
                    },
                    {
                        title: 'Last name',
                        name: 'last_name',
                        editable: true,
                        creatable: true
                    },
                    {
                        title: 'address',
                        name: 'address',
                        editable: true,
                        creatable: false
                    }
                ]
            }
        }
    }
</script>