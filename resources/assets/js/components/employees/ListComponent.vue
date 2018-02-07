<template>
    <div>
        <h1>Employees list</h1>
        <data-tables v-if="employees"
                     :data="employees"
                     :show-action-bar="false"
                     style="width: 100%"
                     :pagination-def="paginationDef"
                     :sort-method="sortMethod"
        >
            <el-table-column
                    prop="first_name"
                    label="Имя"
                    sortable="custom"
            >
            </el-table-column>
            <el-table-column
                    prop="second_name"
                    label="Фамилия"
                    sortable="custom"
            >
            </el-table-column>

            <el-table-column
                    prop="features"
                    label="Характеристика"
            >
            </el-table-column>

            <el-table-column
                    prop="features"
                    label="Дожность"
                    sortable="custom"
            >
                <template slot-scope="scope">
                    {{scope.row.position.name}}
                </template>
            </el-table-column>

            <el-table-column
                    prop="salary"
                    label="Зарплата"
                    sortable="custom"
            >
                <template slot-scope="scope">
                    {{scope.row.salary | formatMoney}} €
                </template>
            </el-table-column>

            <el-table-column
                    label="Редактировать"
            >
                <template slot-scope="scope">
                    <tr>
                        <a class="btn btn-warning" v-bind:href="'employee/'+scope.row.id+'/edit'">Редактировать</a>
                    </tr>
                </template>
            </el-table-column>

            <el-table-column
                    label="Удалить"
            >
                <template slot-scope="scope">
                    <tr>
                        <button class="btn btn-danger" v-on:click="delEmployee(scope.row)" >Удалить</button>
                    </tr>
                </template>
            </el-table-column>

        </data-tables>
    </div>

</template>
<script>
    export default {
        name: "pemployees_list",
        data: function () {
            return {
                employees: [],
                paginationDef: {
                    show: false
                },
            }
        },
        created() {
            this.getEmployees();
        },
        methods: {
            delEmployee(employee) {

                //console.log(employee);
                let result = false;
                result = confirm('Вы уверены что хотите удалить работника '+employee.first_name+' '+employee.second_name+'?');
                if(result == true) {
                    axios.delete('api/employee/'+employee.id).then(() => {
                        this.getEmployees();
                    });
                }
            },
            getEmployees() {
                axios.get('api/employees').then((response) => {
                    this.employees = response.data;
                    //console.log(response.data);
                });
            },
            sortMethod(a, b) {
                if (a == null) {
                    return +1;
                }
                if (b == null) {
                    return -1;
                }
                if(typeof a == 'string' || typeof b == 'string') {
                    a += '';
                    b += '';
                    a = a.toUpperCase();
                    b = b.toUpperCase();
                }
                return a > b ? 1 : a < b ? -1 : 0;
            }
        }
    }
</script>

<style scoped>

</style>