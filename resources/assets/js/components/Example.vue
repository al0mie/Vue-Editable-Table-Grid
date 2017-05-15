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
                        created: true
                    },
                    {
                        title: 'Email',
                        name: 'email',
                        editable: true,
                        created: true
                    },
                    {
                        title: 'First name',
                        name: 'first_name',
                        editable: false,
                        created: true
                    },
                    {
                        title: 'Last name',
                        name: 'last_name',
                        editable: true,
                        created: true
                    },
                    {
                        title: 'address',
                        name: 'address',
                        editable: true,
                        created: false
                    }
                ]
            }
        }
    }
</script>