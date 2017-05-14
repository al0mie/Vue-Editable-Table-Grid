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
                        name: 'username'
                    },
                    {
                        title: 'Email',
                        name: 'email'
                    },
                    {
                        title: 'First name',
                        name: 'first_name'
                    },
                    {
                        title: 'Last name',
                        name: 'last_name'
                    },
                    {
                        title: 'address',
                        name: 'address'
                    }
                ]
            }
        }
    }
</script>