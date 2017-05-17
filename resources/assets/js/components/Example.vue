<template>
   <div>
       <editable-table-grid :apiUrl="apiUrl"
                 :fields="fields"
                 :classes="classes"
                 :editable="editable"
                 :deletable="deletable"
                 :creatable="creatable"
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
                editable: true,  // items could be modified
                creatable: true, // items could be created
                deletable: true, // items could be deleted
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